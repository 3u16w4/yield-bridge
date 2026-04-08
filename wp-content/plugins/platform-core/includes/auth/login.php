<?php

// Login Shortcode
function platform_login_form_shortcode() {

    if (is_user_logged_in()) {
        return '<p>You are already logged in.</p>';
    }

    ob_start();

    wp_login_form(array(
        'redirect' => home_url('/dashboard/'),
        'remember' => true
    ));

    return ob_get_clean();
}

add_shortcode('platform_login', 'platform_login_form_shortcode');