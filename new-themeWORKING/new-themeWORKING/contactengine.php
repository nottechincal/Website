<?php
/**
 * Contact Form Handler - Rapid Tech Solutions
 * Handles contact form submissions securely
 */

// Security: Check for valid form submission
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.1 403 Forbidden');
    exit('Direct access not allowed');
}

// Configuration - Use environment variable or fallback
$emailTo = getenv('CONTACT_EMAIL') ?: 'support@rapidtechsolutions.au';
$emailFrom = 'noreply@rapidtechsolutions.au';
$subject = 'New Contact Form Submission - Rapid Tech Solutions';

// Sanitize and validate input
$name = isset($_POST['Name']) ? sanitize_input($_POST['Name']) : '';
$email = isset($_POST['Email']) ? filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL) : '';
$phone = isset($_POST['Tel']) ? sanitize_input($_POST['Tel']) : '';
$service = isset($_POST['Service']) ? sanitize_input($_POST['Service']) : '';
$message = isset($_POST['Message']) ? sanitize_input($_POST['Message']) : '';

// Validation
$errors = [];

if (empty($name) || strlen($name) < 2) {
    $errors[] = 'Valid name is required';
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Valid email is required';
}

if (empty($phone) || strlen($phone) < 8) {
    $errors[] = 'Valid phone number is required';
}

if (empty($message) || strlen($message) < 10) {
    $errors[] = 'Message must be at least 10 characters';
}

// Honeypot check for spam prevention
if (!empty($_POST['website'])) {
    // Bot detected - silently redirect
    header('Location: contactthanks.php');
    exit;
}

if (!empty($errors)) {
    // Log errors and redirect to error page
    error_log('Contact form validation errors: ' . implode(', ', $errors));
    header('Location: error.htm');
    exit;
}

// Prepare email body
$body = "===========================================\n";
$body .= "NEW CONTACT FORM SUBMISSION\n";
$body .= "===========================================\n\n";
$body .= "Name: {$name}\n";
$body .= "Email: {$email}\n";
$body .= "Phone: {$phone}\n";
$body .= "Service Requested: {$service}\n";
$body .= "Date/Time: " . date('Y-m-d H:i:s') . "\n";
$body .= "IP Address: " . ($_SERVER['REMOTE_ADDR'] ?? 'Unknown') . "\n\n";
$body .= "Message:\n";
$body .= "-------------------------------------------\n";
$body .= $message . "\n";
$body .= "-------------------------------------------\n";

// Email headers
$headers = [
    'From: ' . $emailFrom,
    'Reply-To: ' . $email,
    'X-Mailer: PHP/' . phpversion(),
    'Content-Type: text/plain; charset=UTF-8'
];

// Send email to business
$success = mail($emailTo, $subject, $body, implode("\r\n", $headers));

// Send confirmation email to customer
if ($success) {
    $customerSubject = 'Thank You for Contacting Rapid Tech Solutions';
    $customerMessage = "Dear {$name},\n\n";
    $customerMessage .= "Thank you for reaching out to Rapid Tech Solutions!\n\n";
    $customerMessage .= "We've received your message and will respond within 1 business hour during our operating hours (Mon-Fri 9am-5pm AEST).\n\n";
    $customerMessage .= "Your Request Details:\n";
    $customerMessage .= "- Service: {$service}\n";
    $customerMessage .= "- Phone: {$phone}\n\n";
    $customerMessage .= "For urgent matters, please call us directly at 0423 680 596.\n\n";
    $customerMessage .= "Best regards,\n";
    $customerMessage .= "The Rapid Tech Solutions Team\n";
    $customerMessage .= "Patterson Lakes, Melbourne\n";
    $customerMessage .= "https://www.rapidtechsolutions.au\n";

    $customerHeaders = [
        'From: ' . $emailFrom,
        'Reply-To: support@rapidtechsolutions.au',
        'X-Mailer: PHP/' . phpversion(),
        'Content-Type: text/plain; charset=UTF-8'
    ];

    mail($email, $customerSubject, $customerMessage, implode("\r\n", $customerHeaders));
}

// Redirect based on result
if ($success) {
    header('Location: contactthanks.php');
} else {
    error_log('Failed to send contact form email from: ' . $email);
    header('Location: error.htm');
}
exit;

/**
 * Sanitize input string
 */
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}
?>
