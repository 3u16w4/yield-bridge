<?php
if (!defined('ABSPATH')) exit;

/**
 * Enqueue Theme Assets (Vite + Dashboard Aware)
 */
function equitas_enqueue_assets() {

    $theme_dir = get_template_directory();
    $theme_uri = get_template_directory_uri();

    $css_path = $theme_dir . '/assets/dist/style.css';
    $js_path  = $theme_dir . '/assets/dist/main.js';

    // =========================
    // SAFE VERSIONING (NO ERRORS)
    // =========================
    $css_version = file_exists($css_path) ? filemtime($css_path) : '1.0';
    $js_version  = file_exists($js_path) ? filemtime($js_path) : '1.0';

    // =========================
    // MAIN STYLES (VITE BUILD)
    // =========================
    if (file_exists($css_path)) {
        wp_enqueue_style(
            'equitas-style',
            $theme_uri . '/assets/dist/style.css',
            [],
            $css_version
        );
    }

    // =========================
    // MAIN SCRIPT (VITE BUILD)
    // =========================
    if (file_exists($js_path)) {
        wp_enqueue_script(
            'equitas-main',
            $theme_uri . '/assets/dist/main.js',
            [],
            $js_version,
            true
        );
    }

    // =========================
    // GOOGLE FONTS
    // =========================
    wp_enqueue_style(
        'equitas-fonts',
        'https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap',
        [],
        null
    );

    // =========================
    // MATERIAL ICONS
    // =========================
    wp_enqueue_style(
        'equitas-icons',
        'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap',
        [],
        null
    );

    // =========================
    // DASHBOARD-SPECIFIC ASSETS
    // =========================
    if (is_page_template('templates/dashboard-sponsor.php')) {

        $dashboard_css = $theme_dir . '/assets/css/dashboard.css';
        $dashboard_js  = $theme_dir . '/assets/js/dashboard.js';

        if (file_exists($dashboard_css)) {
            wp_enqueue_style(
                'equitas-dashboard',
                $theme_uri . '/assets/css/dashboard.css',
                ['equitas-style'],
                filemtime($dashboard_css)
            );
        }

        if (file_exists($dashboard_js)) {
            wp_enqueue_script(
                'equitas-dashboard-js',
                $theme_uri . '/assets/js/dashboard.js',
                ['equitas-main'],
                filemtime($dashboard_js),
                true
            );
        }
    }
}

add_action('wp_enqueue_scripts', 'equitas_enqueue_assets');