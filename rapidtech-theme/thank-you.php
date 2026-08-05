<?php
/*
Template Name: Thank You
*/
require_once __DIR__ . '/inc/config.php';
require_once __DIR__ . '/inc/seo.php';
require_once __DIR__ . '/inc/icons.php';
?>
<!DOCTYPE html>
<html lang="<?php echo RT::LANG; ?>">
<head>
<?php rt_head([
    'title'       => 'Thank You | ' . RT::NAME,
    'description' => 'Thanks for getting in touch. We will respond within one business hour during opening hours.',
    'path'        => '/thank-you/',
    'noindex'     => true,
]); ?>
</head>
<body>
<?php rt_header(); ?>

    <main id="main">
        <section class="section" style="min-height: 60vh; display: flex; align-items: center;">
            <div class="container" style="text-align: center; max-width: 700px;">
                <div style="background: rgba(0, 255, 204, 0.1); width: 100px; height: 100px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem;">
                    <?php echo rt_icon('check', 'icon-2xl'); ?>
                </div>
                <h1 style="margin-bottom: 1rem;">Thank You!</h1>
                <p style="font-size: 1.2rem; margin-bottom: 2rem; color: var(--muted);">
                    We've received your message and will get back to you shortly. Our team typically responds within 1-2 hours during business hours.
                </p>

                <div style="background: rgba(255, 255, 255, 0.05); padding: 2rem; border-radius: 16px; border: 1px solid rgba(255, 255, 255, 0.08); margin-bottom: 2rem; text-align: left;">
                    <h3 style="margin-bottom: 1rem; color: var(--text);">What Happens Next?</h3>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="display: flex; gap: 1rem; margin-bottom: 1rem; color: var(--muted);">
                            <?php echo rt_icon('phone'); ?>
                            <span>We'll call or email you to discuss your issue</span>
                        </li>
                        <li style="display: flex; gap: 1rem; margin-bottom: 1rem; color: var(--muted);">
                            <?php echo rt_icon('check'); ?>
                            <span>We'll provide a free diagnostic and clear quote</span>
                        </li>
                        <li style="display: flex; gap: 1rem; margin-bottom: 1rem; color: var(--muted);">
                            <?php echo rt_icon('calendar'); ?>
                            <span>We'll schedule a time that works for you</span>
                        </li>
                        <li style="display: flex; gap: 1rem; color: var(--muted);">
                            <?php echo rt_icon('wrench'); ?>
                            <span>We'll fix your problem—no surprises, no hidden fees</span>
                        </li>
                    </ul>
                </div>

                <p style="color: var(--muted); margin-bottom: 1.5rem;">
                    <strong>Need immediate help?</strong> Call us directly:
                </p>
                <a href="tel:<?php echo RT::PHONE_E164; ?>" class="btn" style="margin-right: 1rem;">
                    <?php echo rt_icon('phone'); ?> <?php echo RT::e(RT::PHONE_DISPLAY); ?>
                </a>
                <a href="/" class="btn btn-outline">
                    <?php echo rt_icon('home'); ?> Return to Homepage
                </a>
            </div>
        </section>

        <!-- Helpful Resources -->
        <section style="background: rgba(255, 255, 255, 0.02); padding: 3rem 0;">
            <div class="container" style="text-align: center;">
                <h3 style="margin-bottom: 2rem;">While You Wait, Check Out Our Free Guides</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; max-width: 900px; margin: 0 auto;">
                    <a href="/blog-scam-protection/" style="background: rgba(255, 255, 255, 0.05); padding: 1.5rem; border-radius: 12px; text-decoration: none; color: var(--text); transition: all 0.3s ease; border: 1px solid rgba(255, 255, 255, 0.08);">
                        <?php echo rt_icon('shield', 'icon-orange'); ?>
                        <strong style="display: block; margin: 0.75rem 0 0.5rem;">Protect From Scams</strong>
                        <span style="color: var(--muted); font-size: 0.9rem;">Learn to spot fake tech support calls</span>
                    </a>
                    <a href="/blog-password-security/" style="background: rgba(255, 255, 255, 0.05); padding: 1.5rem; border-radius: 12px; text-decoration: none; color: var(--text); transition: all 0.3s ease; border: 1px solid rgba(255, 255, 255, 0.08);">
                        <?php echo rt_icon('lock'); ?>
                        <strong style="display: block; margin: 0.75rem 0 0.5rem;">Password Security</strong>
                        <span style="color: var(--muted); font-size: 0.9rem;">Create strong passwords easily</span>
                    </a>
                    <a href="/blog-computer-maintenance/" style="background: rgba(255, 255, 255, 0.05); padding: 1.5rem; border-radius: 12px; text-decoration: none; color: var(--text); transition: all 0.3s ease; border: 1px solid rgba(255, 255, 255, 0.08);">
                        <?php echo rt_icon('wrench'); ?>
                        <strong style="display: block; margin: 0.75rem 0 0.5rem;">Computer Maintenance</strong>
                        <span style="color: var(--muted); font-size: 0.9rem;">Keep your PC running fast</span>
                    </a>
                </div>
            </div>
        </section>
    </main>

<?php rt_footer(); ?>
</body>
</html>
