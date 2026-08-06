<?php
/**
 * One-click cache purge for the Rapid Tech theme.
 *
 * Hit this file in a browser or via curl whenever you deploy:
 *   https://rapidtechsolutions.au/wp-content/themes/rapidtech-theme/purge-cache.php
 *
 * It clears PHP OPcache and touches a version file so every asset URL
 * gets a fresh cache-busting query string.
 */

$version_file = __DIR__ . '/.version';

// 1. Clear PHP OPcache
if (function_exists('opcache_reset')) {
    opcache_reset();
    echo "[OK] OPcache cleared\n";
} else {
    echo "[--] OPcache not enabled\n";
}

// 2. Update version file — this feeds the ?v= parameter on all assets
$new_version = time();
file_put_contents($version_file, $new_version);
echo "[OK] Asset version bumped to {$new_version}\n";

// 3. Touch all CSS/JS files so their filemtime updates
foreach (glob(__DIR__ . '/css/*.css') as $f) { touch($f); }
foreach (glob(__DIR__ . '/js/*.js') as $f)   { touch($f); }
echo "[OK] CSS/JS file timestamps refreshed\n";

// 4. WordPress object cache (if W3TC or similar is active)
if (function_exists('wp_cache_flush')) {
    wp_cache_flush();
    echo "[OK] WordPress object cache flushed\n";
}

echo "\nDone. Hard-refresh your browser (Ctrl+Shift+R).\n";
