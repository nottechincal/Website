<?php
require_once __DIR__ . '/inc/config.php';
require_once __DIR__ . '/inc/seo.php';
require_once __DIR__ . '/inc/icons.php';

$submitted = false;
$errors = [];

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' && !empty($_POST['contact_submit'])) {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $honeypot = $_POST['website'] ?? '';

    if (strlen($name) < 2)    $errors['name'] = 'Please enter your name.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Valid email required.';
    if (strlen($message) < 10) $errors['message'] = 'Tell us a bit more (at least 10 chars).';

    if (empty($errors) && empty($honeypot)) {
        $to = RT::EMAIL;
        $subject = 'Contact Form: ' . $name;
        $body = "Name: {$name}\nEmail: {$email}\nPhone: {$phone}\n\n{$message}";
        $hdrs = ['Content-Type: text/plain; charset=UTF-8'];

        if (function_exists('wp_mail')) {
            wp_mail($to, $subject, $body, $hdrs);
        } else {
            @mail($to, $subject, $body, "From: {$email}\r\nContent-Type: text/plain; charset=UTF-8");
        }
        $submitted = true;
    }
}
?>
<!DOCTYPE html>
<html lang="<?php echo RT::LANG; ?>">
<head>
<?php rt_head([
    'title'       => 'Contact Us | ' . RT::NAME,
    'description' => 'Get in touch with Rapid Tech Solutions. Call 0423 680 596, email us, or use the contact form. Based in Cranbourne South, serving Melbourne\'s south-east.',
    'path'        => '/contact/',
    'schema'      => [
        RT::local_business(),
    ],
]); ?>
</head>
<body>
<?php rt_header(); ?>
<?php rt_breadcrumbs(['Contact' => '/contact/']); ?>

