<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function opalp_enqueue_popup_assets() {
    wp_enqueue_style('opalp-popup-style', plugin_dir_url(__FILE__) . 'popup.css');
    wp_enqueue_script('opalp-popup-script', plugin_dir_url(__FILE__) . 'popup.js', array(), false, true);
}
add_action('wp_enqueue_scripts', 'opalp_enqueue_popup_assets');

function opalp_render_popup() {
    $button_text = get_field('button_1_text');
    $button_url = get_field('button_1_url');
    ?>
    <div id="popup-container">
        <div id="popup-content">
            <button id="popup-close">&times;</button>
            <h2>Still thinking?</h2>
            <p>Click below to get an exclusive discount!</p>
            <a href="<?php echo esc_url($button_url); ?>" class="btn btn-primary">
                <?php echo esc_html($button_text); ?>
            </a>
        </div>
    </div>
    <?php
}
add_action('wp_footer', 'opalp_render_popup');