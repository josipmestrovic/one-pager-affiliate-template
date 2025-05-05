<?php
// filepath: c:\Users\Josip\Local Sites\affiliate-template-one-pager\app\public\wp-content\plugins\one-pager-affiliate-landing-page\inc\settings-page.php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Define available fonts.
 */
function opalp_get_available_fonts() {
    return [
        'Arial, sans-serif' => 'Arial',
        'Helvetica, sans-serif' => 'Helvetica',
        'Times New Roman, Times, serif' => 'Times New Roman',
        'Georgia, serif' => 'Georgia',
        'Verdana, Geneva, sans-serif' => 'Verdana',
        'Courier New, Courier, monospace' => 'Courier New',
        'Lucida Console, Monaco, monospace' => 'Lucida Console',
        // Added popular Google Fonts
        'Open Sans, sans-serif' => 'Open Sans',
        'Montserrat, sans-serif' => 'Montserrat',
        'Poppins, sans-serif' => 'Poppins',
        'Roboto, sans-serif' => 'Roboto',
        'Lato, sans-serif' => 'Lato',
    ];
}

/**
 * Get default font values.
 */
function opalp_get_font_defaults() {
    return [
        'heading_font' => 'Arial, sans-serif',
        'paragraph_font' => 'Arial, sans-serif',
    ];
}

/**
 * Get default visitor count settings.
 */
function opalp_get_visitor_count_defaults() {
    return [
        'min_count' => 60,
        'max_count' => 200,
        'update_interval' => 5,
        'change_probability' => [
            'small' => 50, // Percentage chance for -1, 0, +1 changes (out of 100)
            'large' => 50, // Percentage chance for -2, +2 changes (out of 100)
        ]
    ];
}

/**
 * Register plugin settings, sections, and fields.
 */
function opalp_register_settings() {
    // Register the main setting group
    register_setting(
        'opalp_settings_group', // Option group slug
        'opalp_global_colors',  // Option name in wp_options table
        'opalp_sanitize_colors' // Sanitization callback
    );

    // Add a section for Global Colors
    add_settings_section(
        'opalp_global_colors_section', // Section ID
        'Global Colors',               // Section title
        'opalp_global_colors_section_callback', // Callback for section description (optional)
        'one-pager-settings'           // Page slug where this section appears
    );

    // Add fields for each color
    $colors = [
        'header_footer_bg' => 'Header & Footer Background',
        'primary_button_bg' => 'Primary Button Color',
        'secondary_button_bg' => 'Secondary Button / Featured Background',
        'sticky_footer_bg' => 'Sticky Footer Background',
        'blurb_icon_color' => 'Blurb Icon Color',
        'discount_text_color' => 'Discount Price/Percentage Text Color',
    ];

    $color_defaults = opalp_get_color_defaults();

    foreach ($colors as $key => $label) {
        add_settings_field(
            'opalp_' . $key, // Field ID
            $label,          // Field label
            'opalp_render_color_picker_field', // Callback function to render the field
            'one-pager-settings', // Page slug
            'opalp_global_colors_section', // Section ID
            [ // Arguments passed to the callback
                'label_for' => 'opalp_' . $key,
                'option_name' => 'opalp_global_colors',
                'key' => $key,
                'default' => $color_defaults[$key] ?? '#ffffff', // Provide a default
            ]
        );
    }

    // Register the setting group for fonts
    register_setting(
        'opalp_settings_group',      // Use the same group to save together
        'opalp_font_settings',       // Option name for fonts
        'opalp_sanitize_fonts'       // Sanitization callback for fonts
    );

    // Add a section for Font Settings
    add_settings_section(
        'opalp_font_settings_section',
        'Font Settings',
        'opalp_font_settings_section_callback',
        'one-pager-settings'
    );

    // Add fields for fonts
    $font_defaults = opalp_get_font_defaults();

    add_settings_field(
        'opalp_heading_font',
        'Heading Font Family',
        'opalp_render_font_select_field',
        'one-pager-settings',
        'opalp_font_settings_section',
        [
            'label_for' => 'opalp_heading_font',
            'option_name' => 'opalp_font_settings',
            'key' => 'heading_font',
            'default' => $font_defaults['heading_font'],
            'description' => 'Select the font family for headings (h1-h6).'
        ]
    );

    add_settings_field(
        'opalp_paragraph_font',
        'Paragraph Font Family',
        'opalp_render_font_select_field',
        'one-pager-settings',
        'opalp_font_settings_section',
        [
            'label_for' => 'opalp_paragraph_font',
            'option_name' => 'opalp_font_settings',
            'key' => 'paragraph_font',
            'default' => $font_defaults['paragraph_font'],
            'description' => 'Select the font family for body text and paragraphs.'
        ]
    );

    // Register the setting group for visitor count settings
    register_setting(
        'opalp_settings_group',      // Use the same group to save together
        'opalp_visitor_count',       // Option name for visitor count settings
        'opalp_sanitize_visitor_count' // Sanitization callback for visitor count settings
    );

    // Add a section for Visitor Count Settings
    add_settings_section(
        'opalp_visitor_count_section',
        'Visitor Count Settings',
        'opalp_visitor_count_section_callback',
        'one-pager-settings'
    );

    $visitor_count_defaults = opalp_get_visitor_count_defaults();

    // Minimum Count Field
    add_settings_field(
        'opalp_min_count',
        'Minimum Visitor Count',
        'opalp_render_number_field',
        'one-pager-settings',
        'opalp_visitor_count_section',
        [
            'label_for' => 'opalp_min_count',
            'option_name' => 'opalp_visitor_count',
            'key' => 'min_count',
            'default' => $visitor_count_defaults['min_count'],
            'min' => 1,
            'max' => 999,
            'description' => 'The minimum number of visitors to display.'
        ]
    );

    // Maximum Count Field
    add_settings_field(
        'opalp_max_count',
        'Maximum Visitor Count',
        'opalp_render_number_field',
        'one-pager-settings',
        'opalp_visitor_count_section',
        [
            'label_for' => 'opalp_max_count',
            'option_name' => 'opalp_visitor_count',
            'key' => 'max_count',
            'default' => $visitor_count_defaults['max_count'],
            'min' => 1,
            'max' => 999,
            'description' => 'The maximum number of visitors to display.'
        ]
    );

    // Update Interval Field
    add_settings_field(
        'opalp_update_interval',
        'Update Interval (seconds)',
        'opalp_render_number_field',
        'one-pager-settings',
        'opalp_visitor_count_section',
        [
            'label_for' => 'opalp_update_interval',
            'option_name' => 'opalp_visitor_count',
            'key' => 'update_interval',
            'default' => $visitor_count_defaults['update_interval'],
            'min' => 1,
            'max' => 60,
            'description' => 'How often the visitor count should update (in seconds).'
        ]
    );

    // Small Change Probability Field
    add_settings_field(
        'opalp_small_change_probability',
        'Small Change Probability (%)',
        'opalp_render_number_field',
        'one-pager-settings',
        'opalp_visitor_count_section',
        [
            'label_for' => 'opalp_small_change_probability',
            'option_name' => 'opalp_visitor_count',
            'key' => 'small_change_probability',
            'default' => $visitor_count_defaults['change_probability']['small'],
            'min' => 0,
            'max' => 100,
            'description' => 'The probability (%) of small changes (-1, 0, +1) occurring.'
        ]
    );
}
// Note: The add_action('admin_init', 'opalp_register_settings'); is already in the main plugin file.

