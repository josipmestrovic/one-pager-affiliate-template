<?php
/**
 * Settings page for Dynamic Popup Plugin.
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Add the admin menu page
function dynamic_popup_add_admin_menu() {
    add_options_page(
        __('Dynamic Popup Settings', 'dynamic-popup'), // Page title
        __('Dynamic Popup', 'dynamic-popup'),          // Menu title
        'manage_options',                              // Capability
        'dynamic-popup-settings',                      // Menu slug
        'dynamic_popup_render_settings_page'           // Callback function
    );
}

// Register settings, sections, and fields
function dynamic_popup_register_settings() {
    register_setting(
        'dynamic_popup_settings_group', // Option group
        'dynamic_popup_options',        // Option name (stores an array)
        'dynamic_popup_sanitize_options' // Sanitization callback
    );

    add_settings_section(
        'dynamic_popup_main_section', // Section ID
        __('Popup Configuration', 'dynamic-popup'), // Section title
        'dynamic_popup_section_callback', // Section description callback
        'dynamic-popup-settings'      // Page slug
    );

    add_settings_field(
        'dynamic_popup_delay',
        __('Popup Delay (seconds)', 'dynamic-popup'),
        'dynamic_popup_render_delay_field',
        'dynamic-popup-settings',
        'dynamic_popup_main_section'
    );

    add_settings_field(
        'dynamic_popup_content',
        __('Popup Content', 'dynamic-popup'),
        'dynamic_popup_render_content_field',
        'dynamic-popup-settings',
        'dynamic_popup_main_section'
    );

    add_settings_field(
        'dynamic_popup_button_text',
        __('Popup Button Text', 'dynamic-popup'),
        'dynamic_popup_render_button_text_field',
        'dynamic-popup-settings',
        'dynamic_popup_main_section'
    );

    add_settings_field(
        'dynamic_popup_button_url',
        __('Popup Button URL', 'dynamic-popup'),
        'dynamic_popup_render_button_url_field',
        'dynamic-popup-settings',
        'dynamic_popup_main_section'
    );
}

// Section callback (optional description)
function dynamic_popup_section_callback() {
    echo '<p>' . __('Configure the appearance and behavior of the popup.', 'dynamic-popup') . '</p>';
}

// Get default options
function dynamic_popup_get_defaults() {
    return [
        'delay' => 5,
        'content' => '<h2>' . __('Default Title', 'dynamic-popup') . '</h2><p>' . __('Default popup content goes here. Edit this in the settings!', 'dynamic-popup') . '</p>',
        'button_text' => __('Click Here', 'dynamic-popup'),
        'button_url' => '#',
    ];
}

// Render Delay Field
function dynamic_popup_render_delay_field() {
    $options = get_option('dynamic_popup_options', dynamic_popup_get_defaults());
    $delay = isset($options['delay']) ? $options['delay'] : 5;
    ?>
    <input type="number" name="dynamic_popup_options[delay]" value="<?php echo esc_attr($delay); ?>" min="0" step="1">
    <p class="description"><?php _e('Number of seconds before the popup appears after the page loads.', 'dynamic-popup'); ?></p>
    <?php
}

// Render Content Field (WP Editor)
function dynamic_popup_render_content_field() {
    $options = get_option('dynamic_popup_options', dynamic_popup_get_defaults());
    $content = isset($options['content']) ? $options['content'] : '';
    wp_editor(
        $content,
        'dynamic_popup_editor', // HTML ID attribute
        [
            'textarea_name' => 'dynamic_popup_options[content]', // Name attribute
            'textarea_rows' => 10,
            'media_buttons' => false, // Optional: disable media buttons
            'teeny' => true, // Optional: simpler editor interface
        ]
    );
     echo '<p class="description">' . __('Enter the content to display inside the popup body.', 'dynamic-popup') . '</p>';
}

// Render Button Text Field
function dynamic_popup_render_button_text_field() {
    $options = get_option('dynamic_popup_options', dynamic_popup_get_defaults());
    $button_text = isset($options['button_text']) ? $options['button_text'] : '';
    ?>
    <input type="text" name="dynamic_popup_options[button_text]" value="<?php echo esc_attr($button_text); ?>" class="regular-text">
    <p class="description"><?php _e('The text displayed on the popup button.', 'dynamic-popup'); ?></p>
    <?php
}

// Render Button URL Field
function dynamic_popup_render_button_url_field() {
    $options = get_option('dynamic_popup_options', dynamic_popup_get_defaults());
    $button_url = isset($options['button_url']) ? $options['button_url'] : '';
    ?>
    <input type="url" name="dynamic_popup_options[button_url]" value="<?php echo esc_url($button_url); ?>" class="regular-text">
    <p class="description"><?php _e('The URL the button should link to (e.g., https://example.com).', 'dynamic-popup'); ?></p>
    <?php
}

// Sanitize options before saving
function dynamic_popup_sanitize_options($input) {
    $new_input = [];
    $defaults = dynamic_popup_get_defaults();

    $new_input['delay'] = isset($input['delay']) ? absint($input['delay']) : $defaults['delay'];

    if (isset($input['content'])) {
        $new_input['content'] = wp_kses_post($input['content']); // Allow safe HTML
    } else {
        $new_input['content'] = $defaults['content'];
    }

    $new_input['button_text'] = isset($input['button_text']) ? sanitize_text_field($input['button_text']) : $defaults['button_text'];

    $new_input['button_url'] = isset($input['button_url']) ? esc_url_raw($input['button_url']) : $defaults['button_url']; // Sanitize URL

    return $new_input;
}

// Render the settings page HTML
function dynamic_popup_render_settings_page() {
    if (!current_user_can('manage_options')) {
        return;
    }
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields('dynamic_popup_settings_group');
            do_settings_sections('dynamic-popup-settings');
            submit_button(__('Save Settings', 'dynamic-popup'));
            ?>
        </form>
    </div>
    <?php
}

// --- Front-end Functions ---

// Enqueue scripts and styles for the front-end
function dynamic_popup_enqueue_assets() {
    // Only enqueue if the popup should be displayed (add conditions later if needed)
    wp_enqueue_style(
        'dynamic-popup-style',
        DYNAMIC_POPUP_PLUGIN_URL . 'assets/css/popup.css',
        [], // Dependencies
        DYNAMIC_POPUP_VERSION
    );

    wp_enqueue_script(
        'dynamic-popup-script',
        DYNAMIC_POPUP_PLUGIN_URL . 'assets/js/popup.js',
        ['jquery'], // Dependencies
        DYNAMIC_POPUP_VERSION,
        true // Load in footer
    );

    // Get settings and pass them to the script
    $options = get_option('dynamic_popup_options', dynamic_popup_get_defaults());
    $settings_for_js = [
        'delay' => isset($options['delay']) ? absint($options['delay']) * 1000 : 5000, // In milliseconds
        // Add other settings if needed by JS
    ];
    wp_localize_script('dynamic-popup-script', 'dynamicPopupSettings', $settings_for_js);
}

// Render the popup HTML structure in the footer
function dynamic_popup_render_popup() {
    $options = get_option('dynamic_popup_options', dynamic_popup_get_defaults());

    $popup_content = isset($options['content']) ? $options['content'] : '';
    $button_text = isset($options['button_text']) ? $options['button_text'] : '';
    $button_url = isset($options['button_url']) ? $options['button_url'] : '#';

    // Don't render if content or button text is empty
    if (empty(trim(strip_tags($popup_content))) || empty(trim($button_text))) {
        return;
    }

    // Get the primary button color from the other plugin's settings
    // Note: This creates a dependency. Consider making colors configurable here too.
    $primary_button_color = '#0d6efd'; // Default fallback
    if (function_exists('opalp_get_color_defaults')) { // Check if function from other plugin exists
        $opalp_defaults = opalp_get_color_defaults();
        $opalp_colors = get_option('opalp_global_colors', $opalp_defaults);
        $primary_button_color = $opalp_colors['primary_button_bg'] ?? $primary_button_color;
    }

    ?>
    <div id="dynamic-popup-container">
        <div id="dynamic-popup-overlay"></div>
        <div id="dynamic-popup-content">
            <button id="dynamic-popup-close" aria-label="<?php _e('Close Popup', 'dynamic-popup'); ?>">&times;</button>
            <div class="dynamic-popup-body">
                <?php echo wp_kses_post($popup_content); // Output sanitized content ?>
            </div>
            <?php if ($button_url && $button_text): ?>
            <div class="dynamic-popup-footer">
                <a href="<?php echo esc_url($button_url); ?>" class="dynamic-popup-button" style="background-color: <?php echo esc_attr($primary_button_color); ?>;">
                    <?php echo esc_html($button_text); ?>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php
}

// Set default options on activation
function dynamic_popup_set_defaults_on_activation() {
    if (false === get_option('dynamic_popup_options')) {
        add_option('dynamic_popup_options', dynamic_popup_get_defaults());
    }
}

?>
