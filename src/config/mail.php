<?php
/**
 * The Tea Bungalow — Mail & Enquiry Configuration (vD Production)
 * 
 * Instructions:
 * - This file contains server-side configuration for email dispatches.
 * - By default, MAIL_DRIVER uses standard PHP mail() on your production host.
 * - If using SMTP (e.g. SendGrid, Mailgun, cPanel SMTP), supply credentials below
 *   or via environment variables (recommended for production).
 */

return [
    // Primary recipient for guest enquiries & reservations
    'recipient_email' => getenv('TB_RECIPIENT_EMAIL') ?: 'stay@theteabungalow.com',
    'recipient_name'  => 'The Tea Bungalow Reservations',

    // Sender information
    'from_email'      => getenv('TB_FROM_EMAIL') ?: 'stay@theteabungalow.com',
    'from_name'       => 'The Tea Bungalow Web Desk',

    // Subject prefixes
    'enquiry_subject_prefix'  => '[Tea Bungalow Enquiry]',
    'waitlist_subject_prefix' => '[Chairmans 2027 Waitlist]',

    // Driver: 'mail' (PHP mail function) or 'smtp'
    'driver' => getenv('TB_MAIL_DRIVER') ?: 'mail',

    // SMTP Settings (Pending business hosting credentials if SMTP is preferred over sendmail/mail())
    'smtp' => [
        'host'       => getenv('TB_SMTP_HOST') ?: '',
        'port'       => getenv('TB_SMTP_PORT') ?: 587,
        'encryption' => getenv('TB_SMTP_ENCRYPTION') ?: 'tls', // 'tls' or 'ssl'
        'username'   => getenv('TB_SMTP_USER') ?: '',
        'password'   => getenv('TB_SMTP_PASS') ?: '',
    ],

    // Log directory for persistent backup (preventing enquiry loss)
    'log_dir' => __DIR__ . '/../data',
];