/**
 * Get default color values.
 */
function opalp_get_color_defaults() {
    return [
        'header_footer_bg' => '#f8f9fa',
        'primary_button_bg' => '#0d6efd',
        'secondary_button_bg' => '#6c757d',
        'sticky_footer_bg' => '#343a40',
        'blurb_icon_color' => '#0d6efd',
        'discount_text_color' => '#dc3545',
    ];
}

/**
 * Callback for the Global Colors section description (optional).
 */
function opalp_global_colors_section_callback() {
    echo '<p>Define the main colors used throughout the One-Pager Affiliate Template.</p>';
}

/**
 * Callback for the Font Settings section description.
 */
function opalp_font_settings_section_callback() {
    echo '<p>Choose the fonts for headings and body text. If using Google Fonts, ensure they are properly enqueued.</p>';
}

/**
 * Callback for the Visitor Count Settings section description.
 */
function opalp_visitor_count_section_callback() {
    echo '<p>Configure the behavior of the dynamic visitor counter displayed on your landing pages.</p>';
}

/**
 * Render a color picker field.
 */
function opalp_render_color_picker_field($args) {
    $option_name = $args['option_name'];
    $key = $args['key'];
    $default = $args['default'];

    // Get the saved options, or an empty array if none exist
    $options = get_option($option_name, []);
    // Get the specific color value, or the default if not set
    $value = isset($options[$key]) ? $options[$key] : $default;

    ?>
    <input type="text"
           id="opalp_<?php echo esc_attr($key); ?>"
           name="<?php echo esc_attr($option_name); ?>[<?php echo esc_attr($key); ?>]"
           value="<?php echo esc_attr($value); ?>"
           class="opalp-color-picker"
           data-default-color="<?php echo esc_attr($default); ?>" />
    <p class="description">Select the color for <?php echo esc_html(strtolower(str_replace('_', ' ', $key))); ?>.</p>
    <?php
}

/**
 * Render a font selection dropdown field.
 */
function opalp_render_font_select_field($args) {
    $option_name = $args['option_name'];
    $key = $args['key'];
    $default = $args['default'];
    $description = $args['description'] ?? '';

    $options = get_option($option_name, []);
    $value = isset($options[$key]) ? $options[$key] : $default;
    $available_fonts = opalp_get_available_fonts();

    ?>
    <select id="opalp_<?php echo esc_attr($key); ?>"
            name="<?php echo esc_attr($option_name); ?>[<?php echo esc_attr($key); ?>]">
        <?php foreach ($available_fonts as $font_stack => $font_name) : ?>
            <option value="<?php echo esc_attr($font_stack); ?>" <?php selected($value, $font_stack); ?>>
                <?php echo esc_html($font_name); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <?php if ($description) : ?>
        <p class="description"><?php echo esc_html($description); ?></p>
    <?php endif; ?>
    <?php
}

