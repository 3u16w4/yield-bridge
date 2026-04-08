<?php

// Display Sponsor Deals
function platform_my_deals_shortcode() {

    if (!current_user_can('sp1') && !current_user_can('sp2')) {
        return '<p>Access denied.</p>';
    }

    $args = array(
        'post_type'      => 'deal',
        'author'         => get_current_user_id(),
        'post_status'    => array('pending', 'publish', 'draft')
    );

    $deals = get_posts($args);

    ob_start();

    if ($deals) {
        echo '<ul>';
        foreach ($deals as $deal) {

            $deal_link = get_permalink($deal->ID);

            echo '<li>';
            echo '<a href="' . esc_url($deal_link) . '">';
            echo esc_html($deal->post_title);
            echo '</a>';
            echo ' - Status: ' . esc_html($deal->post_status);
            echo '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No deals yet.</p>';
    }

    return ob_get_clean();
}
add_shortcode('platform_my_deals', 'platform_my_deals_shortcode');