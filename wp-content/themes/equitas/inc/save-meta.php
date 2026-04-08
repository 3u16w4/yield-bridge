<?php
if (!defined('ABSPATH')) exit;

/**
 * Save Meta Box Data (Gutenberg Safe)
 */
add_action('save_post_page', function ($post_id) {

    // 🔍 DEBUG
    error_log('SAVE TRIGGERED: ' . $post_id);

    // 1. Prevent autosave overwrite
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    // 2. Permissions
    if (!current_user_can('edit_post', $post_id)) {
        error_log('Permission failed');
        return;
    }

    // 3. Only FRONT PAGE
    if ((int) get_option('page_on_front') !== (int) $post_id) {
        error_log('Not front page');
        return;
    }

    // 4. Nonce check (SOFT CHECK — DO NOT BLOCK)
    if (isset($_POST['homepage_nonce']) &&
        !wp_verify_nonce($_POST['homepage_nonce'], 'save_homepage')) {
        error_log('Nonce invalid');
        return;
    }

    /**
     * ✅ SAVE HERO FIELDS
     */

    update_post_meta($post_id, 'hero_badge',
        sanitize_text_field($_POST['hero_badge'] ?? '')
    );

    update_post_meta($post_id, 'hero_title',
        sanitize_text_field($_POST['hero_title'] ?? '')
    );

    update_post_meta($post_id, 'hero_title_highlight',
        sanitize_text_field($_POST['hero_title_highlight'] ?? '')
    );

    update_post_meta($post_id, 'hero_subtitle',
        sanitize_textarea_field($_POST['hero_subtitle'] ?? '')
    );

    /**
     * ✅ BUTTONS
     */

    update_post_meta($post_id, 'hero_btn1_text',
        sanitize_text_field($_POST['hero_btn1_text'] ?? '')
    );

    update_post_meta($post_id, 'hero_btn1_link',
        esc_url_raw($_POST['hero_btn1_link'] ?? '')
    );

    update_post_meta($post_id, 'hero_btn2_text',
        sanitize_text_field($_POST['hero_btn2_text'] ?? '')
    );

    update_post_meta($post_id, 'hero_btn2_link',
        esc_url_raw($_POST['hero_btn2_link'] ?? '')
    );

    /**
     * ✅ IMAGE
     */

    update_post_meta($post_id, 'hero_image',
        esc_url_raw($_POST['hero_image'] ?? '')
    );

    error_log('SAVE COMPLETED: ' . $post_id);

    /**
     * ✅ TRUST SECTION
     */

    update_post_meta(
        $post_id,
        'trust_title',
        sanitize_text_field($_POST['trust_title'] ?? '')
    );

    update_post_meta(
        $post_id,
        'trust_logos',
        sanitize_textarea_field($_POST['trust_logos'] ?? '')
    );

    /**
 * ✅ METRICS
 */
for ($i = 1; $i <= 3; $i++) {

    update_post_meta($post_id, "metric{$i}_label",
        sanitize_text_field($_POST["metric{$i}_label"] ?? '')
    );

    update_post_meta($post_id, "metric{$i}_value",
        sanitize_text_field($_POST["metric{$i}_value"] ?? '')
    );

    update_post_meta($post_id, "metric{$i}_note",
        sanitize_text_field($_POST["metric{$i}_note"] ?? '')
    );

    update_post_meta($post_id, "metric{$i}_icon",
        sanitize_text_field($_POST["metric{$i}_icon"] ?? '')
    );

    update_post_meta($post_id, "metric{$i}_color",
        sanitize_text_field($_POST["metric{$i}_color"] ?? '')
    );

    update_post_meta($post_id, "metric{$i}_type",
        sanitize_text_field($_POST["metric{$i}_type"] ?? '')
    );
}

});