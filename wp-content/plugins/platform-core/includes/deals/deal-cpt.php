<?php

// Register Deals Custom Post Type
function register_deal_post_type() {

    $args = array(
        'label' => 'Deals',
        'public' => true,                 
        'has_archive' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'supports' => array('title', 'editor', 'author'),
        'menu_icon' => 'dashicons-chart-line',
        'rewrite' => array('slug' => 'deal'), 
    );

    register_post_type('deal', $args);
}
add_action('init', 'register_deal_post_type');

// Restrict project admin access
function platform_restrict_deal_access() {

    if (is_admin() && isset($_GET['post_type']) && $_GET['post_type'] === 'deal') {

        if (!current_user_can('sp1') && !current_user_can('sp2') && !current_user_can('administrator')) {
            wp_die('Access denied.');
        }
    }
}
add_action('admin_init', 'platform_restrict_deal_access');

// Handle Deal Creation
function platform_handle_deal_creation() {

    if (!isset($_POST['create_deal_submit'])) {
        return;
    }

    if (!isset($_POST['create_deal_nonce']) ||
        !wp_verify_nonce($_POST['create_deal_nonce'], 'create_deal_action')) {
        return;
    }

    if (!current_user_can('sp1') && !current_user_can('sp2')) {
        wp_die('Unauthorized');
    }

    $title = sanitize_text_field($_POST['deal_title']);
    $description = sanitize_textarea_field($_POST['deal_description']);

    $post_id = wp_insert_post(array(
        'post_title' => $title,
        'post_content' => $description,
        'post_status' => 'pending',
        'post_type' => 'deal',
        'post_author' => get_current_user_id()
    ));

    wp_redirect(home_url('/dashboard/sponsor/deals/'));
    exit;

}
add_action('init', 'platform_handle_deal_creation');