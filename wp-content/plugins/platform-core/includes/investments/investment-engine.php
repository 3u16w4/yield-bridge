<?php

function process_investment_submission() {

    if (!isset($_POST['submit_investment'])) return;

    if (!isset($_POST['investment_nonce']) ||
        !wp_verify_nonce($_POST['investment_nonce'], 'submit_investment_action')) {
        return;
    }

    if (!current_user_can('inv1') && !current_user_can('inv2')) {
        return;
    }

    $deal_id = intval($_POST['deal_id']);
    $amount  = floatval($_POST['investment_amount']);
    $user_id = get_current_user_id();

    if ($amount <= 0) return;

    // 🔒 Acquire atomic lock
    if (!platform_acquire_deal_lock($deal_id)) {
        wp_die('Another investment is currently processing. Please try again.');
    }

    $minimum_investment = floatval(get_post_meta($deal_id, 'minimum_investment', true));
    if ($amount < $minimum_investment) {
        platform_release_deal_lock($deal_id);
        wp_die('Investment amount is below the minimum required.');
    }

    $capital_required = floatval(get_post_meta($deal_id, 'capital_required', true));

    // IMPORTANT: reload capital after lock
    $capital_raised = floatval(get_post_meta($deal_id, 'capital_raised', true));

    $remaining = $capital_required - $capital_raised;

    if ($remaining <= 0) {
        platform_release_deal_lock($deal_id);
        wp_die('This deal is already fully funded.');
    }

    if ($amount > $remaining) {
        platform_release_deal_lock($deal_id);
        wp_die('Investment exceeds remaining funding amount.');
    }

    $roi = floatval(get_post_meta($deal_id, 'roi_percentage', true));
    $settlement_date = get_post_meta($deal_id, 'settlement_date', true);

    $expected_return = $amount * (1 + ($roi / 100));

    $investment_id = wp_insert_post(array(
        'post_type'   => 'investment',
        'post_status' => 'publish',
        'post_title'  => 'Investment - Deal #' . $deal_id,
        'post_author' => $user_id
    ));

    if ($investment_id) {

        update_post_meta($investment_id, 'deal_id', $deal_id);
        update_post_meta($investment_id, 'amount', $amount);
        update_post_meta($investment_id, 'expected_return', $expected_return);
        update_post_meta($investment_id, 'settlement_date', $settlement_date);

        update_post_meta($investment_id, 'payout_status', 'pending');
        update_post_meta($investment_id, 'payout_reference', '');
        update_post_meta($investment_id, 'payout_date', '');

        // Recalculate capital again (safety)
        $capital_raised = floatval(get_post_meta($deal_id, 'capital_raised', true));
        $new_total = $capital_raised + $amount;

        update_post_meta($deal_id, 'capital_raised', $new_total);

        // Update investor count
        $existing = get_posts(array(
            'post_type'  => 'investment',
            'meta_key'   => 'deal_id',
            'meta_value' => $deal_id,
            'numberposts'=> -1
        ));

        $unique = array();
        foreach ($existing as $inv) {
            $unique[] = $inv->post_author;
        }

        update_post_meta($deal_id, 'investor_count', count(array_unique($unique)));

        if ($new_total >= $capital_required) {
            update_post_meta($deal_id, 'deal_status', 'Funded');
        }

    }

    // 🔓 Release lock
    platform_release_deal_lock($deal_id);

    $funding_end = get_post_meta($deal_id,'funding_end_date',true);

    if ($funding_end && strtotime(current_time('Y-m-d')) > strtotime($funding_end)) {
    wp_die('This deal is no longer accepting investments.');
    }

}
add_action('init', 'process_investment_submission');