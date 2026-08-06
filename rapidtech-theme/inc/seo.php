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
 *   @type string|array $css    Extra stylesheet path(s) relative to the theme.
 *   @type string $inline_css   Raw CSS to emit in a <style> block. Avoid if possible.
 *   @type string $extra_head   Raw HTML injected before closing </head>.
 *   @type string $og_title     Custom OG title (defaults to $title).
 *   @type string $article_published  ISO 8601 publish date (for og_type=article).
 *   @type string $article_modified   ISO 8601 modified date.
 *   @type string $article_author     Author name.
 *   @type string $article_section    Article category.
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
<meta name="color-scheme" content="dark">
<script>if('IntersectionObserver' in window){document.documentElement.className+=' js-anim';}</script>
<title><?php echo RT::e($title); ?></title>
<meta name="description" content="<?php echo RT::e($desc); ?>">
<meta name="robots" content="<?php echo !empty($a['noindex']) ? 'noindex, follow' : 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1'; ?>">
<meta name="author" content="<?php echo RT::e($a['article_author'] ?? RT::NAME); ?>">
<link rel="canonical" href="<?php echo RT::e($canon); ?>">
<?php if ($type === 'article') : ?>
<meta property="article:published_time" content="<?php echo RT::e($a['article_published'] ?? ''); ?>">
<meta property="article:modified_time" content="<?php echo RT::e($a['article_modified'] ?? ''); ?>">
<meta property="article:author" content="<?php echo RT::e($a['article_author'] ?? RT::NAME); ?>">
<meta property="article:section" content="<?php echo RT::e($a['article_section'] ?? ''); ?>">
<?php endif; ?>
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
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo RT::e(RT::asset('images/logo.png')); ?>">

<?php /* Self-hosted: removes two render-blocking third-party round trips. */ ?>
<link rel="preload" href="<?php echo RT::e(RT::asset('fonts/space-grotesk/space-grotesk-latin.woff2')); ?>" as="font" type="font/woff2" crossorigin>
<link rel="stylesheet" href="<?php echo RT::e(RT::asset('css/styles.css')); ?>?v=<?php echo filemtime(RT::path('css/styles.css')); ?>">
<?php foreach ((array) ($a['css'] ?? []) as $css) : ?>
<link rel="stylesheet" href="<?php echo RT::e(RT::asset($css)); ?>?v=<?php echo filemtime(RT::path($css)); ?>">
<?php endforeach; ?>
<?php if (!empty($a['inline_css'])) : ?>
<style><?php echo $a['inline_css']; ?></style>
<?php endif; ?>
<?php if (!empty($a['extra_head'])) { echo $a['extra_head']; } ?>
<?php
    foreach ((array) ($a['schema'] ?? []) as $node) {
        RT::json_ld($node);
    }
    rt_analytics();
}

/**
 * Google Analytics. Loaded once, from one place.
 *
 * Uses Google's Consent Mode v2: analytics_storage defaults to denied until
 * the cookie banner (see rt_cookie_banner()) records a choice, so GA4 does
 * not set cookies before the visitor has actually agreed to it. If a choice
 * was already made on an earlier visit, the inline script below applies it
 * immediately rather than waiting for the banner's own script to run.
 */
function rt_analytics(): void
{
    ?>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('consent', 'default', {
  'analytics_storage': 'denied',
  'ad_storage': 'denied',
  'ad_user_data': 'denied',
  'ad_personalization': 'denied'
});
<?php if (($_COOKIE['rt_consent'] ?? '') === 'granted') : ?>
gtag('consent', 'update', { 'analytics_storage': 'granted' });
<?php endif; ?>
gtag('js', new Date());
gtag('config', '<?php echo RT::GA_MEASUREMENT_ID; ?>');
</script>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo RT::GA_MEASUREMENT_ID; ?>"></script>
<?php
}

/**
 * Cookie consent banner.
 *
 * Minimal, dark-themed, no external dependency. Stores the visitor's choice
 * in both localStorage (fast client-side check) and a first-party cookie
 * (so rt_analytics() above can read it server-side on the very next page
 * load, before any JS runs — otherwise a visitor who already said yes would
 * see analytics start denied-then-granted on every single page).
 */
