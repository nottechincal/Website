<?php
// Define base path - works with or without WordPress
if (function_exists('get_template_directory_uri')) {
    $base_path = get_template_directory_uri();
} else {
    $script_dir = dirname($_SERVER['SCRIPT_NAME']);
    $base_path = ($script_dir === '/' || $script_dir === '\\') ? '' : $script_dir;
}
?>
<!DOCTYPE html>
<html lang="en-AU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You | Rapid Tech Solutions</title>
    <meta name="robots" content="noindex, follow">
    <link rel="icon" type="image/png" href="<?php echo $base_path; ?>/images/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="<?php echo $base_path; ?>/css/styles.css" rel="stylesheet">
</head>
<body>
    <header class="site-header" role="banner">
        <div class="container header-inner">
            <a class="brand" href="/">
                <span class="brand-mark lightning-animated" aria-hidden="true"></span>
                Rapid Tech Solutions
            </a>
            <nav class="primary-nav">
                <a href="<?php echo $base_path; ?>/index.php#services">Services</a>
                <a href="tel:+61423680596" class="btn btn-outline">Call Us</a>
            </nav>
        </div>
    </header>

    <main id="main">
        <section class="section" style="min-height: 60vh; display: flex; align-items: center;">
            <div class="container" style="text-align: center; max-width: 700px;">
                <div style="background: rgba(0, 255, 204, 0.1); width: 100px; height: 100px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem;">
                    <i class="fas fa-check" style="font-size: 3rem; color: #00ffcc;"></i>
                </div>
                <h1 style="margin-bottom: 1rem;">Thank You!</h1>
                <p style="font-size: 1.2rem; margin-bottom: 2rem; color: var(--muted);">
                    We've received your message and will get back to you shortly. Our team typically responds within 1-2 hours during business hours.
                </p>

                <div style="background: rgba(255, 255, 255, 0.05); padding: 2rem; border-radius: 16px; border: 1px solid rgba(255, 255, 255, 0.08); margin-bottom: 2rem; text-align: left;">
                    <h3 style="margin-bottom: 1rem; color: var(--text);">What Happens Next?</h3>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="display: flex; gap: 1rem; margin-bottom: 1rem; color: var(--muted);">
                            <i class="fas fa-phone-alt" style="color: var(--accent); margin-top: 0.2rem;"></i>
                            <span>We'll call or email you to discuss your issue</span>
                        </li>
                        <li style="display: flex; gap: 1rem; margin-bottom: 1rem; color: var(--muted);">
                            <i class="fas fa-clipboard-check" style="color: var(--accent); margin-top: 0.2rem;"></i>
                            <span>We'll provide a free diagnostic and clear quote</span>
                        </li>
                        <li style="display: flex; gap: 1rem; margin-bottom: 1rem; color: var(--muted);">
                            <i class="fas fa-calendar-check" style="color: var(--accent); margin-top: 0.2rem;"></i>
                            <span>We'll schedule a time that works for you</span>
                        </li>
                        <li style="display: flex; gap: 1rem; color: var(--muted);">
                            <i class="fas fa-tools" style="color: var(--accent); margin-top: 0.2rem;"></i>
                            <span>We'll fix your problem—no surprises, no hidden fees</span>
                        </li>
                    </ul>
                </div>

                <p style="color: var(--muted); margin-bottom: 1.5rem;">
                    <strong>Need immediate help?</strong> Call us directly:
                </p>
                <a href="tel:+61423680596" class="btn" style="margin-right: 1rem;">
                    <i class="fas fa-phone"></i> 0423 680 596
                </a>
                <a href="/" class="btn btn-outline">
                    <i class="fas fa-home"></i> Return to Homepage
                </a>
            </div>
        </section>

        <!-- Helpful Resources -->
        <section style="background: rgba(255, 255, 255, 0.02); padding: 3rem 0;">
            <div class="container" style="text-align: center;">
                <h3 style="margin-bottom: 2rem;">While You Wait, Check Out Our Free Guides</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; max-width: 900px; margin: 0 auto;">
                    <a href="<?php echo $base_path; ?>/blog-scam-protection.php" style="background: rgba(255, 255, 255, 0.05); padding: 1.5rem; border-radius: 12px; text-decoration: none; color: var(--text); transition: all 0.3s ease; border: 1px solid rgba(255, 255, 255, 0.08);">
                        <i class="fas fa-shield-alt" style="color: #ff9500; font-size: 1.5rem; margin-bottom: 0.75rem; display: block;"></i>
                        <strong style="display: block; margin-bottom: 0.5rem;">Protect From Scams</strong>
                        <span style="color: var(--muted); font-size: 0.9rem;">Learn to spot fake tech support calls</span>
                    </a>
                    <a href="<?php echo $base_path; ?>/blog-password-security.php" style="background: rgba(255, 255, 255, 0.05); padding: 1.5rem; border-radius: 12px; text-decoration: none; color: var(--text); transition: all 0.3s ease; border: 1px solid rgba(255, 255, 255, 0.08);">
                        <i class="fas fa-lock" style="color: #29d5ff; font-size: 1.5rem; margin-bottom: 0.75rem; display: block;"></i>
                        <strong style="display: block; margin-bottom: 0.5rem;">Password Security</strong>
                        <span style="color: var(--muted); font-size: 0.9rem;">Create strong passwords easily</span>
                    </a>
                    <a href="<?php echo $base_path; ?>/blog-computer-maintenance.php" style="background: rgba(255, 255, 255, 0.05); padding: 1.5rem; border-radius: 12px; text-decoration: none; color: var(--text); transition: all 0.3s ease; border: 1px solid rgba(255, 255, 255, 0.08);">
                        <i class="fas fa-tools" style="color: #00ffcc; font-size: 1.5rem; margin-bottom: 0.75rem; display: block;"></i>
                        <strong style="display: block; margin-bottom: 0.5rem;">Computer Maintenance</strong>
                        <span style="color: var(--muted); font-size: 0.9rem;">Keep your PC running fast</span>
                    </a>
                </div>
            </div>
        </section>
    </main>

    <footer class="site-footer" role="contentinfo">
        <div class="container">
            <div style="text-align: center; padding: 1rem 0; border-top: 1px solid rgba(255,255,255,0.1); margin-top: 1rem;">
                <a href="<?php echo $base_path; ?>/privacy-policy.php" style="color: var(--muted); margin: 0 1rem;">Privacy Policy</a>
                <a href="<?php echo $base_path; ?>/terms-of-service.php" style="color: var(--muted); margin: 0 1rem;">Terms of Service</a>
            </div>
            <p class="footer-note">© <?php echo date('Y'); ?> Rapid Tech Solutions. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
