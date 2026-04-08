<?php
if (!defined('ABSPATH')) exit;

/**
 * Register Meta Box
 */
add_action('add_meta_boxes', function () {
    add_meta_box(
        'homepage_fields',
        'Homepage Content',
        'render_homepage_fields',
        'page',
        'normal',
        'high'
    );
});

/**
 * Render Meta Box
 */
function render_homepage_fields($post) {

    // Only show on FRONT PAGE
    if ((int) get_option('page_on_front') !== (int) $post->ID) {
        echo '<p>This section is only available for the homepage.</p>';
        return;
    }

    // Security nonce
    wp_nonce_field('save_homepage', 'homepage_nonce');

    // Gutenberg compatibility
    echo '<input type="hidden" name="custom_meta_box_present" value="1">';

    // Get all values
    $hero_badge            = get_post_meta($post->ID, 'hero_badge', true);
    $hero_title            = get_post_meta($post->ID, 'hero_title', true);
    $hero_title_highlight  = get_post_meta($post->ID, 'hero_title_highlight', true);
    $hero_subtitle         = get_post_meta($post->ID, 'hero_subtitle', true);

    $hero_btn1_text = get_post_meta($post->ID, 'hero_btn1_text', true);
    $hero_btn1_link = get_post_meta($post->ID, 'hero_btn1_link', true);

    $hero_btn2_text = get_post_meta($post->ID, 'hero_btn2_text', true);
    $hero_btn2_link = get_post_meta($post->ID, 'hero_btn2_link', true);

    $hero_image = get_post_meta($post->ID, 'hero_image', true);
    ?>

    <style>
        .hb-field { margin-bottom: 15px; }
        .hb-field label { display: block; font-weight: 600; margin-bottom: 5px; }
        .hb-field input,
        .hb-field textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
        }
        hr { margin: 25px 0; }
    </style>

    <h2>Hero Section</h2>

    <div class="hb-field">
        <label>Hero Badge</label>
        <input type="text" name="hero_badge" value="<?php echo esc_attr($hero_badge); ?>">
    </div>

    <div class="hb-field">
        <label>Hero Title (Main)</label>
        <input type="text" name="hero_title" value="<?php echo esc_attr($hero_title); ?>">
    </div>

    <div class="hb-field">
        <label>Hero Title (Highlighted Text)</label>
        <input type="text" name="hero_title_highlight" value="<?php echo esc_attr($hero_title_highlight); ?>">
    </div>

    <div class="hb-field">
        <label>Hero Subtitle</label>
        <textarea name="hero_subtitle" rows="4"><?php echo esc_textarea($hero_subtitle); ?></textarea>
    </div>

    <hr>

    <h3>Buttons</h3>

    <div class="hb-field">
        <label>Button 1 Text</label>
        <input type="text" name="hero_btn1_text" value="<?php echo esc_attr($hero_btn1_text); ?>">
    </div>

    <div class="hb-field">
        <label>Button 1 Link</label>
        <input type="text" name="hero_btn1_link" value="<?php echo esc_attr($hero_btn1_link); ?>">
    </div>

    <div class="hb-field">
        <label>Button 2 Text</label>
        <input type="text" name="hero_btn2_text" value="<?php echo esc_attr($hero_btn2_text); ?>">
    </div>

    <div class="hb-field">
        <label>Button 2 Link</label>
        <input type="text" name="hero_btn2_link" value="<?php echo esc_attr($hero_btn2_link); ?>">
    </div>

    <hr>

    <h3>Hero Image</h3>

    <div class="hb-field">
        <label>Image URL</label>
        <input type="text" name="hero_image" value="<?php echo esc_attr($hero_image); ?>">
    </div>

<?php
// Get Trust values
$trust_title = get_post_meta($post->ID, 'trust_title', true);
$trust_logos = get_post_meta($post->ID, 'trust_logos', true);
?>

<hr>

<h2>Trust Section</h2>

<div class="hb-field">
    <label>Section Title</label>
    <input type="text" name="trust_title"
        value="<?php echo esc_attr($trust_title); ?>"
        placeholder="Strategic Infrastructure Partners">
</div>

<div class="hb-field">
    <label>Logos (Comma Separated)</label>
    <textarea name="trust_logos" rows="3"
        placeholder="VANGUARD_SEC, FEDERAL_TRUST, GLOBAL_CUSTODY"><?php echo esc_textarea($trust_logos); ?></textarea>
    <small>Enter partner names separated by commas</small>
</div>

<hr>

<h2>Transparency Metrics</h2>

<?php
for ($i = 1; $i <= 3; $i++) :

    $label = get_post_meta($post->ID, "metric{$i}_label", true);
    $value = get_post_meta($post->ID, "metric{$i}_value", true);
    $note  = get_post_meta($post->ID, "metric{$i}_note", true);
    $icon  = get_post_meta($post->ID, "metric{$i}_icon", true);
    $color = get_post_meta($post->ID, "metric{$i}_color", true);
    $type  = get_post_meta($post->ID, "metric{$i}_type", true); // NEW
?>

<h3>Metric <?php echo $i; ?></h3>

<div class="hb-field">
    <label>Label</label>
    <input type="text" name="metric<?php echo $i; ?>_label"
        value="<?php echo esc_attr($label); ?>">
</div>

<div class="hb-field">
    <label>Value</label>
    <input type="text" name="metric<?php echo $i; ?>_value"
        value="<?php echo esc_attr($value); ?>">
</div>

<div class="hb-field">
    <label>Format Type</label>
    <select name="metric<?php echo $i; ?>_type">
        <option value="">Default</option>
        <option value="currency" <?php selected($type, 'currency'); ?>>Currency</option>
        <option value="percent" <?php selected($type, 'percent'); ?>>Percentage</option>
    </select>
</div>

<div class="hb-field">
    <label>Note</label>
    <input type="text" name="metric<?php echo $i; ?>_note"
        value="<?php echo esc_attr($note); ?>">
</div>

<div class="hb-field">
    <label>Icon (Material Symbol)</label>
    <input type="text" name="metric<?php echo $i; ?>_icon"
        value="<?php echo esc_attr($icon); ?>" placeholder="verified">
</div>

<div class="hb-field">
    <label>Color</label>
    <select name="metric<?php echo $i; ?>_color">
        <option value="primary" <?php selected($color, 'primary'); ?>>Primary</option>
        <option value="secondary" <?php selected($color, 'secondary'); ?>>Secondary</option>
        <option value="tertiary-container" <?php selected($color, 'tertiary-container'); ?>>Tertiary</option>
    </select>
</div>

<hr>

<?php endfor; ?>

<?php
} // ✅ CLOSE FUNCTION PROPERLY
