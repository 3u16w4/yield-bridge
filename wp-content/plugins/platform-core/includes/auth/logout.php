<?php

// Clean Logout Handler
function platform_handle_logout() {

    if (isset($_GET['platform_logout']) && $_GET['platform_logout'] === 'true') {

        if (is_user_logged_in()) {
            wp_logout();
        }

        wp_redirect(home_url('/'));
        exit;
    }
}
add_action('init', 'platform_handle_logout');

// Generate Secure Logout URL
function platform_logout_url() {
    return esc_url(home_url('/?platform_logout=true'));
}

// Logout via /logout/ page
function platform_logout_page() {

    if (is_page('logout')) {

        if (is_user_logged_in()) {
            wp_logout();
        }

        wp_redirect(home_url('/'));
        exit;
    }
}
add_action('template_redirect', 'platform_logout_page');
