<?php
/*
Plugin Name: A/B Test Page Duplicator
Description: Adds a "Create A/B Test" button to duplicate pages for A/B testing, including all custom and native fields.
Version: 1.0
Author: Your Name
*/

// Add "Create A/B Test" link to each page row in the Pages list table
add_filter('page_row_actions', 'ab_test_add_duplicate_link', 10, 2);
function ab_test_add_duplicate_link($actions, $post) {
    if ($post->post_type === 'page') {
        $url = wp_nonce_url(
            admin_url('admin.php?action=ab_test_duplicate_page&post=' . $post->ID),
            'ab_test_duplicate_page_' . $post->ID,
            '_wpnonce'
        );
        $actions['ab_test'] = '<a href="' . esc_url($url) . '">Create A/B Test</a>';
    }
    return $actions;
}

// Handle the duplication process
add_action('admin_action_ab_test_duplicate_page', 'ab_test_duplicate_page');
function ab_test_duplicate_page() {
    if (!isset($_GET['post'], $_GET['_wpnonce']) || !wp_verify_nonce($_GET['_wpnonce'], 'ab_test_duplicate_page_' . $_GET['post'])) {
        wp_die('Invalid request');
    }

    $post_id = absint($_GET['post']);
    $post = get_post($post_id);

    if (!$post || $post->post_type !== 'page') {
        wp_die('Invalid page');
    }

    // Duplicate the post
    $new_post = array(
        'post_title'   => $post->post_title . ' (A/B Test)',
        'post_content' => $post->post_content,
        'post_status'  => 'draft',
        'post_type'    => 'page',
    );
    $new_post_id = wp_insert_post($new_post);

    // Copy custom fields
    $meta = get_post_meta($post_id);
    foreach ($meta as $key => $values) {
        foreach ($values as $value) {
            add_post_meta($new_post_id, $key, maybe_unserialize($value));
        }
    }

    // Redirect to the edit screen for the new page
    wp_redirect(admin_url('post.php?action=edit&post=' . $new_post_id));
    exit;
}