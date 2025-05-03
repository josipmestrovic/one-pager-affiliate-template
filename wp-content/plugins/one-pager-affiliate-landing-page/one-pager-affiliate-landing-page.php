<?php
/**
 * Plugin Name: One-Pager Affiliate Landing Page
 * Plugin URI: https://e-com.hr
 * Description: A simple one-page affiliate landing page plugin.
 * Version: 9.3.0
 * Author: E-COM
 * Author URI: https://e-com.hr
 *
 * Changelog:
 * - 9.3.0: Commented countdown logic PHP file.
 * - 0.9.2: Added FAQs accordion, connected fields in CMS, reviews moved to a dedicated Reviews tab.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Include necessary files
require_once plugin_dir_path( __FILE__ ) . 'inc/functions.php';
// Include custom fields file
require_once plugin_dir_path(__FILE__) . 'inc/custom-fields.php';
// Include visitors logic
require_once plugin_dir_path(__FILE__) . 'inc/visitors-logic.php';
// Include settings page functionality
require_once plugin_dir_path(__FILE__) . 'inc/settings-page.php';

// Activation and deactivation hooks
function opalp_activate() {
    // Code to run on activation
    // Set default font settings if they don't exist
    if (false === get_option('opalp_font_settings')) {
        add_option('opalp_font_settings', opalp_get_font_defaults());
    }
    // Set default color settings if they don't exist
    if (false === get_option('opalp_global_colors')) {
        add_option('opalp_global_colors', opalp_get_color_defaults());
    }
}
register_activation_hook( __FILE__, 'opalp_activate' );

function opalp_deactivate() {
    // Code to run on deactivation
}
register_deactivation_hook( __FILE__, 'opalp_deactivate' );

// Initialize the plugin
function opalp_init() {
    // Code to initialize the plugin
    // Register settings
    add_action('admin_init', 'opalp_register_settings');
}
add_action( 'init', 'opalp_init' );

// Add settings page to admin menu
function opalp_add_admin_menu() {
    add_options_page(
        'One-Pager Settings',          // Page title
        'One-Pager Settings',          // Menu title
        'manage_options',              // Capability required
        'one-pager-settings',          // Menu slug
        'opalp_render_settings_page'   // Function to display the page
    );
}
add_action('admin_menu', 'opalp_add_admin_menu');

// Function to output settings-based CSS
function opalp_settings_css() {
    $font_settings = get_option('opalp_font_settings', opalp_get_font_defaults());
    $paragraph_font = esc_html($font_settings['paragraph_font'] ?? 'Arial, sans-serif');
    $heading_font = esc_html($font_settings['heading_font'] ?? 'Arial, sans-serif');

    ?>
    <style type="text/css" id="opalp-settings-fonts-css">
         p, span, li, .btn  {
            font-family: <?php echo $paragraph_font; ?> !important;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: <?php echo $heading_font; ?> !important;
        }
    </style>
    <?php
    // Output dynamic CSS variables based on saved color settings
    $colors = wp_parse_args(
        get_option('opalp_global_colors', []),
        opalp_get_color_defaults()
    );
    ?>
    <style id="opalp-dynamic-colors-css">
    :root {
        --header-footer-bg: <?php echo esc_attr($colors['header_footer_bg']); ?>;
        --primary-button-bg: <?php echo esc_attr($colors['primary_button_bg']); ?>;
        --secondary-button-bg: <?php echo esc_attr($colors['secondary_button_bg']); ?>;
        --featured-bg: <?php echo esc_attr($colors['secondary_button_bg']); ?>;
        --sticky-footer-bg: <?php echo esc_attr($colors['sticky_footer_bg']); ?>;
        --blurb-icon-color: <?php echo esc_attr($colors['blurb_icon_color']); ?>;
        --discount-text-color: <?php echo esc_attr($colors['discount_text_color']); ?>;
    }
    </style>
    <?php
}
// Load custom fonts CSS late to override other rules
add_action('wp_head', 'opalp_settings_css', 100);

// Register the custom page template
function opalp_register_page_template($templates) {
    $templates['one-pager-template.php'] = 'One-Pager Affiliate Template';
    return $templates;
}
add_filter('theme_page_templates', 'opalp_register_page_template');

// Load the custom page template
function opalp_load_page_template($template) {
    if (is_page_template('one-pager-template.php')) {
        $template = plugin_dir_path(__FILE__) . 'templates/one-pager-template.php';
    }
    return $template;
}
add_filter('template_include', 'opalp_load_page_template');

// Enqueue plugin dynamic styles
function opalp_enqueue_styles() {
    // Font Awesome for icon fonts
    wp_enqueue_style(
        'opalp-font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
        array(),
        '6.4.0'
    );
    // Bootstrap CSS
    wp_enqueue_style(
        'opalp-bootstrap-css',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
        array(),
        '5.3.0'
    );
    // Plugin dynamic styles
    wp_enqueue_style(
        'opalp-dynamic-styles',
        plugin_dir_url(__FILE__) . 'assets/css/global-styles/dynamic-styles.css',
        array(),
        '1.0'
    );
}
// Load dynamic-styles.css after theme styles
add_action('wp_enqueue_scripts', 'opalp_enqueue_styles', 20);

// Enqueue Google Fonts
function opalp_enqueue_static_google_fonts() {
    wp_enqueue_style(
        'opalp-google-fonts',
        'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Montserrat:wght@400;600;700&family=Poppins:wght@400;600;700&family=Roboto:wght@400;600;700&family=Lato:wght@400;600;700&display=swap',
        array(),
        null
    );
}
add_action('wp_enqueue_scripts', 'opalp_enqueue_static_google_fonts', 10);

// Enqueue plugin scripts
function opalp_enqueue_scripts() {
    // Bootstrap JS bundle for popovers
    wp_enqueue_script(
        'opalp-bootstrap-bundle',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js',
        array(),
        '5.3.0',
        true
    );
    // Initialize popovers
    wp_add_inline_script(
        'opalp-bootstrap-bundle',
        "document.addEventListener('DOMContentLoaded', function(){ var popoverTriggerList = Array.prototype.slice.call(document.querySelectorAll('.payment-more')); popoverTriggerList.forEach(function(el){ new bootstrap.Popover(el); }); });"
    );
}
add_action('wp_enqueue_scripts', 'opalp_enqueue_scripts', 21);
?>