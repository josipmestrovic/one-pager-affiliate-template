<?php
/**
 * Plugin Name: Dynamic Popup
 * Plugin URI:  https://yourwebsite.com/ (Update this)
 * Description: Creates a customizable popup with delay, content, and button settings.
 * Version:     1.0.0
 * Author:      Your Name (Update this)
 * Author URI:  https://yourwebsite.com/ (Update this)
 * License:     GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: dynamic-popup
 * Domain Path: /languages
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Define constants
define('DYNAMIC_POPUP_VERSION', '1.0.0');
define('DYNAMIC_POPUP_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('DYNAMIC_POPUP_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include necessary files
require_once DYNAMIC_POPUP_PLUGIN_DIR . 'inc/settings-page.php';

// Activation hook for setting defaults
function dynamic_popup_activate() {
    if (function_exists('dynamic_popup_set_defaults_on_activation')) {
        dynamic_popup_set_defaults_on_activation();
    }
}
register_activation_hook(__FILE__, 'dynamic_popup_activate');

// Hook to add settings page
add_action('admin_menu', 'dynamic_popup_add_admin_menu');

// Hook to register settings
add_action('admin_init', 'dynamic_popup_register_settings');

// Hook to enqueue front-end assets
add_action('wp_enqueue_scripts', 'dynamic_popup_enqueue_assets');

// Hook to render popup HTML in footer
add_action('wp_footer', 'dynamic_popup_render_popup');

?>
