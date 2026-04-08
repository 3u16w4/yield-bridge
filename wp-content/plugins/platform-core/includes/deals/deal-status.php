<?php

function platform_update_deal_funding_status() {

    $today = current_time('Y-m-d');

    $args = array(
        'post_type' => 'deal',
        'post_status' => 'publish',
        'posts_per_page' => -1
    );

    $deals = new WP_Query($args);

    if ($deals->have_posts()) {

        while ($deals->have_posts()) {
            $deals->the_post();

            $deal_id = get_the_ID();

            $start = get_post_meta($deal_id, 'funding_start_date', true);
            $end   = get_post_meta($deal_id, 'funding_end_date', true);

            $status = get_post_meta($deal_id, 'deal_status', true);

            if ($today < $start) {

                if ($status !== 'Scheduled') {
                    update_post_meta($deal_id, 'deal_status', 'Scheduled');
                }

            } elseif ($today >= $start && $today <= $end) {

                if ($status !== 'Open') {
                    update_post_meta($deal_id, 'deal_status', 'Open');
                }

            } elseif ($today > $end) {

                if ($status !== 'Funding Closed') {
                    update_post_meta($deal_id, 'deal_status', 'Funding Closed');
                }

            }

        }

        wp_reset_postdata();
    }

}
add_action('init', 'platform_update_deal_funding_status');