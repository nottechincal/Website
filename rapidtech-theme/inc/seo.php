<?php
/**
 * Shared <head>, chrome and structured-data rendering.
 *
 * Every public page should build its head through rt_head() so that titles,
 * canonicals, Open Graph tags and analytics stay consistent. Previously each
 * of 85 templates carried its own copy, which is how the site ended up with
 * 52 over-length titles, 25 missing canonicals and an og:image pointing at a
 * file that did not exist.
 */

require_once __DIR__ . '/config.php';

/**
 * Render the complete <head> for a page.
 *
 * @param array $a {
 *   @type string $title        Required. Aim for <= 60 chars; longer titles
 *                              get truncated in search results.
 *   @type string $description  Required. 120-160 characters.
 *   @type string $path         Required. Root-relative canonical path, e.g. '/about'.
 *   @type string $og_type      'website' (default) or 'article'.
 *   @type string $image        Root-relative share image. Defaults to RT::OG_IMAGE.
 *   @type bool   $noindex      Emit noindex,follow. Default false.
 *   @type array  $schema       Extra JSON-LD nodes to emit (each a PHP array).
 *   @type string $css          Extra stylesheet path relative to the theme.
 * }
 */
function rt_head(array $a): void
{
    $title = $a['title'] ?? RT::NAME;
    $desc  = $a['description'] ?? '';
    $path  = $a['path'] ?? '/';
    $image = RT::url($a['image'] ?? RT::OG_IMAGE);
    $canon = RT::url($path);
    $type  = $a['og_type'] ?? 'website';
    ?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo RT::e($title); ?></title>
<meta name="description" content="<?php echo RT::e($desc); ?>">
<meta name="robots" content="<?php echo !empty($a['noindex']) ? 'noindex, follow' : 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1'; ?>">
<meta name="author" content="<?php echo RT::e(RT::NAME); ?>">
<link rel="canonical" href="<?php echo RT::e($canon); ?>">

<meta property="og:site_name" content="<?php echo RT::e(RT::NAME); ?>">
<meta property="og:locale" content="<?php echo RT::LOCALE; ?>">
<meta property="og:type" content="<?php echo RT::e($type); ?>">
<meta property="og:title" content="<?php echo RT::e($a['og_title'] ?? $title); ?>">
<meta property="og:description" content="<?php echo RT::e($desc); ?>">
<meta property="og:url" content="<?php echo RT::e($canon); ?>">
<meta property="og:image" content="<?php echo RT::e($image); ?>">
<meta property="og:image:width" content="<?php echo RT::OG_W; ?>">
<meta property="og:image:height" content="<?php echo RT::OG_H; ?>">
<meta property="og:image:alt" content="<?php echo RT::e(RT::NAME . ' — computer repairs and IT support, Melbourne'); ?>">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo RT::e($a['og_title'] ?? $title); ?>">
<meta name="twitter:description" content="<?php echo RT::e($desc); ?>">
<meta name="twitter:image" content="<?php echo RT::e($image); ?>">

<link rel="icon" type="image/svg+xml" href="<?php echo RT::e(RT::asset('images/favicon.svg')); ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo RT::e(RT::asset('images/favicon.png')); ?>">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo RT::e(RT::asset('images/logo.png')); ?>"><!-- TODO: replace logo.png with a dedicated 180×180 apple-touch-icon.png -->

<?php /* Self-hosted: removes two render-blocking third-party round trips. */ ?>
<link rel="preload" href="<?php echo RT::e(RT::asset('fonts/space-grotesk/space-grotesk-latin.woff2')); ?>" as="font" type="font/woff2" crossorigin>
<link rel="stylesheet" href="<?php echo RT::e(RT::asset('css/styles.css')); ?>">
<?php if (!empty($a['css'])) : ?>
<link rel="stylesheet" href="<?php echo RT::e(RT::asset($a['css'])); ?>">
<?php endif; ?>
<?php
    foreach ((array) ($a['schema'] ?? []) as $node) {
        RT::json_ld($node);
    }
    rt_analytics();
}

/** Google Analytics. Loaded once, from one place. */
function rt_analytics(): void
{
    ?>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo RT::GA_MEASUREMENT_ID; ?>"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', '<?php echo RT::GA_MEASUREMENT_ID; ?>');
</script>
<?php
}

