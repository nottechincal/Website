<?php
/**
 * Generate sitemap.xml for the web root.
 *
 * Run from the theme root:  php tools/build-sitemap.php
 * Output:                   ../deploy/webroot/sitemap.xml
 *
 * The previous sitemap listed 74 URLs — including 14 postcode pages that
 * fatal-errored outside WordPress and 25 suburb pages that were near-duplicates
 * of one another — and stamped every single one with the same lastmod date,
 * which Google discounts as unreliable.
 *
 * This version lists only canonical, indexable URLs, takes lastmod from the
 * template's real modification time, and omits <priority> and <changefreq>
 * because Google has confirmed it ignores both.
 */

require_once __DIR__ . '/../inc/config.php';
require_once __DIR__ . '/../inc/locations.php';

$theme = dirname(__DIR__);

/** Pages that must never appear: redirects, handlers, thin or noindex pages. */
$excluded = array_merge(
    array_keys(rt_location_redirects()),
    ['404', 'book', 'functions', 'header', 'paymentpage', 'thank-you', 'index']
);

$urls = [];

/** @param string $path Root-relative path. */
$add = function (string $path, ?string $file = null) use (&$urls, $theme) {
    $mtime = $file && is_file("$theme/$file")
        ? filemtime("$theme/$file")
        : time();

    $urls[RT::url($path)] = date('Y-m-d', $mtime);
};

// Home.
$add('/', 'index.php');

// Core pages.
foreach (['about', 'service-areas', 'faq', 'blog', 'privacy-policy', 'terms-of-service'] as $slug) {
    if (is_file("$theme/$slug.php")) {
        $add("/$slug", "$slug.php");
    }
}

// Service pages.
foreach (glob("$theme/service-*.php") as $f) {
    $slug = basename($f, '.php');
    if (!in_array($slug, $excluded, true) && $slug !== 'service-areas') {
        $add("/$slug", "$slug.php");
    }
}

// Blog articles.
foreach (glob("$theme/blog-*.php") as $f) {
    $slug = basename($f, '.php');
    if (!in_array($slug, $excluded, true)) {
        $add("/$slug", "$slug.php");
    }
}

// Consolidated suburb pages.
foreach (rt_locations() as $slug => $loc) {
    $add("/computer-repairs-$slug", "computer-repairs-$slug.php");
}

// Remaining standalone service/location pages that survived consolidation.
foreach (['data-recovery-frankston', 'data-recovery-patterson-lakes',
          'emergency-computer-repair-melbourne', 'network-setup-berwick',
          'virus-removal-cranbourne', 'virus-removal-dandenong'] as $slug) {
    if (is_file("$theme/$slug.php") && !in_array($slug, $excluded, true)) {
        $add("/$slug", "$slug.php");
    }
}

ksort($urls);

$xml  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
$xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
foreach ($urls as $loc => $lastmod) {
    $xml .= "    <url>\n";
    $xml .= "        <loc>" . htmlspecialchars($loc, ENT_XML1) . "</loc>\n";
    $xml .= "        <lastmod>$lastmod</lastmod>\n";
    $xml .= "    </url>\n";
}
$xml .= "</urlset>\n";

$out = dirname($theme) . '/deploy/webroot/sitemap.xml';
@mkdir(dirname($out), 0755, true);
file_put_contents($out, $xml);

printf("sitemap.xml written: %d URLs -> %s\n", count($urls), $out);
