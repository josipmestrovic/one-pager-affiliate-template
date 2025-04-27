<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Initialize the visitor count
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['visitor_count'])) {
    $_SESSION['visitor_count'] = rand(60, 200); // Initial random number between 60 and 200
}

function update_visitor_count() {
    if (!isset($_SESSION['visitor_count'])) {
        $_SESSION['visitor_count'] = rand(60, 200);
    }

    $current_count = $_SESSION['visitor_count'];

    // Determine the change (-2, -1, 0, +1, or +2 with varying probabilities)
    $change = rand(0, 9) < 5 ? rand(-1, 1) : (rand(0, 1) ? 2 : -2); // Higher chance for -1, 0, +1, lower for -2, +2

    // Update the count, ensuring it stays between 60 and 200
    $new_count = $current_count + $change;
    if ($new_count < 60) {
        $new_count = 60;
    } elseif ($new_count > 200) {
        $new_count = 200;
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
            }, 5000); // Update every 5 seconds
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