<?php
/**
 * Theme Functions for Rapid Tech Solutions
 */

/**
 * Return an array of standalone templates within the theme root that output
 * full HTML documents. These templates power the virtual landing pages.
 */
function rapidtech_get_virtual_templates() {
    static $templates = null;

    if ($templates !== null) {
        return $templates;
    }

    $templates = array();
    $excluded = array(
        'index',
        'functions',
        'header',
        'footer',
        '404',
        'contactengine',
        'bookingengine'
    );

    foreach (glob(get_template_directory() . '/*.php') as $path) {
        $slug = sanitize_title(basename($path, '.php'));
        if ($slug === '') {
            continue;
        }
        if (in_array($slug, $excluded, true)) {
            continue;
        }

        $sample = file_get_contents($path, false, null, 0, 2048);
        if ($sample === false || stripos($sample, '<!DOCTYPE html') === false) {
            continue;
        }

        $templates[$slug] = $path;
    }

    return $templates;
}

/**
 * Generate a readable label from a slug (e.g. computer-repairs-berwick → Computer Repairs Berwick)
 */
function rapidtech_pretty_template_label($slug) {
    $label = str_replace(array('-', '_'), ' ', $slug);
    $label = ucwords(trim($label));
    return $label;
}

/**
 * Register custom page templates based on the discovered virtual templates.
 */
function rapidtech_custom_templates($templates) {
    foreach (rapidtech_get_virtual_templates() as $slug => $path) {
        $templates[basename($path)] = rapidtech_pretty_template_label($slug);
    }

    return $templates;
}
add_filter('theme_page_templates', 'rapidtech_custom_templates');

/**
 * Load the correct template for the page
 */
function rapidtech_load_template($template) {
    $virtual_slug = get_query_var('rapidtech_virtual');
    if (!empty($virtual_slug)) {
        $templates = rapidtech_get_virtual_templates();
        if (isset($templates[$virtual_slug])) {
            return $templates[$virtual_slug];
        }
    }

    global $post;
    if ($post && !empty(get_post_meta($post->ID, '_wp_page_template', true))) {
        $page_template = get_post_meta($post->ID, '_wp_page_template', true);
        if (file_exists(get_template_directory() . '/' . $page_template)) {
            return get_template_directory() . '/' . $page_template;
        }
    }

    return $template;
}
add_filter('template_include', 'rapidtech_load_template');

/**
 * Make the `rapidtech_virtual` query var publicly available.
 */
function rapidtech_register_query_var($vars) {
    $vars[] = 'rapidtech_virtual';
    return $vars;
}
add_filter('query_vars', 'rapidtech_register_query_var');

/**
 * Register rewrite rules so landing page URLs never hit a WordPress 404.
 */
function rapidtech_register_virtual_routes() {
    foreach (rapidtech_get_virtual_templates() as $slug => $path) {
        $pattern = '^' . preg_quote($slug, '/') . '/?$';
        add_rewrite_rule($pattern, 'index.php?rapidtech_virtual=' . $slug, 'top');
    }
}
add_action('init', 'rapidtech_register_virtual_routes');

/**
 * Ensure rewrite rules stay in sync after the theme is activated or updated.
 */
function rapidtech_flush_virtual_routes() {
    rapidtech_register_virtual_routes();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'rapidtech_flush_virtual_routes');

/**
 * Allow pretty permalinks (e.g. /computer-repairs-berwick/) to render the
 * corresponding standalone PHP template even if no WordPress page exists.
 */
function rapidtech_serve_virtual_pages() {
    if (!is_404() || is_admin()) {
        return;
    }

    $request_path = wp_parse_url(add_query_arg(array()), PHP_URL_PATH);
    if (empty($request_path)) {
        return;
    }

    $slug = trim($request_path, '/');
    if ($slug === '' || strpos($slug, 'wp-json') === 0) {
        return;
    }

    $slug = sanitize_title($slug);
    $templates = rapidtech_get_virtual_templates();

    if (!isset($templates[$slug])) {
        return;
    }

    status_header(200);
    nocache_headers();
    include $templates[$slug];
    exit;
}
add_action('template_redirect', 'rapidtech_serve_virtual_pages', 0);

/**
 * Enqueue scripts and styles
 */
function rapidtech_enqueue_scripts() {
    wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), '3.6.0', true);
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css', array(), '6.0.0-beta3');
    wp_enqueue_style('open-sans', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap', array(), null);
    wp_enqueue_style('theme-styles', get_template_directory_uri() . '/css/styles.css', array(), '1.0');
}
add_action('wp_enqueue_scripts', 'rapidtech_enqueue_scripts');

/**
 * Handle contact form submission
 */
function rapidtech_handle_contact_form() {
    if (isset($_POST['contact-form-submit'])) {
        $name = sanitize_text_field($_POST['Name']);
        $email = sanitize_email($_POST['Email']);
        $service = sanitize_text_field($_POST['ServiceRequest']);
        $message = sanitize_textarea_field($_POST['Message']);
        
        // Process form (e.g., send email, store in database)
        $to = get_option('admin_email');
        $subject = 'New Contact Form Submission from ' . $name;
        $body = "Name: $name\nEmail: $email\nService: $service\nMessage: $message";
        wp_mail($to, $subject, $body);
        
        // Redirect after submission
        wp_redirect(home_url('#contact'));
        exit;
    }
}
add_action('admin_post_nopriv_rapidtech_handle_contact_form', 'rapidtech_handle_contact_form');
add_action('admin_post_rapidtech_handle_contact_form', 'rapidtech_handle_contact_form');
?>