<main id="main">
    <section class="section">
        <div class="container" style="max-width:960px;margin:0 auto;">
            <div class="shead">
                <p class="kicker">Get in touch</p>
                <h1>Contact Rapid Tech Solutions</h1>
                <p>Call, email, WhatsApp, or use the form below. We typically reply within 1 hour during business hours.</p>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:2rem;margin-top:2rem;align-items:start">
                <div style="display:flex;flex-direction:column;gap:1.5rem">
                    <div style="background:var(--surface);border:1px solid var(--line);border-radius:var(--r2);padding:1.5rem">
                        <h3 style="margin-bottom:.5rem"><?php echo rt_icon('phone', 'icon-sm'); ?> Call us</h3>
                        <a href="tel:<?php echo RT::PHONE_E164; ?>" style="font-size:1.3rem;font-weight:700;color:var(--accent)"><?php echo RT::e(RT::PHONE_DISPLAY); ?></a>
                        <p style="color:var(--muted);font-size:.88rem;margin-top:.3rem">Same-day emergency service available</p>
                    </div>
                    <div style="background:var(--surface);border:1px solid var(--line);border-radius:var(--r2);padding:1.5rem">
                        <h3 style="margin-bottom:.5rem"><?php echo rt_icon('mail', 'icon-sm'); ?> Email</h3>
                        <a href="mailto:<?php echo RT::EMAIL; ?>" style="font-size:1.05rem;color:var(--accent)"><?php echo RT::EMAIL; ?></a>
                    </div>
                    <div style="background:var(--surface);border:1px solid var(--line);border-radius:var(--r2);padding:1.5rem">
                        <h3 style="margin-bottom:.5rem">WhatsApp</h3>
                        <a href="<?php echo RT::WHATSAPP; ?>" rel="noopener" target="_blank" style="font-size:1.05rem;color:var(--accent)">Chat on WhatsApp</a>
                        <p style="color:var(--muted);font-size:.88rem;margin-top:.3rem">Send photos of your issue for faster diagnosis</p>
                    </div>
                    <div style="background:var(--surface);border:1px solid var(--line);border-radius:var(--r2);padding:1.5rem">
                        <h3 style="margin-bottom:.5rem"><?php echo rt_icon('pin', 'icon-sm'); ?> Location</h3>
                        <p><?php echo RT::e(RT::LOCALITY); ?>, <?php echo RT::REGION; ?> <?php echo RT::POSTCODE; ?></p>
                        <p style="color:var(--muted);font-size:.88rem;margin-top:.3rem"><?php echo RT::e(RT::HOURS_TEXT); ?></p>
                    </div>
                </div>

                <div style="background:var(--surface);border:1px solid var(--line);border-radius:var(--r2);padding:1.5rem">
                    <?php if ($submitted): ?>
                        <div style="text-align:center;padding:2rem 0">
                            <div style="font-size:3rem;margin-bottom:1rem">✅</div>
                            <h2>Message sent!</h2>
                            <p style="color:var(--muted)">We'll get back to you within 1 business hour. For urgent help, call <?php echo RT::e(RT::PHONE_DISPLAY); ?>.</p>
                        </div>
                    <?php else: ?>
                        <h3 style="margin-bottom:1rem">Send us a message</h3>
                        <form method="POST" novalidate autocomplete="on">
                            <div style="position:absolute;left:-9999px;opacity:0;height:0;overflow:hidden">
                                <input type="text" name="website" tabindex="-1" autocomplete="off">
                            </div>
                            <input type="hidden" name="contact_submit" value="1">

                            <div style="margin-bottom:1rem">
                                <label for="name" style="display:block;font-size:.85rem;font-weight:600;margin-bottom:.35rem">Your name <span style="color:var(--primary)">*</span></label>
                                <input type="text" name="name" id="name" value="<?php echo RT::e($name ?? ''); ?>" required autocomplete="name" style="width:100%;background:var(--bg);border:1px solid var(--line-2);border-radius:var(--r);padding:.7rem .85rem;font-size:.95rem;color:var(--text);font-family:inherit;outline:none">
                            </div>

                            <div style="margin-bottom:1rem">
                                <label for="email" style="display:block;font-size:.85rem;font-weight:600;margin-bottom:.35rem">Email <span style="color:var(--primary)">*</span></label>
                                <input type="email" name="email" id="email" value="<?php echo RT::e($email ?? ''); ?>" required autocomplete="email" style="width:100%;background:var(--bg);border:1px solid var(--line-2);border-radius:var(--r);padding:.7rem .85rem;font-size:.95rem;color:var(--text);font-family:inherit;outline:none">
                            </div>

                            <div style="margin-bottom:1rem">
                                <label for="phone" style="display:block;font-size:.85rem;font-weight:600;margin-bottom:.35rem">Phone</label>
                                <input type="tel" name="phone" id="phone" value="<?php echo RT::e($phone ?? ''); ?>" autocomplete="tel-national" style="width:100%;background:var(--bg);border:1px solid var(--line-2);border-radius:var(--r);padding:.7rem .85rem;font-size:.95rem;color:var(--text);font-family:inherit;outline:none">
                            </div>

                            <div style="margin-bottom:1.2rem">
                                <label for="message" style="display:block;font-size:.85rem;font-weight:600;margin-bottom:.35rem">Your message <span style="color:var(--primary)">*</span></label>
                                <textarea name="message" id="message" rows="5" required style="width:100%;background:var(--bg);border:1px solid var(--line-2);border-radius:var(--r);padding:.7rem .85rem;font-size:.95rem;color:var(--text);font-family:inherit;outline:none;resize:vertical;min-height:100px"><?php echo RT::e($message ?? ''); ?></textarea>
                            </div>

                            <?php if (!empty($errors)): ?>
                            <div style="background:var(--red-dim);border:1px solid rgba(224,72,72,.2);border-radius:var(--r);padding:.7rem 1rem;margin-bottom:1rem;color:var(--primary);font-size:.88rem">
                                Please fix the errors above before sending.
                            </div>
                            <?php endif; ?>

                            <button type="submit" style="width:100%;padding:.85rem;background:var(--accent);color:#051018;border:none;border-radius:var(--r);font-size:1rem;font-weight:600;cursor:pointer;font-family:inherit">Send message</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php rt_footer(); ?>
</body>
</html>
