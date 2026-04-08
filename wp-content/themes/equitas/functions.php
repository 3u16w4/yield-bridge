<?php

$inc_files = array(
    '/inc/enqueue.php',
    '/inc/theme-setup.php',
    '/inc/plugin-hooks.php',
    '/inc/meta-boxes.php',
    '/inc/save-meta.php'
);

foreach ($inc_files as $file) {
    $path = get_template_directory() . $file;

    if (file_exists($path)) {
        require_once $path;
    }
}

/**
 * Format metric values
 */
function format_metric_value($value, $type) {

    if (!$value) return '';

    switch ($type) {

        case 'currency':
            // Remove non-numeric
            $num = floatval(preg_replace('/[^\d.]/', '', $value));

            if ($num >= 1000000000) {
                return '$' . number_format($num / 1000000000, 1) . 'B+';
            } elseif ($num >= 1000000) {
                return '$' . number_format($num / 1000000, 1) . 'M+';
            } else {
                return '$' . number_format($num);
            }

        case 'percent':
            return rtrim($value, '%') . '%';

        default:
            return $value;
    }
}