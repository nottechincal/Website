<?php
/**
 * Booking form handler.
 *
 * Found broken: an earlier edit merged inline comments onto the following
 * line with no newline (e.g. "// Check if form is submittedif (...)"), so
 * every "//" swallowed the code after it — the file has been invalid PHP
 * since before this rebuild, throwing a raw parse error on direct access.
 *
 * No template currently links to this file or posts to it, and no form on
 * the site emits the nonce it checks for, so it is dead code today. Fixed
 * rather than removed in case a booking form is reconnected later, and so a
 * stray direct request doesn't surface a PHP stack trace.
 */

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    wp_redirect(home_url());
    exit();
}

if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'rapidtech_booking_form_nonce')) {
    wp_die('Security check failed.');
}

$name = sanitize_text_field($_POST['Name']);
$email = sanitize_email($_POST['Email']);
$service = sanitize_text_field($_POST['Service']);
$date = sanitize_text_field($_POST['Date']);
$time = sanitize_text_field($_POST['Time']);
$address = sanitize_text_field($_POST['Address']);
$description = sanitize_textarea_field($_POST['Description']);
$payment_type = sanitize_text_field($_POST['PaymentType']);

$email_template_path = get_template_directory() . '/email-template.html';
if (file_exists($email_template_path)) {
    $email_template = file_get_contents($email_template_path);
} else {
    wp_die('Email template not found.');
}

$email_template = str_replace('{{name}}', $name, $email_template);
$email_template = str_replace('{{email}}', $email, $email_template);
$email_template = str_replace('{{service}}', $service, $email_template);
$email_template = str_replace('{{date}}', $date, $email_template);
$email_template = str_replace('{{time}}', $time, $email_template);
$email_template = str_replace('{{address}}', $address, $email_template);
$email_template = str_replace('{{description}}', $description, $email_template);

$to = 'support@rapidtechsolutions.au';
$subject = 'New Booking Form Submission';
$headers = array(
    'Content-Type: text/html; charset=UTF-8',
    'From: support@rapidtechsolutions.au',
    'Reply-To: ' . $email,
);

if (wp_mail($to, $subject, $email_template, $headers)) {
    $customer_subject = 'Booking Confirmation - Rapid Tech Solutions';
    $customer_message = '
        <h2>Thank you for your booking!</h2>
        <p>Dear ' . esc_html($name) . ',</p>
        <p>We have received your booking and will be in touch soon. Here are the details:</p>
        <p><strong>Service:</strong> ' . esc_html($service) . '</p>
        <p><strong>Date:</strong> ' . esc_html($date) . '</p>
        <p><strong>Time:</strong> ' . esc_html($time) . '</p>
        <p><strong>Address:</strong> ' . esc_html($address) . '</p>
        <p>Best regards,<br>Rapid Tech Solutions Team</p>
    ';
    wp_mail($email, $customer_subject, $customer_message, $headers);

    if ($payment_type === 'Card') {
        wp_redirect('https://www.paypal.com/ncp/payment/933V8E3YW8K82');
    } else {
        wp_redirect(home_url('/thank-you'));
    }
    exit();
}

error_log('Booking form submission failed to send email.');
wp_die('There was a problem sending your booking. Please try again later.');
