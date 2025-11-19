<?php// Check if form is submittedif ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Verify nonce for securityif (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'rapidtech_booking_form_nonce')) {
        wp_die('Security check failed.');
    }

    // Get form data$name = sanitize_text_field($_POST['Name']);
    $email = sanitize_email($_POST['Email']);
    $service = sanitize_text_field($_POST['Service']);
    $date = sanitize_text_field($_POST['Date']);
    $time = sanitize_text_field($_POST['Time']);
    $address = sanitize_text_field($_POST['Address']);
    $description = sanitize_textarea_field($_POST['Description']);
    $payment_type = sanitize_text_field($_POST['PaymentType']);

    // Get the content of the email template$email_template_path = get_template_directory() . '/email-template.html';
    if (file_exists($email_template_path)) {
        $email_template = file_get_contents($email_template_path);
    } else {
        wp_die('Email template not found.');
    }

    // Replace placeholders with actual values$email_template = str_replace('{{name}}', $name, $email_template);
    $email_template = str_replace('{{email}}', $email, $email_template);
    $email_template = str_replace('{{service}}', $service, $email_template);
    $email_template = str_replace('{{date}}', $date, $email_template);
    $email_template = str_replace('{{time}}', $time, $email_template);
    $email_template = str_replace('{{address}}', $address, $email_template);
    $email_template = str_replace('{{description}}', $description, $email_template);

    // Email setup$to = 'support@rapidtechsolutions.au';
    $subject = 'New Booking Form Submission';
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: support@rapidtechsolutions.au',
        'Reply-To: ' . $email
    );

    // Send email using the HTML templateif (wp_mail($to, $subject, $email_template, $headers)) {
        // Send confirmation email to customer$customer_subject = "Booking Confirmation - Rapid Tech Solutions";
        $customer_message = "
            <h2>Thank you for your booking!</h2>
            <p>Dear $name,</p>
            <p>We have received your booking and will be in touch soon. Here are the details:</p>
            <p><strong>Service:</strong> $service</p>
            <p><strong>Date:</strong> $date</p>
            <p><strong>Time:</strong> $time</p>
            <p><strong>Address:</strong> $address</p>
            <p>Best regards,<br>Rapid Tech Solutions Team</p>
        ";
        wp_mail($email, $customer_subject, $customer_message, $headers);

        // Redirect to PayPal if Card is selectedif ($payment_type === 'Card') {
            wp_redirect('https://www.paypal.com/ncp/payment/933V8E3YW8K82');
            exit();
        } else {
            wp_redirect(home_url('/thank-you'));
            exit();
        }
    } else {
        error_log('Booking form submission failed to send email.');
        wp_die('There was a problem sending your booking. Please try again later.');
    }
} else {
    // Fallback for invalid accesswp_redirect(home_url());
    exit();
}
?>