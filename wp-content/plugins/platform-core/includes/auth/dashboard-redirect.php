<?php

//Role Based Dashboard Redirect
function role_based_dashboard_redirect() {

    if (!is_page('dashboard')) {
        return;
    }

    if (!is_user_logged_in()) {
        wp_redirect(wp_login_url());
        exit;
    }

    $user = wp_get_current_user();
    $roles = (array) $user->roles;

    // Investors
    if (in_array('inv1', $roles) || 
        in_array('inv2', $roles) || 
        in_array('inv3', $roles)) {
        wp_redirect(home_url('/dashboard/investor/'));
        exit;
    }

    // Sponsors
    if (in_array('sp1', $roles) || 
        in_array('sp2', $roles)) {
        wp_redirect(home_url('/dashboard/sponsor/'));
        exit;
    }

    // Committee
    if (in_array('ic1', $roles)) {
        wp_redirect(home_url('/dashboard/committee/'));
        exit;
    }

}
add_action('template_redirect', 'role_based_dashboard_redirect');