/**
 * Breadcrumb trail plus its BreadcrumbList schema.
 *
 * @param array $trail Ordered [label => root-relative path]. The final entry
 *                     is rendered as the current page (no link).
 */
function rt_breadcrumbs(array $trail): void
{
    $items = [];
    $i     = 0;
    $all   = array_merge(['Home' => '/'], $trail);

    echo '<nav class="breadcrumbs" aria-label="Breadcrumb"><ol>';

    $last = array_key_last($all);
    foreach ($all as $label => $path) {
        $i++;
        $items[] = [
            '@type'    => 'ListItem',
            'position' => $i,
            'name'     => $label,
            'item'     => RT::url($path),
        ];

        if ($label === $last) {
            echo '<li aria-current="page">', RT::e($label), '</li>';
        } else {
            echo '<li><a href="', RT::e($path), '">', RT::e($label), '</a></li>';
        }
    }

    echo '</ol></nav>';

    RT::json_ld([
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => $items,
    ]);
}

/** Site header and primary navigation. */
function rt_header(): void
{
    ?>
<a class="skip-link" href="#main">Skip to content</a>
<header class="site-header" role="banner">
    <div class="container header-inner">
        <a class="brand" href="/">
            <span class="brand-mark lightning-animated" aria-hidden="true"></span>
            <?php echo RT::e(RT::NAME); ?>
        </a>
        <button class="menu-toggle" aria-expanded="false" aria-controls="primary-nav">
            <span class="sr-only">Toggle navigation</span>
            <span class="menu-toggle-bars" aria-hidden="true"></span>
        </button>
        <nav id="primary-nav" class="primary-nav" aria-label="Main navigation">
            <a href="/service-computer-repairs/">Computer Repairs</a>
            <a href="/service-virus-removal/">Virus Removal</a>
            <a href="/service-data-recovery/">Data Recovery</a>
            <a href="/service-areas/">Service Areas</a>
            <a href="/blog/">Blog</a>
            <a href="/faq/">FAQ</a>
            <a href="/#contact" class="btn btn-outline">Get in Touch</a>
        </nav>
    </div>
</header>
<div class="emergency-banner">
    <div class="container">
        <span>Same-day emergency service available</span>
        <a href="tel:<?php echo RT::PHONE_E164; ?>">Call <?php echo RT::e(RT::PHONE_DISPLAY); ?></a>
    </div>
</div>
<?php
}

/** Site footer. */
function rt_footer(): void
{
    $year = date('Y');
    ?>
<footer class="site-footer" role="contentinfo">
    <div class="container footer-grid">
        <div>
            <p class="footer-brand"><?php echo RT::e(RT::NAME); ?></p>
            <p><?php echo RT::e(RT::LOCALITY); ?>, <?php echo RT::REGION; ?> <?php echo RT::POSTCODE; ?></p>
            <p>ABN <?php echo RT::e(RT::ABN); ?></p>
            <p><?php echo RT::e(RT::HOURS_TEXT); ?></p>
        </div>
        <div>
            <h2>Services</h2>
            <ul>
                <?php foreach (RT::SERVICES as $slug => $s) : ?>
                <li><a href="/service-<?php echo RT::e($slug); ?>/"><?php echo RT::e($s['name']); ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div>
            <h2>Company</h2>
            <ul>
                <li><a href="/about/">About</a></li>
                <li><a href="/service-areas/">Service Areas</a></li>
                <li><a href="/blog/">Blog</a></li>
                <li><a href="/faq/">FAQ</a></li>
                <li><a href="/privacy-policy/">Privacy Policy</a></li>
                <li><a href="/terms-of-service/">Terms of Service</a></li>
            </ul>
        </div>
        <div>
            <h2>Contact</h2>
            <ul>
                <li><a href="tel:<?php echo RT::PHONE_E164; ?>"><?php echo RT::e(RT::PHONE_DISPLAY); ?></a></li>
                <li><a href="mailto:<?php echo RT::EMAIL; ?>"><?php echo RT::EMAIL; ?></a></li>
                <li><a href="<?php echo RT::WHATSAPP; ?>" rel="noopener">WhatsApp</a></li>
            </ul>
        </div>
    </div>
    <div class="container footer-bottom">
        <p>&copy; <?php echo $year; ?> <?php echo RT::e(RT::NAME); ?>. All rights reserved.</p>
    </div>
</footer>
<script src="<?php echo RT::e(RT::asset('js/main.js')); ?>" defer></script>
<?php
}
