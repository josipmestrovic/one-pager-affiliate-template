<?php
/**
 * Plugin Name: Tab Teaser
 * Plugin URI:  https://example.com/
 * Description: Changes the tab’s title when the user navigates away. Users can set a custom inactive title, enable flashing, and control the flashing interval.
 * Version:     2.0
 * Author:      Your Name
 * Author URI:  https://example.com/
 * License:     GPLv2 or later
 * Text Domain: tab-teaser
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Remove WordPress's default favicon logic to allow custom favicon handling
remove_action('wp_head', 'wp_site_icon');

/**
 * 1. SANITIZERS
 */
function tab_teaser_sanitize_checkbox( $value ) {
    return ( $value === '1' ) ? '1' : '0';
}

/**
 * 2. REGISTER SETTINGS
 */
function tab_teaser_register_settings() {

    // 2.1 Inactive Title
    register_setting(
        'tab_teaser_settings_group',
        'tab_teaser_inactive_title',
        [
            'type'              => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default'           => '',
        ]
    );

    // 2.2 Enable Flashing (checkbox)
    register_setting(
        'tab_teaser_settings_group',
        'tab_teaser_enable_flashing',
        [
            'type'              => 'boolean',
            'sanitize_callback' => 'tab_teaser_sanitize_checkbox',
            'default'           => 0,
        ]
    );

    // 2.3 Flashing Interval (integer)
    register_setting(
        'tab_teaser_settings_group',
        'tab_teaser_flashing_interval',
        [
            'type'              => 'integer',
            'sanitize_callback' => 'absint',
            'default'           => 2, // default 2 seconds
        ]
    );

    // 2.4 Inactive Favicon
    register_setting(
        'tab_teaser_settings_group',
        'tab_teaser_inactive_favicon',
        [
            'type'              => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default'           => '',
        ]
    );

    // Add a single settings section
    add_settings_section(
        'tab_teaser_settings_section',
        __( 'Tab Teaser Settings', 'tab-teaser' ),
        'tab_teaser_settings_section_desc',
        'tab_teaser_settings'
    );

    // Field: Inactive Title
    add_settings_field(
        'tab_teaser_inactive_title_field',
        __( 'Inactive Title:', 'tab-teaser' ),
        'tab_teaser_inactive_title_field_cb',
        'tab_teaser_settings',
        'tab_teaser_settings_section'
    );

    // Field: Enable Flashing
    add_settings_field(
        'tab_teaser_enable_flashing_field',
        __( 'Enable Flashing Title:', 'tab-teaser' ),
        'tab_teaser_enable_flashing_field_cb',
        'tab_teaser_settings',
        'tab_teaser_settings_section'
    );

    // Field: Flashing Interval
    add_settings_field(
        'tab_teaser_flashing_interval_field',
        __( 'Flashing Interval (seconds):', 'tab-teaser' ),
        'tab_teaser_flashing_interval_field_cb',
        'tab_teaser_settings',
        'tab_teaser_settings_section'
    );

    // Field: Inactive Favicon
    add_settings_field(
        'tab_teaser_inactive_favicon_field',
        __( 'Inactive Favicon:', 'tab-teaser' ),
        'tab_teaser_inactive_favicon_field_cb',
        'tab_teaser_settings',
        'tab_teaser_settings_section'
    );
}
add_action( 'admin_init', 'tab_teaser_register_settings' );

/**
 * 3. SECTION DESCRIPTION
 */
function tab_teaser_settings_section_desc() {
    echo '<p>' . esc_html__( 'Configure how the tab title behaves when the user navigates away from the browser tab.', 'tab-teaser' ) . '</p>';
}

/**
 * 4. FIELD CALLBACKS
 */

// 4.1: Inactive Title
function tab_teaser_inactive_title_field_cb() {
    $option_value = get_option( 'tab_teaser_inactive_title', '' );
    ?>
    <input 
        type="text" 
        id="tab_teaser_inactive_title"
        name="tab_teaser_inactive_title" 
        value="<?php echo esc_attr( $option_value ); ?>" 
        size="40"
        placeholder="<?php esc_attr_e( 'e.g. Return to shopping!', 'tab-teaser' ); ?>"
    />
    <?php
}

// 4.2: Enable Flashing
function tab_teaser_enable_flashing_field_cb() {
    $value = get_option( 'tab_teaser_enable_flashing', '0' );
    ?>
    <input 
        type="checkbox" 
        id="tab_teaser_enable_flashing"
        name="tab_teaser_enable_flashing" 
        value="1"
        <?php checked( '1', $value ); ?>
    />
    <label for="tab_teaser_enable_flashing">
        <?php esc_html_e( 'Check to alternate the tab title at a regular interval when inactive.', 'tab-teaser' ); ?>
    </label>
    <?php
}

// 4.3: Flashing Interval
function tab_teaser_flashing_interval_field_cb() {
    $interval_value = get_option( 'tab_teaser_flashing_interval', 2 );
    ?>
    <input 
        type="number" 
        id="tab_teaser_flashing_interval"
        name="tab_teaser_flashing_interval"
        value="<?php echo esc_attr( $interval_value ); ?>"
        step="1" 
        min="1"
        style="width:60px;"
    />
    <?php
    echo ' ' . esc_html__( 'seconds', 'tab-teaser' );
}