function rt_cookie_banner(): void
{
    ?>
<div id="rt-cookie-banner" class="cookie-banner" role="dialog" aria-live="polite" aria-label="Cookie consent" hidden>
  <div class="cookie-banner-inner">
    <p>We use cookies for basic analytics to understand how visitors use this site. No personal data is sold or shared with advertisers.
       <a href="/privacy-policy/">Privacy Policy</a></p>
    <div class="cookie-banner-actions">
      <button type="button" id="rt-cookie-decline" class="btn btn-outline">Decline</button>
      <button type="button" id="rt-cookie-accept" class="btn">Accept</button>
    </div>
  </div>
</div>
<script>
(function(){
  var KEY = 'rt_consent';
  function setCookie(val){
    document.cookie = KEY + '=' + val + ';path=/;max-age=' + (60*60*24*365) + ';SameSite=Lax';
  }
  var stored = localStorage.getItem(KEY);
  var banner = document.getElementById('rt-cookie-banner');
  if (!stored) {
    if (banner) banner.hidden = false;
  }
  var acceptBtn = document.getElementById('rt-cookie-accept');
  var declineBtn = document.getElementById('rt-cookie-decline');
  if (acceptBtn) acceptBtn.addEventListener('click', function(){
    localStorage.setItem(KEY, 'granted');
    setCookie('granted');
    if (typeof gtag === 'function') gtag('consent', 'update', { 'analytics_storage': 'granted' });
    if (banner) banner.hidden = true;
  });
  if (declineBtn) declineBtn.addEventListener('click', function(){
    localStorage.setItem(KEY, 'denied');
    setCookie('denied');
    if (banner) banner.hidden = true;
  });
})();
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

/** Site header and primary navigation.
 *
 * @param bool  $home       When true, also emits the WhatsApp widget and sticky CTA
 *                          that are part of the homepage chrome.
 * @param array $nav_links  Override nav links as [label => href]. Empty = default
 *                          absolute-URL nav. Hash anchors for homepage.
 */
function rt_header(bool $home = false, array $nav_links = []): void
{
    if (empty($nav_links)) {
        $nav_links = [
            'Computer Repairs' => '/service-computer-repairs/',
            'Virus Removal'    => '/service-virus-removal/',
            'Data Recovery'    => '/service-data-recovery/',
            'Network & Wi-Fi'  => '/service-network-wifi/',
            'Service Areas'    => '/service-areas/',
            'Blog'             => '/blog/',
            'FAQ'              => '/faq/',
            'Book a Repair'    => '/book/',
        ];
    }
    ?>
<a class="skip-link" href="#main">Skip to content</a>
<header class="site-header" role="banner">
    <div class="container wrap">
        <a class="brand" href="/">
            <span class="brand-mark lightning-animated" aria-hidden="true"></span>
            <?php echo RT::e(RT::NAME); ?>
        </a>
        <button class="menu-toggle" aria-expanded="false" aria-controls="primary-nav">
            <span class="sr-only">Toggle navigation</span>
            <span class="menu-toggle-bars" aria-hidden="true"></span>
        </button>
        <nav id="primary-nav" class="primary-nav" aria-label="Main navigation">
            <?php foreach ($nav_links as $label => $href) : ?>
            <a href="<?php echo RT::e($href); ?>"><?php echo RT::e($label); ?></a>
            <?php endforeach; ?>
        </nav>
    </div>
</header>
<div class="nav-backdrop"></div>
<div class="emergency-banner">
    <div class="container">
        <span>Same-day emergency service available</span>
        <a href="tel:<?php echo RT::PHONE_E164; ?>">Call <?php echo RT::e(RT::PHONE_DISPLAY); ?></a>
    </div>
</div>
<?php
    if ($home) {
        rt_whatsapp_widget();
    }
}

/** WhatsApp floating action button, popup dialog, and sticky CTA.
 *  Only emitted on the homepage. */
function rt_whatsapp_widget(): void
{
    ?>
<!-- WhatsApp chat popup -->
<button class="wa-fab" aria-label="Chat on WhatsApp" aria-haspopup="dialog">
  <svg class="icon icon-whatsapp-fab" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false" width="24" height="24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
</button>
<div class="wa-popup" id="waPopup" role="dialog" aria-modal="true" aria-label="Chat with us on WhatsApp" hidden>
  <div class="wa-popup-header">
    <span>Chat with us</span>
    <button id="waClose" aria-label="Close chat">&times;</button>
  </div>
  <div class="wa-popup-body">
    <p>Type your message and we'll reply on WhatsApp — usually within minutes during business hours (Mon–Fri 9am–5pm).</p>
    <label for="waInput" class="sr-only">Your message</label>
    <textarea id="waInput" rows="3" placeholder="Hi, I need help with..."></textarea>
    <button id="waSend" class="wa-send-btn">Send via WhatsApp</button>
  </div>
</div>
<a class="sticky-cta" href="tel:<?php echo RT::PHONE_E164; ?>" data-track="sticky-cta" aria-label="Call now">Call now</a>
<?php
}

/** Site footer. */
function rt_footer(): void
{
    $year = date('Y');
    ?>
<footer class="site-footer" role="contentinfo">
    <div class="container fg">
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
                <li><a href="/book/">Book a Repair</a></li>
                <li><a href="/pricing/">Pricing</a></li>
                <li><a href="/service-areas/">Service Areas</a></li>
                <li><a href="/reviews/">Reviews</a></li>
                <li><a href="/blog/">Blog</a></li>
                <li><a href="/faq/">FAQ</a></li>
                <li><a href="/privacy-policy/">Privacy Policy</a></li>
                <li><a href="/terms-of-service/">Terms of Service</a></li>
                <li><a href="/orderline/">Orderline &mdash; Procurement Software</a></li>
            </ul>
        </div>
        <div>
            <h2>Contact</h2>
            <ul>
                <li><a href="/contact/">Contact Form</a></li>
                <li><a href="tel:<?php echo RT::PHONE_E164; ?>"><?php echo RT::e(RT::PHONE_DISPLAY); ?></a></li>
                <li><a href="mailto:<?php echo RT::EMAIL; ?>"><?php echo RT::EMAIL; ?></a></li>
                <li><a href="<?php echo RT::WHATSAPP; ?>" rel="noopener">WhatsApp</a></li>
                <li><a href="<?php echo RT::GOOGLE_REVIEW_URL; ?>" rel="noopener nofollow" target="_blank">Leave a Google Review</a></li>
            </ul>
        </div>
    </div>
    <div class="container fb">
        <p>&copy; <?php echo $year; ?> <?php echo RT::e(RT::NAME); ?>. All rights reserved.</p>
    </div>
</footer>
<?php rt_cookie_banner(); ?>
<script src="<?php echo RT::e(RT::asset('js/main.js')); ?>?v=<?php echo filemtime(RT::path('js/main.js')); ?>" defer></script>
<?php
}
