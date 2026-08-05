<?php
/**
 * Theme functions for Rapid Tech Solutions.
 *
 * The important part of this file is the router.
 *
 * Previously the theme only registered page *templates*, which WordPress can
 * only use if a Page exists in the database with that template assigned. None
 * did. So every URL in sitemap.xml — /computer-repairs-berwick/, /faq/, all 74
 * of them — 404'd and fell through to the front page, and Google was served
 * the homepage under 74 different addresses. That is almost certainly why
 * indexing was failing.
 *
 * Rather than requiring 30-odd Pages to be hand-created and kept in sync, the
 * theme now registers real rewrite rules for the slugs it actually provides
 * and renders the matching template directly.
 */

require_once __DIR__ . '/inc/config.php';
require_once __DIR__ . '/inc/locations.php';

/**
 * Every URL this theme owns: slug => template file.
 *
 * Built from the location data so suburb pages and their 301 stubs can never
 * drift out of sync with the router.
 */
function rt_routes(): array {
    static $routes = null;
    if ($routes !== null) {
        return $routes;
    }

    $routes = [];

    // Standalone templates.
    foreach ([
        'about', 'faq', 'blog', 'book', 'contact', 'pricing', 'reviews',
        'service-areas', 'privacy-policy', 'terms-of-service',
        'thank-you', 'paymentpage',
        'service-computer-repairs', 'service-data-recovery',
        'service-network-wifi', 'service-virus-removal',
        'blog-cloud-services', 'blog-computer-maintenance', 'blog-hardware-upgrades',
        'blog-home-network', 'blog-malware-protection', 'blog-password-security',
        'blog-scam-protection',
        'data-recovery-frankston', 'data-recovery-patterson-lakes',
        'emergency-computer-repair-melbourne', 'network-setup-berwick',
        'virus-removal-cranbourne', 'virus-removal-dandenong',
    ] as $slug) {
        $routes[$slug] = $slug . '.php';
    }

    // Consolidated suburb pages.
    foreach (array_keys(rt_locations()) as $slug) {
        $routes['computer-repairs-' . $slug] = 'computer-repairs-' . $slug . '.php';
    }

    // Retired slugs that 301 to their primary. These must stay routable, or
    // the redirects never fire and the old URLs simply 404.
    foreach (array_keys(rt_location_redirects()) as $slug) {
        $routes[$slug] = $slug . '.php';
    }

    // Only claim a slug if the template is actually on disk.
    $routes = array_filter($routes, fn($file) => is_readable(RT::path($file)));

    return $routes;
}

/**
 * Register a rewrite rule per route.
 *
 * 'top' priority so these resolve before WordPress's generic page lookup,
 * which is what was sending these URLs to the front page.
 */
function rt_register_routes(): void {
    foreach (array_keys(rt_routes()) as $slug) {
        add_rewrite_rule(
            '^' . preg_quote($slug, '#') . '/?$',
            'index.php?rt_route=' . $slug,
            'top'
        );
    }
}
add_action('init', 'rt_register_routes');

/** Make rt_route a recognised query var. */
function rt_query_vars($vars) {
    $vars[] = 'rt_route';
    return $vars;
}
add_filter('query_vars', 'rt_query_vars');

/**
 * Render the matched template.
 *
 * The templates are complete HTML documents, so this bypasses WordPress's
 * template hierarchy entirely and exits.
 */
function rt_render_route(): void {
    $slug = get_query_var('rt_route');
    if (!$slug) {
        return;
    }

    $routes = rt_routes();
    if (!isset($routes[$slug])) {
        return;
    }

    // A matched route is a real page, so clear the 404 WordPress may have set.
    status_header(200);
    global $wp_query;
    $wp_query->is_404 = false;

    require RT::path($routes[$slug]);
    exit;
}
add_action('template_redirect', 'rt_render_route', 1);

/**
 * Flush rewrite rules only when the route list changes.
 *
 * flush_rewrite_rules() is expensive, so it must never run on every request.
 * Hashing the slug list means new suburb pages become reachable on the next
 * page load after deploy, with no manual "re-save permalinks" step.
 */
function rt_maybe_flush_rules(): void {
    $hash = md5(implode('|', array_keys(rt_routes())));
    if (get_option('rt_routes_hash') !== $hash) {
        rt_register_routes();
        flush_rewrite_rules(false);
        update_option('rt_routes_hash', $hash);
    }
}
add_action('wp_loaded', 'rt_maybe_flush_rules');

/** Flush on activation too, so the site works immediately after switching. */
function rt_on_activate(): void {
    delete_option('rt_routes_hash');
}
add_action('after_switch_theme', 'rt_on_activate');

/**
 * Assets.
 *
 * Templates emit their own <head>, so this only applies to anything rendered
 * through the normal WordPress hierarchy. jQuery, the Font Awesome beta and
 * Open Sans were all being loaded here and used by nothing.
 */
function rt_enqueue_scripts(): void {
    wp_enqueue_style(
        'rapidtech-styles',
        RT::asset('css/styles.css'),
        [],
        filemtime(RT::path('css/styles.css'))
    );
    wp_enqueue_script(
        'rapidtech-main',
        RT::asset('js/main.js'),
        [],
        filemtime(RT::path('js/main.js')),
        true
    );
}
add_action('wp_enqueue_scripts', 'rt_enqueue_scripts');

/** Trim WordPress head output the theme does not use. */
function rt_clean_head(): void {
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
}
add_action('init', 'rt_clean_head');

/**
 * Route all wp_mail() through the hosting server's own SMTP.
 *
 * PHP mail() / sendmail is blocked on this host, but authenticated SMTP
 * through the hosting provider's mail server works (Roundcube uses it).
 */
function rt_smtp_config($phpmailer): void {
    $phpmailer->isSMTP();
    $phpmailer->Host       = 'mail.rapidtechsolutions.au';
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Username   = 'tahir@rapidtechsolutions.au';
    $phpmailer->Password   = defined('RT_SMTP_PASSWORD') ? RT_SMTP_PASSWORD : '';
    $phpmailer->SMTPSecure = 'ssl';
    $phpmailer->Port       = 465;
    $phpmailer->setFrom('tahir@rapidtechsolutions.au', 'Rapid Tech Solutions');
}
add_action('phpmailer_init', 'rt_smtp_config');
