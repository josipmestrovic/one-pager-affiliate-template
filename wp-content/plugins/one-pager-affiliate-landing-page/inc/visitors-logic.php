<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Initialize the visitor count
if (!isset($_SESSION)) {
    session_start();
}

// Get visitor count settings from options, or use defaults if not set
function opalp_get_visitor_settings() {
    // Check if we have saved visitor count settings
    $visitor_settings = get_option('opalp_visitor_count', []);
    
    // If settings don't exist, use defaults from settings page
    if (empty($visitor_settings) && function_exists('opalp_get_visitor_count_defaults')) {
        $visitor_settings = opalp_get_visitor_count_defaults();
    } else if (empty($visitor_settings)) {
        // Fallback defaults in case function doesn't exist
        $visitor_settings = [
            'min_count' => 60,
            'max_count' => 200,
            'update_interval' => 5,
            'change_probability' => [
                'small' => 50,
                'large' => 50,
            ]
        ];
    }
    
    return $visitor_settings;
}

// Initialize the visitor count with settings-defined range
if (!isset($_SESSION['visitor_count'])) {
    $settings = opalp_get_visitor_settings();
    $_SESSION['visitor_count'] = rand($settings['min_count'], $settings['max_count']);
}

function update_visitor_count() {
    $settings = opalp_get_visitor_settings();

    if (!isset($_SESSION['visitor_count'])) {
        $_SESSION['visitor_count'] = rand($settings['min_count'], $settings['max_count']);
    }

    $current_count = $_SESSION['visitor_count'];

    // Determine the change based on probability settings
    $random = rand(1, 100);
    if ($random <= $settings['change_probability']['small']) {
        // Small change (-1, 0, +1)
        $change = rand(-1, 1);
    } else {
        // Large change (-2, +2)
        $change = rand(0, 1) ? 2 : -2;
    }

    // Update the count, ensuring it stays within min/max range
    $new_count = $current_count + $change;
    if ($new_count < $settings['min_count']) {
        $new_count = $settings['min_count'];
    } elseif ($new_count > $settings['max_count']) {
        $new_count = $settings['max_count'];
    }

    $_SESSION['visitor_count'] = $new_count;

    return $new_count;
}

// Hook to update the visitor count periodically
add_action('wp_footer', function () {
    // Check if the top bar visitor count should be shown
    global $post;
    $show_visitor_count_top = false;
    if (is_page() && get_page_template_slug($post->ID) === 'one-pager-template.php') {
        // Fetch from the group field
        $header_bar_content = get_field('header_bar_content', $post->ID);
        $show_visitor_count_top = isset($header_bar_content['show_visitor_count_in_top_header']) ? $header_bar_content['show_visitor_count_in_top_header'] : false;
    }

    // Only output the script if needed (either main count or top count is shown)
    $output_script = $show_visitor_count_top || is_page_template('one-pager-template.php'); // Assume main count always shown on template

    if ($output_script) {
        // Get the update interval from settings
        $settings = opalp_get_visitor_settings();
        $update_interval = $settings['update_interval'] * 1000; // Convert to milliseconds
        
        echo '<script>
            setInterval(function () {
                fetch("' . admin_url('admin-ajax.php?action=update_visitor_count') . '")
                    .then(response => response.json())
                    .then(data => {
                        const visitorElement = document.getElementById("visitor-count");
                        if (visitorElement) {
                            visitorElement.textContent = data.count + " People Are Checking Out This Product Right Now";
                        }
                        // Also update the top bar visitor count if the element exists
                        const topVisitorElement = document.getElementById("top-visitor-count");
                        if (topVisitorElement) { // Check if the element exists
                            topVisitorElement.textContent = data.count + " People Viewing";
                        }
                    });
            }, ' . $update_interval . '); // Update interval from settings
        </script>';
    }
});

// AJAX handler to return the updated visitor count
add_action('wp_ajax_update_visitor_count', 'ajax_update_visitor_count');
add_action('wp_ajax_nopriv_update_visitor_count', 'ajax_update_visitor_count');
function ajax_update_visitor_count() {
    $count = update_visitor_count();
    wp_send_json(['count' => $count]);
}