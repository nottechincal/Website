<?php
/**
 * Generate the suburb page files and the 301 stubs for retired slugs.
 * Run from the theme root: php tools/build-pages.php
 */
require_once __DIR__ . '/../inc/locations.php';

$root = dirname(__DIR__);
$made = $stubs = 0;

foreach (rt_locations() as $slug => $loc) {
    $file = "$root/computer-repairs-$slug.php";
    file_put_contents($file, <<<PHP_TPL
<?php
/*
Template Name: Suburb: {$loc['suburb']} ({$loc['postcode']})
*/
require_once __DIR__ . '/inc/location-template.php';
render_location_page('$slug');

PHP_TPL);
    $made++;
}

/*
 * PHP-level 301s. The web-root .htaccess handles these before PHP runs, but
 * these stubs mean the redirect still works if the file is hit directly —
 * which is exactly how these pages were reachable before.
 */
foreach (rt_location_redirects() as $from => $to) {
    file_put_contents("$root/$from.php", <<<PHP_TPL
<?php
/*
Template Name: Redirect: $from
Consolidated into $to — see inc/locations.php.
*/
header('HTTP/1.1 301 Moved Permanently');
header('Location: https://rapidtechsolutions.au$to', true, 301);
exit;

PHP_TPL);
    $stubs++;
}

echo "generated $made suburb pages, $stubs redirect stubs\n";
