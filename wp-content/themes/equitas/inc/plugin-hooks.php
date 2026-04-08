<?php

// Investor Metrics
if (!function_exists('equitas_get_investor_metrics')) {
    function equitas_get_investor_metrics($user_id) {

        if (function_exists('platform_get_investor_metrics')) {
            return platform_get_investor_metrics($user_id);
        }

        return [];
    }
}

// Investor Investments
if (!function_exists('equitas_get_investments')) {
    function equitas_get_investments($user_id) {

        if (function_exists('platform_get_user_investments')) {
            return platform_get_user_investments($user_id);
        }

        return [];
    }
}

add_filter('use_block_editor_for_post_type', function ($use_block_editor, $post_type) {
    if ($post_type === 'page') {
        return false; // Disable Gutenberg for pages
    }
    return $use_block_editor;
}, 10, 2);