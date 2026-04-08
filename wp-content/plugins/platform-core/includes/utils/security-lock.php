<?php

function platform_acquire_deal_lock($deal_id) {

    $lock_key = 'investment_lock';
    $lock_time = get_post_meta($deal_id, $lock_key, true);

    // Lock expires after 10 seconds
    if ($lock_time && (time() - $lock_time) < 10) {
        return false;
    }

    update_post_meta($deal_id, $lock_key, time());

    return true;
}

function platform_release_deal_lock($deal_id) {

    delete_post_meta($deal_id, 'investment_lock');

}
