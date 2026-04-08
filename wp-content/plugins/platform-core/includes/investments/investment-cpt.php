<?php

function register_investment_post_type() {

    $args = array(
        'label' => 'Investments',
        'public' => false,
        'show_ui' => true,
        'supports' => array('title', 'author'),
        'capability_type' => 'post'
    );

    register_post_type('investment', $args);
}
add_action('init', 'register_investment_post_type');