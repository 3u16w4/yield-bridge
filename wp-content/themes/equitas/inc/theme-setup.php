<?php
/**
 * Theme Setup
 */

if (!defined('ABSPATH')) {
    exit;
}

function equitas_theme_setup() {

    // Enable title tag
    add_theme_support('title-tag');

    // Enable featured images
    add_theme_support('post-thumbnails');

    // Register menus
    register_nav_menus([
       'primary' => 'Primary Navigation',
       'footer'  => 'Footer Navigation',
    ]);

    // HTML5 support
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'gallery',
        'caption'
    ]);

}

add_action('after_setup_theme', 'equitas_theme_setup');