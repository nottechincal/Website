<?php
/**
 * Shared form handling: CSRF protection, booking validation, logging, and
 * email delivery.
 *
 * Before this file existed, index.php, book.php and contact.php each had
 * their own copy of "trim the fields, check lengths, write a JSONL line,
 * send two emails" — three places to fix the same bug, and none of the
 * forms had a CSRF token. A form origin cannot be trusted on a public POST
 * endpoint without one: anything on the internet can point a <form> at
 * these URLs and submit on a visitor's behalf.
 */

require_once __DIR__ . '/config.php';

/**
 * Start the session if one isn't already running.
 *
 * Needed before either reading or writing the CSRF token. Safe to call
 * repeatedly — session_status() makes this idempotent.
 */
function rt_ensure_session(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        // Headers may already be sent under some render paths (e.g. WP
        // previews); @ suppresses the resulting notice rather than fataling
        // a page over a feature that degrades gracefully to "no token yet".
        @session_start();
    }
}

/**
 * Get (or create) this session's CSRF token.
 */
function rt_csrf_token(): string
{
    rt_ensure_session();
    if (empty($_SESSION['rt_csrf'])) {
        $_SESSION['rt_csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['rt_csrf'];
}

/**
 * Render the hidden CSRF field for a <form>. Echoes directly — call inside
 * the <form> tag.
 */
function rt_csrf_field(): void
{
    echo '<input type="hidden" name="rt_csrf" value="' . RT::e(rt_csrf_token()) . '">';
}

/**
 * Check a submitted CSRF token against the session's.
 *
 * hash_equals() rather than === so the comparison runs in constant time —
 * a straight string compare leaks how many leading bytes matched through
 * timing, which is exactly the kind of thing a token is supposed to guard
 * against.
 */
function rt_verify_csrf(?string $submitted): bool
{
    rt_ensure_session();
    if (empty($_SESSION['rt_csrf']) || empty($submitted)) {
        return false;
    }
    return hash_equals($_SESSION['rt_csrf'], $submitted);
}

/**
 * Validate booking/contact form fields common to all three forms.
 *
 * @param array $post   Raw $_POST-shaped array.
 * @param array $rules  Which fields are required: subset of
 *                       ['name','email','phone','service','address','description'].
 * @return array{clean: array, errors: array}
 */
function rt_validate_booking(array $post, array $rules = ['name', 'email', 'phone', 'service', 'address', 'description']): array
{
    $clean = [
        'service'     => trim($post['service'] ?? $post['bk_service'] ?? ''),
        'name'        => trim($post['name'] ?? $post['bk_name'] ?? ''),
        'email'       => trim($post['email'] ?? $post['bk_email'] ?? ''),
        'phone'       => trim($post['phone'] ?? $post['bk_phone'] ?? ''),
        'date'        => trim($post['date'] ?? $post['bk_date'] ?? ''),
        'time'        => trim($post['time'] ?? $post['bk_time'] ?? ''),
        'address'     => trim($post['address'] ?? $post['bk_address'] ?? ''),
        'description' => trim($post['description'] ?? $post['bk_desc'] ?? $post['message'] ?? ''),
    ];

    $errors = [];
    if (in_array('name', $rules, true) && strlen($clean['name']) < 2) {
        $errors['name'] = 'Please enter your name.';
    }
    if (in_array('email', $rules, true) && !filter_var($clean['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Valid email required.';
    }
    if (in_array('phone', $rules, true) && strlen($clean['phone']) < 8) {
        $errors['phone'] = 'Valid phone number required.';
    }
    if (in_array('service', $rules, true) && empty($clean['service'])) {
        $errors['service'] = 'Please choose a service.';
    }
    if (in_array('address', $rules, true) && strlen($clean['address']) < 5) {
        $errors['address'] = 'Please enter your address.';
    }
    if (in_array('description', $rules, true) && strlen($clean['description']) < 10) {
        $errors['description'] = 'Tell us a bit more (at least 10 characters).';
    }

    return ['clean' => $clean, 'errors' => $errors];
}

/**
 * Append a booking to .bookings/bookings.jsonl, creating the directory and
 * its lock-down .htaccess on first use.
 *
 * This file holds customer names, emails, phone numbers and home addresses,
 * and it sits inside the theme — i.e. under the web root. The root
 * .htaccess denies dot-FILES, but Apache's <FilesMatch> tests the filename
 * only, so "bookings.jsonl" inside a ".bookings" directory would be served
 * happily to anyone who asked for it by name. The deny rule is written into
 * the directory itself at creation time so the protection travels with the
 * data rather than depending on a rule several directories away.
 */
function rt_log_booking(array $clean, string $source): void
{
    $logdir = RT::path('.bookings');
    if (!is_dir($logdir)) {
        @mkdir($logdir, 0750, true);
        @file_put_contents(
            $logdir . '/.htaccess',
            "Require all denied\n"
            . "<IfModule !mod_authz_core.c>\n"
            . "Order deny,allow\nDeny from all\n"
            . "</IfModule>\n"
        );
        @file_put_contents($logdir . '/index.html', '');
    }

    $entry = json_encode([
        'time'      => date('Y-m-d H:i:s'),
        'ip'        => $_SERVER['REMOTE_ADDR'] ?? '',
        'source'    => $source,
        'service'   => $clean['service'] ?? '',
        'name'      => $clean['name'] ?? '',
        'email'     => $clean['email'] ?? '',
        'phone'     => $clean['phone'] ?? '',
        'date'      => $clean['date'] ?? '',
        'time_pref' => $clean['time'] ?? '',
        'address'   => $clean['address'] ?? '',
        'issue'     => $clean['description'] ?? '',
    ]) . "\n";

    @file_put_contents($logdir . '/bookings.jsonl', $entry, FILE_APPEND | LOCK_EX);
}

/**
 * Send the business notification + customer confirmation emails for a
 * booking. Returns whether the business notification sent — the customer
 * confirmation is best-effort and doesn't affect the return value, since
 * the booking is already safely logged by rt_log_booking() regardless.
 */
function rt_send_booking_email(array $clean): bool
{
    $to = RT::EMAIL;
    $subject = 'New Booking: ' . $clean['service'] . ' — ' . $clean['name'];
    $body  = "NEW BOOKING\n───────────────────────\n";
    $body .= "Name:    {$clean['name']}\n";
    $body .= "Email:   {$clean['email']}\n";
    $body .= "Phone:   {$clean['phone']}\n";
    $body .= "Service: {$clean['service']}\n";
    $body .= "Date:    {$clean['date']}\n";
    $body .= "Time:    {$clean['time']}\n";
    $body .= "Address: {$clean['address']}\n\n";
    $body .= "Issue:\n{$clean['description']}\n";
    $body .= "───────────────────────\nSubmitted: " . date('Y-m-d H:i:s') . "\n";

    $headers = [
        'From: ' . RT::NAME . ' <' . RT::EMAIL_NOREPLY . '>',
        'Reply-To: ' . $clean['email'],
        'Content-Type: text/plain; charset=UTF-8',
    ];

    $sent = function_exists('wp_mail')
        ? wp_mail($to, $subject, $body, $headers)
        : @mail($to, $subject, $body, implode("\r\n", $headers));

    if ($sent) {
        $cust_subject = 'Booking Received — ' . RT::NAME;
        $cust_body  = "Hi {$clean['name']},\n\n";
        $cust_body .= "Thanks for booking with " . RT::NAME . ".\n\n";
        $cust_body .= "We'll confirm your time within 1 business hour.\n";
        $cust_body .= "For urgent help, call " . RT::PHONE_DISPLAY . ".\n\n";
        $cust_body .= "Your details:\n";
        $cust_body .= "  Service: {$clean['service']}\n";
        $cust_body .= "  Date:    {$clean['date']}\n";
        $cust_body .= "  Time:    {$clean['time']}\n";
        $cust_body .= "  Address: {$clean['address']}\n\n";
        $cust_body .= "— " . RT::NAME . "\n  " . RT::LOCALITY . ", " . RT::REGION . "\n";

        $cust_headers = [
            'From: ' . RT::NAME . ' <' . RT::EMAIL_NOREPLY . '>',
            'Content-Type: text/plain; charset=UTF-8',
        ];
        if (function_exists('wp_mail')) {
            wp_mail($clean['email'], $cust_subject, $cust_body, $cust_headers);
        } else {
            @mail($clean['email'], $cust_subject, $cust_body, implode("\r\n", $cust_headers));
        }
    }

    return (bool) $sent;
}
