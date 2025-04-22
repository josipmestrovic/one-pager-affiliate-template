<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Add popup settings as submenu
function opalp_add_popup_settings_submenu() {
    add_submenu_page(
        'opalp-settings', // Parent slug (from main settings page)
        'Popup Settings',
        'Popup Settings',
        'manage_options',
        'popup-settings',
        'opalp_popup_settings_content'
    );
}
add_action('admin_menu', 'opalp_add_popup_settings_submenu');

// Register settings
function opalp_register_popup_settings() {
    register_setting('opalp_popup_settings', 'opalp_popup_delay');
    register_setting('opalp_popup_settings', 'opalp_popup_content');
}
add_action('admin_init', 'opalp_register_popup_settings');

// Settings page content
function opalp_popup_settings_content() {
    ?>
    <div class="wrap">
        <h1>Popup Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('opalp_popup_settings');
            do_settings_sections('opalp_popup_settings');
            ?>
            <table class="form-table">
                <tr>
                    <th scope="row">Popup Delay (seconds)</th>
                    <td>
                        <input type="number" name="opalp_popup_delay" value="<?php echo esc_attr(get_option('opalp_popup_delay', 5)); ?>" min="1">
                    </td>
                </tr>
                <tr>
                    <th scope="row">Popup Content</th>
                    <td>
                        <?php
                        wp_editor(
                            get_option('opalp_popup_content', '<h2>Still thinking?</h2><p>Click below to get an exclusive discount!</p>'),
                            'opalp_popup_content',
                            array('textarea_name' => 'opalp_popup_content')
                        );
                        ?>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

function opalp_enqueue_popup_assets() {
    wp_enqueue_style('opalp-popup-style', plugin_dir_url(__FILE__) . 'popup.css');
    wp_enqueue_script('opalp-popup-script', plugin_dir_url(__FILE__) . 'popup.js', array('jquery'), false, true);
    
    // Pass settings to JavaScript
    wp_localize_script('opalp-popup-script', 'popupSettings', array(
        'delay' => get_option('opalp_popup_delay', 5) * 1000 // Convert to milliseconds
    ));
}
add_action('wp_enqueue_scripts', 'opalp_enqueue_popup_assets');

function opalp_render_popup() {
    $button_text = get_field('button_1_text');
    $button_url = get_field('button_1_url');
    $popup_content = get_option('opalp_popup_content', '<h2>Still thinking?</h2><p>Click below to get an exclusive discount!</p>');
    ?>
    <div id="popup-container">
        <div id="popup-content">
            <button id="popup-close">&times;</button>
            <?php echo wp_kses_post($popup_content); ?>
            <a href="<?php echo esc_url($button_url); ?>" class="btn btn-primary">
                <?php echo esc_html($button_text); ?>
            </a>
        </div>
    </div>
    <?php
}
add_action('wp_footer', 'opalp_render_popup');