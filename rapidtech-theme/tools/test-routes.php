<?php
/**
 * Exercise the theme router with the WordPress API stubbed out.
 * Verifies the slug registry, that every target template exists, and that the
 * generated rewrite regexes match the URLs the sitemap advertises.
 */

$THEME = dirname(__DIR__);

$RULES = [];
$FILTERS = [];

function add_action($h, $f, $p = 10, $a = 1) {}
function add_filter($h, $f, $p = 10, $a = 1) {}
function get_option($k, $d = false) { return $d; }
function update_option($k, $v) { return true; }
function delete_option($k) { return true; }
function flush_rewrite_rules($hard = true) {}
function status_header($c) {}
function wp_enqueue_style() {}
function wp_enqueue_script() {}
function remove_action() {}
function get_query_var($v) { return ''; }
function add_rewrite_rule($regex, $query, $after = 'bottom') {
    global $RULES;
    $RULES[$regex] = $query;
}

require $THEME . '/functions.php';

chdir($THEME);
$routes = rt_routes();
rt_register_routes();

echo "routes registered: ", count($routes), "\n";
echo "rewrite rules:     ", count($RULES), "\n\n";

// 1. Every route target must exist on disk.
$missing = [];
foreach ($routes as $slug => $file) {
    if (!is_readable("$THEME/$file")) {
        $missing[] = "$slug -> $file";
    }
}
echo "missing templates: ", count($missing), "\n";
foreach ($missing as $m) echo "   $m\n";

// 2. Every URL in the sitemap must match exactly one rewrite rule.
$xml = simplexml_load_file(dirname($THEME) . '/deploy/webroot/sitemap.xml');
$unmatched = [];
$matched = 0;
foreach ($xml->url as $u) {
    $path = trim(parse_url((string) $u->loc, PHP_URL_PATH), '/');
    if ($path === '') { $matched++; continue; }   // home is WordPress's own
    $hit = false;
    foreach ($RULES as $regex => $q) {
        if (preg_match('#' . $regex . '#', $path)) { $hit = true; break; }
    }
    $hit ? $matched++ : $unmatched[] = $path;
}
echo "\nsitemap URLs matched by a route: $matched\n";
echo "sitemap URLs with NO route:      ", count($unmatched), "\n";
foreach ($unmatched as $u) echo "   $u\n";

// 3. Every retired slug must still route, or its 301 never fires.
$dead = [];
foreach (array_keys(rt_location_redirects()) as $slug) {
    $hit = false;
    foreach ($RULES as $regex => $q) {
        if (preg_match('#' . $regex . '#', $slug)) { $hit = true; break; }
    }
    if (!$hit) $dead[] = $slug;
}
echo "\nretired slugs that would 404 instead of 301: ", count($dead), "\n";
foreach ($dead as $d) echo "   $d\n";

// 4. Routes must not swallow WordPress internals.
$reserved = ['wp-admin', 'wp-login.php', 'wp-json/wp/v2/posts', 'feed', 'index.php'];
$clashes = [];
foreach ($reserved as $r) {
    foreach ($RULES as $regex => $q) {
        if (preg_match('#' . $regex . '#', $r)) { $clashes[] = "$r matched by $regex"; }
    }
}
echo "\nclashes with WordPress internals: ", count($clashes), "\n";
foreach ($clashes as $c) echo "   $c\n";

$fail = count($missing) + count($unmatched) + count($dead) + count($clashes);
echo "\n", $fail === 0 ? "PASS\n" : "FAIL ($fail problems)\n";
exit($fail === 0 ? 0 : 1);
