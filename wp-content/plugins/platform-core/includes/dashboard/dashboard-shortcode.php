<?php

function platform_marketplace_dashboard() {

    if (!is_user_logged_in()) {
        return "<p>Please login to access dashboard.</p>";
    }

    ob_start();

    include plugin_dir_path(__FILE__) . '../templates/marketplace-dashboard.php';

    return ob_get_clean();
}

add_shortcode('platform_marketplace_dashboard', 'platform_marketplace_dashboard');