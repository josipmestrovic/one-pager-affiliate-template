<?php
/**
 * Plugin Name: One-Pager Affiliate Landing Page
 * Plugin URI: https://e-com.hr
 * Description: A simple one-page affiliate landing page plugin.
 * Version: 1.0
 * Author: E-COM
 * Author URI: https://e-com.hr
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Include necessary files
require_once plugin_dir_path( __FILE__ ) . 'inc/functions.php';
// Include custom fields file
require_once plugin_dir_path(__FILE__) . 'inc/custom-fields.php';

// Activation and deactivation hooks
function opalp_activate() {
    // Code to run on activation
}
register_activation_hook( __FILE__, 'opalp_activate' );

function opalp_deactivate() {
    // Code to run on deactivation
}
register_deactivation_hook( __FILE__, 'opalp_deactivate' );

// Initialize the plugin
function opalp_init() {
    // Code to initialize the plugin
}
add_action( 'init', 'opalp_init' );

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
?>