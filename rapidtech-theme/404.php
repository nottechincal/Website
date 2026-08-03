<?php
/*
Template Name: 404 Not Found
*/
require_once __DIR__ . '/inc/config.php';
require_once __DIR__ . '/inc/seo.php';
require_once __DIR__ . '/inc/icons.php';
http_response_code(404);
?><!DOCTYPE html>
<html lang="<?php echo RT::LANG; ?>">
<head>
<?php rt_head([
    'title'       => 'Page Not Found | ' . RT::NAME,
    'description' => 'That page could not be found. Browse our computer repair services or call ' . RT::PHONE_DISPLAY . ' for help.',
    'path'        => '/404',
    'noindex'     => true,
]); ?>
<style>
    .error-page {
        min-height: 60vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 2rem;
    }
    .error-content {
        max-width: 600px;
    }
    .error-code {
        font-size: 8rem;
        font-weight: 700;
        color: var(--primary);
        line-height: 1;
        margin-bottom: 1rem;
    }
    .error-title {
        font-size: 2rem;
        margin-bottom: 1rem;
        color: var(--text);
    }
    .error-message {
        color: var(--muted);
        font-size: 1.1rem;
        margin-bottom: 2rem;
        line-height: 1.6;
    }
    .error-actions {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }
    .helpful-links {
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 1px solid rgba(255,255,255,0.1);
    }
    .helpful-links h3 {
        color: var(--text);
        margin-bottom: 1rem;
    }
    .helpful-links ul {
        list-style: none;
        padding: 0;
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        justify-content: center;
    }
    .helpful-links a {
        color: var(--accent);
        text-decoration: none;
        padding: 0.5rem 1rem;
        background: rgba(41, 213, 255, 0.1);
        border-radius: 8px;
        transition: background 0.3s;
    }
    .helpful-links a:hover {
        background: rgba(41, 213, 255, 0.2);
    }
</style>
</head>
<body>
<?php rt_header(); ?>

<main class="error-page">
    <div class="error-content">
        <div class="error-code">404</div>
        <h1 class="error-title">Page Not Found</h1>
        <p class="error-message">
            Oops! The page you're looking for seems to have gone missing. Don't worry—it happens to the best of us. The page may have been moved, deleted, or you might have typed the address incorrectly.
        </p>
        <div class="error-actions">
            <a href="/" class="btn btn-primary">
                <?php echo rt_icon('home'); ?> Go to Homepage
            </a>
            <a href="tel:<?php echo RT::PHONE_E164; ?>" class="btn btn-outline">
                <?php echo rt_icon('phone'); ?> Call <?php echo RT::e(RT::PHONE_DISPLAY); ?>
            </a>
        </div>

        <div class="helpful-links">
            <h3>Helpful Links</h3>
            <ul>
                <li><a href="/#services">Our Services</a></li>
                <li><a href="/service-computer-repairs/">Computer Repairs</a></li>
                <li><a href="/service-data-recovery/">Data Recovery</a></li>
                <li><a href="/blog/">Blog Articles</a></li>
                <li><a href="/about/">About Us</a></li>
                <li><a href="/#faq">FAQ</a></li>
            </ul>
        </div>
    </div>
</main>

<?php rt_footer(); ?>
</body>
</html>
