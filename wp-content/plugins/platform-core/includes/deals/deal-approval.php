<?php
function handle_deal_approval() {

    if (!current_user_can('administrator')) {
        return;
    }

    if (isset($_GET['approve_deal'])) {

        $deal_id = intval($_GET['approve_deal']);

        wp_update_post(array(
            'ID' => $deal_id,
            'post_status' => 'publish'
        ));

        wp_redirect(admin_url('edit.php?post_type=deal'));
        exit;
    }

    if (isset($_GET['reject_deal'])) {

        $deal_id = intval($_GET['reject_deal']);

        wp_update_post(array(
            'ID' => $deal_id,
            'post_status' => 'draft'
        ));

        wp_redirect(admin_url('edit.php?post_type=deal'));
        exit;
    }
}
add_action('admin_init', 'handle_deal_approval');

function add_deal_action_links($actions, $post) {

    if ($post->post_type == 'deal' && $post->post_status == 'pending') {

        $approve_url = admin_url('?approve_deal=' . $post->ID);
        $reject_url  = admin_url('?reject_deal=' . $post->ID);

        $actions['approve'] = '<a href="'.$approve_url.'">Approve</a>';
        $actions['reject']  = '<a href="'.$reject_url.'">Reject</a>';
    }

    return $actions;
}
add_filter('post_row_actions', 'add_deal_action_links', 10, 2);