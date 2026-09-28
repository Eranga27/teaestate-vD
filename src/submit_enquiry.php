<?php
/**
 * The Tea Bungalow — Enquiry Form Handler (vD Production)
 * Receives POST data from contact.php, validates server-side, logs the submission,
 * and sends an email to the reservations team.
 *
 * Security: CSRF token checked, honeypot checked, all fields sanitised,
 * email address validated, no raw data echoed back.
 */

// ── Configuration ────────────────────────────────────────────────────────────
$config = require __DIR__ . '/config/mail.php';

// ── Helpers ──────────────────────────────────────────────────────────────────
function clean(string $v): string {
    return htmlspecialchars(strip_tags(trim($v)), ENT_QUOTES, 'UTF-8');
}

function respond(bool $ok, string $msg): void {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['ok' => $ok, 'message' => $msg]);
    exit;
}

// ── Guard: POST only ─────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    respond(false, 'Method Not Allowed');
}

// ── CSRF — session-token check ────────────────────────────────────────────────
session_start();
$token_in  = $_POST['csrf_token'] ?? '';
$token_srv = $_SESSION['csrf_token'] ?? '';
if (!$token_srv || !hash_equals($token_srv, $token_in)) {
    http_response_code(403);
    respond(false, 'Security check failed. Please reload the page and try again.');
}
// Rotate token after use
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

// ── Honeypot — bot trap ───────────────────────────────────────────────────────
if (!empty($_POST['website'])) {
    // Silent discard — bots should not know they were caught
    respond(true, 'Thank you. We will be in touch shortly.');
}

// ── Rate-limit: 3 submissions per IP per hour ─────────────────────────────────
$ip  = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
$key = 'rl_enquiry_' . md5($ip);
if (!isset($_SESSION[$key])) { $_SESSION[$key] = ['count' => 0, 'reset' => time() + 3600]; }
if (time() > $_SESSION[$key]['reset']) { $_SESSION[$key] = ['count' => 0, 'reset' => time() + 3600]; }
$_SESSION[$key]['count']++;
if ($_SESSION[$key]['count'] > 3) {
    http_response_code(429);
    respond(false, 'Too many submissions. Please try again in an hour or contact us via WhatsApp.');
}

// ── Collect & sanitise fields ─────────────────────────────────────────────────
$first         = clean($_POST['first']         ?? '');
$last          = clean($_POST['last']          ?? '');
$email_raw     = trim($_POST['email']          ?? '');
$phone         = clean($_POST['phone']         ?? '');
$enquiry_type  = clean($_POST['enquiry-type']  ?? '');
$arrival       = clean($_POST['arrival']       ?? '');
$departure     = clean($_POST['departure']     ?? '');
$adults        = clean($_POST['adults']        ?? '');
$children      = clean($_POST['children']      ?? '');
$pekoe_stages  = clean($_POST['pekoe-stages']  ?? '');
$message       = clean($_POST['message']       ?? '');
$how           = clean($_POST['how']           ?? '');

// ── Required field check ──────────────────────────────────────────────────────
$errors = [];
if (!$first)                            $errors[] = 'First name is required.';
if (!$last)                             $errors[] = 'Last name is required.';
if (!filter_var($email_raw, FILTER_VALIDATE_EMAIL)) $errors[] = 'A valid email address is required.';
if (!$enquiry_type)                     $errors[] = 'Please select an enquiry type.';
if (!$message)                          $errors[] = 'Please include a message.';

if ($errors) {
    http_response_code(422);
    respond(false, implode(' ', $errors));
}

$email = filter_var($email_raw, FILTER_SANITIZE_EMAIL);

// ── Persistent log (backup — prevents lost enquiries) ─────────────────────────
$log_dir  = $config['log_dir'];
$log_file = $log_dir . '/enquiries.log';
if (is_dir($log_dir) && is_writable($log_dir)) {
    $entry = [
        'ts'           => date('Y-m-d H:i:s T'),
        'name'         => "$first $last",
        'email'        => $email,
        'phone'        => $phone,
        'enquiry_type' => $enquiry_type,
        'arrival'      => $arrival,
        'departure'    => $departure,
        'adults'       => $adults,
        'children'     => $children,
        'pekoe_stages' => $pekoe_stages,
        'message'      => $message,
        'how'          => $how,
    ];
    file_put_contents($log_file, json_encode($entry) . PHP_EOL, FILE_APPEND | LOCK_EX);
}

// ── Compose email ─────────────────────────────────────────────────────────────
$subject = $config['enquiry_subject_prefix'] . " {$first} {$last} — {$enquiry_type}";

$body  = "New enquiry from The Tea Bungalow website\n";
$body .= "==========================================\n\n";
$body .= "Name       : {$first} {$last}\n";
$body .= "Email      : {$email}\n";
$body .= "Phone      : {$phone}\n";
$body .= "Enquiry    : {$enquiry_type}\n";
$body .= "Arrival    : {$arrival}\n";
$body .= "Departure  : {$departure}\n";
$body .= "Adults     : {$adults}\n";
$body .= "Children   : {$children}\n";
$body .= "Pekoe Stage: {$pekoe_stages}\n";
$body .= "How found  : {$how}\n\n";
$body .= "Message\n-------\n{$message}\n\n";
$body .= "--\nSent via www.theteabungalow.com on " . date('d M Y H:i:s T');

$headers  = "From: {$config['from_name']} <{$config['from_email']}>\r\n";
$headers .= "Reply-To: {$first} {$last} <{$email}>\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$headers .= "X-Mailer: TheTB-Web/1.0\r\n";

// ── Send ──────────────────────────────────────────────────────────────────────
$to = "{$config['recipient_name']} <{$config['recipient_email']}>";
$sent = mail($to, $subject, $body, $headers);

// ── Auto-acknowledge to guest ─────────────────────────────────────────────────
if ($sent) {
    $ack_subject = "Your enquiry to The Tea Bungalow — we'll be in touch";
    $ack_body    = "Dear {$first},\n\n";
    $ack_body   .= "Thank you for your enquiry. We have received your message and will respond within 24 hours.\n\n";
    $ack_body   .= "If your enquiry is urgent, please WhatsApp us directly on +94 (0)777 874 555.\n\n";
    $ack_body   .= "Warm regards,\nThe Tea Bungalow\nGalaha Estate, Sri Lanka\nstay@theteabungalow.com";
    $ack_headers  = "From: {$config['from_name']} <{$config['from_email']}>\r\n";
    $ack_headers .= "MIME-Version: 1.0\r\n";
    $ack_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    mail($email, $ack_subject, $ack_body, $ack_headers);
}

// ── Respond to client ─────────────────────────────────────────────────────────
respond(true, 'Thank you — your enquiry has been received. We will respond within 24 hours.');
