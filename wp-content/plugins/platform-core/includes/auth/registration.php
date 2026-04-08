<?php

// Registration Form Shortcode
function platform_registration_form_shortcode() {

    if (is_user_logged_in()) {
        return '<p>You are already registered and logged in.</p>';
    }

    ob_start();
    ?>

    <form method="post">

        <p>
            <label>Username</label><br>
            <input type="text" name="platform_username" required>
        </p>

        <p>
            <label>Email</label><br>
            <input type="email" name="platform_email" required>
        </p>

        <p>
            <label>Password</label><br>
            <input type="password" name="platform_password" required>
        </p>

        <p>
            <label>Select Role</label><br>
            <select name="platform_role" required>
                <option value="inv1">Investor</option>
                <option value="sp1">Sponsor</option>
            </select>
        </p>

        <?php wp_nonce_field('platform_register_action', 'platform_register_nonce'); ?>

        <p>
            <input type="submit" name="platform_register_submit" value="Register">
        </p>

    </form>

    <?php
    return ob_get_clean();
}
add_shortcode('platform_register', 'platform_registration_form_shortcode');

// Handle Registration
function platform_handle_registration() {

    if (!isset($_POST['platform_register_submit'])) {
        return;
    }

    if (!isset($_POST['platform_register_nonce']) ||
        !wp_verify_nonce($_POST['platform_register_nonce'], 'platform_register_action')) {
        return;
    }

    $username = sanitize_user($_POST['platform_username']);
    $email = sanitize_email($_POST['platform_email']);
    $password = $_POST['platform_password'];
    $role = sanitize_text_field($_POST['platform_role']);

    if (username_exists($username) || email_exists($email)) {
        wp_die('Username or email already exists.');
    }

    $allowed_roles = array('inv1', 'sp1', 'sp2');

    if (!in_array($role, $allowed_roles)) {
        wp_die('Invalid role selection.');
    }

    $user_id = wp_create_user($username, $password, $email);

    if (is_wp_error($user_id)) {
        wp_die($user_id->get_error_message());
    }

    wp_update_user(array(
        'ID' => $user_id,
        'role' => $role
    ));

    // Auto login
    wp_set_current_user($user_id);
    wp_set_auth_cookie($user_id);

    // Redirect to dashboard
    wp_redirect(home_url('/dashboard/'));
    exit;
}

add_action('init', 'platform_handle_registration');