// 4.4: Inactive Favicon
function tab_teaser_inactive_favicon_field_cb() {
    $favicon_value = get_option( 'tab_teaser_inactive_favicon', '' );
    $favicons = [
        'exclamation-mark.png' => 'Exclamation Mark',
        'shopping-cart-icon.png' => 'Shopping Cart Icon'
    ];
    $default_favicon_url = get_site_icon_url();

    echo '<div style="display: flex; align-items: center;">';
    echo '<select name="tab_teaser_inactive_favicon" id="tab-teaser-favicon-select" style="margin-right: 20px;">';
    echo '<option value="">' . esc_html__( 'Default Favicon', 'tab-teaser' ) . '</option>';
    foreach ( $favicons as $file => $label ) {
        $selected = selected( $favicon_value, $file, false );
        echo '<option value="' . esc_attr( $file ) . '" ' . $selected . '>' . esc_html( $label ) . '</option>';
    }
    echo '</select>';

    // Display the selected favicon image
    echo '<div id="favicon-preview" style="width: 32px; height: 32px;">';
    if ( $favicon_value ) {
        echo '<img src="' . esc_url( plugin_dir_url( __FILE__ ) . 'inactive-favicons/' . $favicon_value ) . '" alt="Favicon Preview" style="max-width: 100%; max-height: 100%;">';
    } elseif ( $default_favicon_url ) {
        echo '<img src="' . esc_url( $default_favicon_url ) . '" alt="Default Favicon Preview" style="max-width: 100%; max-height: 100%;">';
    }
    echo '</div>';
    echo '</div>';

    // Add JavaScript to dynamically update the preview
    $plugin_url = plugin_dir_url( __FILE__ );
    echo '<script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            const selectElement = document.getElementById("tab-teaser-favicon-select");
            const previewElement = document.getElementById("favicon-preview");

            selectElement.addEventListener("change", function() {
                const selectedValue = this.value;
                if (selectedValue) {
                    previewElement.innerHTML = `<img src=\"' . esc_url( $plugin_url ) . 'inactive-favicons/` + selectedValue + `\" alt=\"Favicon Preview\" style=\"max-width: 100%; max-height: 100%;\">`;
                } else {
                    const defaultFaviconUrl = "' . esc_url( $default_favicon_url ) . '";
                    if (defaultFaviconUrl) {
                        previewElement.innerHTML = `<img src=\"` + defaultFaviconUrl + `\" alt=\"Default Favicon Preview\" style=\"max-width: 100%; max-height: 100%;\">`;
                    } else {
                        previewElement.innerHTML = "";
                    }
                }
            });
        });
    </script>';
}

/**
 * 5. ADD MENU PAGE
 */
function tab_teaser_add_admin_menu() {
    add_menu_page(
        __( 'Tab Teaser', 'tab-teaser' ),
        __( 'Tab Teaser', 'tab-teaser' ),
        'manage_options',
        'tab_teaser',
        'tab_teaser_settings_page_html',
        'dashicons-admin-site',
        60
    );
}
add_action( 'admin_menu', 'tab_teaser_add_admin_menu' );

/**
 * 6. RENDER SETTINGS PAGE
 */
function tab_teaser_settings_page_html() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="POST">
            <?php
                settings_fields( 'tab_teaser_settings_group' );
                do_settings_sections( 'tab_teaser_settings' );
                submit_button( __( 'Save Settings', 'tab-teaser' ) );
            ?>
        </form>
    </div>

    <!-- Hide/Show the Flashing Interval field based on the Enable Flashing checkbox -->
    <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function(){
        var enableFlashingCheckbox = document.getElementById("tab_teaser_enable_flashing");
        var flashingIntervalRow    = document.getElementById("tab_teaser_flashing_interval_field").closest("tr");

        function toggleIntervalField() {
            if (enableFlashingCheckbox.checked) {
                flashingIntervalRow.style.display = "";
            } else {
                flashingIntervalRow.style.display = "none";
            }
        }

        // On page load
        toggleIntervalField();

        // On checkbox change
        enableFlashingCheckbox.addEventListener("change", toggleIntervalField);
    });
    </script>
    <?php
}

/**
 * 7. ENQUEUE FRONT-END SCRIPT
 */
function tab_teaser_enqueue_script() {
    // Register
    wp_register_script(
        'tab-teaser-script',
        plugin_dir_url( __FILE__ ) . 'js/tab-teaser.js',
        [],
        '2.0',
        true
    );

    // Get user settings
    $inactive_title     = get_option( 'tab_teaser_inactive_title', '' );
    $enable_flashing    = get_option( 'tab_teaser_enable_flashing', '0' );
    $flashing_interval  = get_option( 'tab_teaser_flashing_interval', 2 );
    $inactive_favicon   = get_option( 'tab_teaser_inactive_favicon', '' );

    // Localize the script
    wp_localize_script(
        'tab-teaser-script',
        'tabTeaserData',
        [
            'inactiveTitle'    => $inactive_title,
            'enableFlashing'   => $enable_flashing,
            'flashingInterval' => $flashing_interval,
            'inactiveFavicon'  => $inactive_favicon,
            'pluginUrl'        => plugin_dir_url( __FILE__ )
        ]
    );

    wp_enqueue_script( 'tab-teaser-script' );
}
add_action( 'wp_enqueue_scripts', 'tab_teaser_enqueue_script' );
