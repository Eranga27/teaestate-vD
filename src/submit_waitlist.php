<?php
/**
 * The Tea Bungalow — Chairman's Bungalow 2027 Waitlist Handler (vD Production)
 * Validates, logs, and dispatches the waitlist registration.
 */

$config = require __DIR__ . '/config/mail.php';

function clean(string $v): string {
    return htmlspecialchars(strip_tags(trim($v)), ENT_QUOTES, 'UTF-8');
}

function respond(bool $ok, string $msg): void {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['ok' => $ok, 'message' => $msg]);
    exit;
}

// POST only
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    respond(false, 'Method Not Allowed');
}

// CSRF
session_start();
$token_in  = $_POST['csrf_token'] ?? '';
$token_srv = $_SESSION['csrf_token_wl'] ?? '';
if (!$token_srv || !hash_equals($token_srv, $token_in)) {
    http_response_code(403);
    respond(false, 'Security check failed. Please reload the page and try again.');
}
$_SESSION['csrf_token_wl'] = bin2hex(random_bytes(32));

// Honeypot
if (!empty($_POST['website'])) {
    respond(true, 'You have been added to the waitlist.');
}

// Rate-limit
$ip  = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
$key = 'rl_waitlist_' . md5($ip);
if (!isset($_SESSION[$key])) { $_SESSION[$key] = ['count' => 0, 'reset' => time() + 3600]; }
if (time() > $_SESSION[$key]['reset']) { $_SESSION[$key] = ['count' => 0, 'reset' => time() + 3600]; }
$_SESSION[$key]['count']++;
if ($_SESSION[$key]['count'] > 3) {
    http_response_code(429);
    respond(false, 'Too many submissions. Please try again later.');
}

// Collect & sanitise
$first    = clean($_POST['wl-first']    ?? '');
$last     = clean($_POST['wl-last']     ?? '');
$email_raw = trim($_POST['wl-email']   ?? '');
$interest = clean($_POST['wl-interest'] ?? '');
$party    = clean($_POST['wl-party']    ?? '');
$notes    = clean($_POST['wl-notes']    ?? '');

// Required fields
$errors = [];
if (!$first)                                           $errors[] = 'First name is required.';
if (!$last)                                            $errors[] = 'Last name is required.';
if (!filter_var($email_raw, FILTER_VALIDATE_EMAIL))    $errors[] = 'A valid email address is required.';

if ($errors) {
    http_response_code(422);
    respond(false, implode(' ', $errors));
}

$email = filter_var($email_raw, FILTER_SANITIZE_EMAIL);

// Persistent log
$log_dir  = $config['log_dir'];
$log_file = $log_dir . '/waitlist.log';
if (is_dir($log_dir) && is_writable($log_dir)) {
    $entry = [
        'ts'       => date('Y-m-d H:i:s T'),
        'name'     => "$first $last",
        'email'    => $email,
        'interest' => $interest,
        'party'    => $party,
        'notes'    => $notes,
    ];
    file_put_contents($log_file, json_encode($entry) . PHP_EOL, FILE_APPEND | LOCK_EX);
}

// Compose email to team
$subject = $config['waitlist_subject_prefix'] . " {$first} {$last}";
$body    = "New Chairman's Bungalow 2027 Waitlist Registration\n";
$body   .= "====================================================\n\n";
$body   .= "Name     : {$first} {$last}\n";
$body   .= "Email    : {$email}\n";
$body   .= "Interest : {$interest}\n";
$body   .= "Party    : {$party}\n";
$body   .= "Notes    : {$notes}\n\n";
$body   .= "--\nSent via www.theteabungalow.com on " . date('d M Y H:i:s T');

$headers  = "From: {$config['from_name']} <{$config['from_email']}>\r\n";
$headers .= "Reply-To: {$first} {$last} <{$email}>\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$to   = "{$config['recipient_name']} <{$config['recipient_email']}>";
$sent = mail($to, $subject, $body, $headers);

// Auto-acknowledge
if ($sent) {
    $ack_subject = "You're on the Chairman's Bungalow 2027 waitlist";
    $ack_body    = "Dear {$first},\n\n";
    $ack_body   .= "You have been added to the Chairman's Bungalow 2027 priority waitlist. ";
    $ack_body   .= "We will be in touch as the project progresses — you will be among the first to know when reservations open.\n\n";
    $ack_body   .= "Warm regards,\nThe Tea Bungalow\nGalaha Estate, Sri Lanka\nstay@theteabungalow.com";
    $ack_headers  = "From: {$config['from_name']} <{$config['from_email']}>\r\n";
    $ack_headers .= "MIME-Version: 1.0\r\n";
    $ack_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    mail($email, $ack_subject, $ack_body, $ack_headers);
}

respond(true, "Thank you, {$first} — you're on the priority waitlist. We'll be in touch as the project progresses.");
