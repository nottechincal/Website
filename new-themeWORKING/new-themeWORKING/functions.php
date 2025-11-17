<?php
/**
 * Theme Functions for Rapid Tech Solutions
 */

/**
 * Register custom page templates
 */
function rapidtech_custom_templates($templates) {
    $templates['service-area.php'] = 'Service Area';
    $templates['blog-malware-protection.php'] = 'Blog: Malware Protection';
    $templates['blog-hardware-upgrades.php'] = 'Blog: Hardware Upgrades';
    $templates['blog-home-network.php'] = 'Blog: Home Network';
    $templates['blog-cloud-services.php'] = 'Blog: Cloud Services';
    $templates['postcode-3196.php'] = 'Postcode: Bonbeach (3196)';
    $templates['postcode-3195.php'] = 'Postcode: Aspendale, Braeside, Mordialloc (3195)';
    $templates['postcode-3194.php'] = 'Postcode: Mentone (3194)';
    $templates['postcode-3193.php'] = 'Postcode: Beaumaris (3193)';
    $templates['postcode-3192.php'] = 'Postcode: Cheltenham (3192)';
    $templates['postcode-3175.php'] = 'Postcode: Dandenong (3175)';
    $templates['postcode-3173.php'] = 'Postcode: Keysborough (3173)';
    $templates['postcode-3201.php'] = 'Postcode: Carrum Downs (3201)';
    $templates['postcode-3198.php'] = 'Postcode: Seaford (3198)';
    $templates['postcode-3199.php'] = 'Postcode: Frankston (3199)';
    $templates['postcode-3200.php'] = 'Postcode: Frankston North (3200)';
    $templates['postcode-3174.php'] = 'Postcode: Noble Park (3174)';
    $templates['postcode-3178.php'] = 'Postcode: Rowville (3178)';
    $templates['postcode-3152.php'] = 'Postcode: Wantirna (3152)';
    
    return $templates;
}
add_filter('theme_page_templates', 'rapidtech_custom_templates');

/**
 * Load the correct template for the page
 */
function rapidtech_load_template($template) {
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