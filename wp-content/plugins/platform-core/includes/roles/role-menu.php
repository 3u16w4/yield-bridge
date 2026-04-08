<?php

//Role Based Menu Switch
function custom_role_based_menu($args) {

    if ($args['theme_location'] !== 'primary') {
        return $args;
    }

    if (!is_user_logged_in()) {
        return $args;
    }

    $user = wp_get_current_user();
    $roles = (array) $user->roles;

    if (array_intersect(['inv1','inv2','inv3'], $roles)) {
        $args['menu'] = 'Investor Menu';
    }

    elseif (array_intersect(['sp1','sp2'], $roles)) {
        $args['menu'] = 'Sponsor Menu';
    }

    elseif (in_array('ic1', $roles)) {
        $args['menu'] = 'Committee Menu';
    }

    return $args;
}
add_filter('wp_nav_menu_args','custom_role_based_menu');