/**
 * Render a number input field.
 */
function opalp_render_number_field($args) {
    $option_name = $args['option_name'];
    $key = $args['key'];
    $default = $args['default'];
    $min = $args['min'] ?? 0;
    $max = $args['max'] ?? 999;
    $description = $args['description'] ?? '';

    $options = get_option($option_name, []);
    
    // Handle the special case for small_change_probability
    if ($key === 'small_change_probability') {
        $value = isset($options['change_probability']['small']) ? $options['change_probability']['small'] : $default;
    } else {
        $value = isset($options[$key]) ? $options[$key] : $default;
    }

    ?>
    <input type="number"
           id="opalp_<?php echo esc_attr($key); ?>"
           name="<?php echo esc_attr($option_name); ?>[<?php echo esc_attr($key); ?>]"
           value="<?php echo esc_attr($value); ?>"
           min="<?php echo esc_attr($min); ?>"
           max="<?php echo esc_attr($max); ?>"
           class="regular-text" />
    <?php if ($description) : ?>
        <p class="description"><?php echo esc_html($description); ?></p>
    <?php endif; ?>
    <?php
}

/**
 * Sanitize color settings before saving.
 */
function opalp_sanitize_colors($input) {
    $new_input = [];
    $defaults = opalp_get_color_defaults();

    foreach ($defaults as $key => $default) {
        if (isset($input[$key])) {
            // Use sanitize_hex_color for basic hex validation
            $color = sanitize_hex_color($input[$key]);
            $new_input[$key] = $color ? $color : '';
        } else {
            $new_input[$key] = '';
        }
    }
    return $new_input;
}

/**
 * Sanitize font settings before saving.
 */
function opalp_sanitize_fonts($input) {
    $new_input = [];
    $defaults = opalp_get_font_defaults();
    $available_fonts = opalp_get_available_fonts();
    $allowed_font_stacks = array_keys($available_fonts);

    foreach ($defaults as $key => $default) {
        if (isset($input[$key]) && in_array($input[$key], $allowed_font_stacks, true)) {
            $new_input[$key] = sanitize_text_field($input[$key]);
        } else {
            $new_input[$key] = $default;
        }
    }
    return $new_input;
}

/**
 * Sanitize visitor count settings before saving.
 */
function opalp_sanitize_visitor_count($input) {
    $new_input = [];
    $defaults = opalp_get_visitor_count_defaults();
    
    // Sanitize min_count
    if (isset($input['min_count'])) {
        $min_count = intval($input['min_count']);
        $new_input['min_count'] = ($min_count >= 1 && $min_count <= 999) ? $min_count : $defaults['min_count'];
    } else {
        $new_input['min_count'] = $defaults['min_count'];
    }
    
    // Sanitize max_count
    if (isset($input['max_count'])) {
        $max_count = intval($input['max_count']);
        $new_input['max_count'] = ($max_count >= 1 && $max_count <= 999) ? $max_count : $defaults['max_count'];
        
        // Ensure max_count is greater than or equal to min_count
        if ($new_input['max_count'] < $new_input['min_count']) {
            $new_input['max_count'] = $new_input['min_count'];
        }
    } else {
        $new_input['max_count'] = $defaults['max_count'];
    }
    
    // Sanitize update_interval
    if (isset($input['update_interval'])) {
        $update_interval = intval($input['update_interval']);
        $new_input['update_interval'] = ($update_interval >= 1 && $update_interval <= 60) ? $update_interval : $defaults['update_interval'];
    } else {
        $new_input['update_interval'] = $defaults['update_interval'];
    }
    
    // Sanitize change_probability
    $new_input['change_probability'] = [
        'small' => isset($input['small_change_probability']) ? 
            min(100, max(0, intval($input['small_change_probability']))) : 
            $defaults['change_probability']['small'],
    ];
    
    // Calculate large probability as the remainder (100 - small probability)
    $new_input['change_probability']['large'] = 100 - $new_input['change_probability']['small'];
    
    return $new_input;
}

/**
 * Render the main settings page HTML.
 */
function opalp_render_settings_page() {
    // Check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }

    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            // Output security fields for the registered setting group
            settings_fields('opalp_settings_group');
            // Output the settings sections and fields for the page slug
            do_settings_sections('one-pager-settings');
            // Output save settings button
            submit_button('Save Settings');
            ?>
        </form>
    </div>
    <?php
}

/**
 * Enqueue color picker scripts on the plugin settings page.
 */
function opalp_enqueue_admin_scripts($hook_suffix) {
    // Check if we are on our specific settings page
    if ('settings_page_one-pager-settings' !== $hook_suffix) {
        return;
    }

    // Enqueue the WordPress color picker script and styles
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script(
        'opalp-admin-color-picker',
        plugin_dir_url(__FILE__) . '../assets/js/admin-color-picker.js',
        ['wp-color-picker'],
        false,
        true
    );
}
add_action('admin_enqueue_scripts', 'opalp_enqueue_admin_scripts');

?>