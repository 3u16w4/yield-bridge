<?php

function process_sponsor_payout() {
    
    if (!isset($_POST['process_payout'])) return;

    if (!current_user_can('sp1') && !current_user_can('sp2')) return;

    $investment_id = intval($_POST['investment_id']);
    $reference = sanitize_text_field($_POST['payout_reference']);

    update_post_meta($investment_id, 'payout_status', 'paid');
    update_post_meta($investment_id, 'payout_reference', $reference);
    update_post_meta($investment_id, 'payout_date', date('Y-m-d'));
}
add_action('init', 'process_sponsor_payout');
