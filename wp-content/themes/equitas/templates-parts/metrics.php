<?php
$post_id = get_option('page_on_front');

/**
 * 🔹 METRIC 1
 */
$m1_label = get_post_meta($post_id, 'metric1_label', true);
$m1_value = get_post_meta($post_id, 'metric1_value', true);
$m1_note  = get_post_meta($post_id, 'metric1_note', true);
$m1_icon  = get_post_meta($post_id, 'metric1_icon', true);
$m1_color = get_post_meta($post_id, 'metric1_color', true);

/**
 * 🔹 METRIC 2
 */
$m2_label = get_post_meta($post_id, 'metric2_label', true);
$m2_value = get_post_meta($post_id, 'metric2_value', true);
$m2_note  = get_post_meta($post_id, 'metric2_note', true);
$m2_icon  = get_post_meta($post_id, 'metric2_icon', true);
$m2_color = get_post_meta($post_id, 'metric2_color', true);

/**
 * 🔹 METRIC 3
 */
$m3_label = get_post_meta($post_id, 'metric3_label', true);
$m3_value = get_post_meta($post_id, 'metric3_value', true);
$m3_note  = get_post_meta($post_id, 'metric3_note', true);
$m3_icon  = get_post_meta($post_id, 'metric3_icon', true);
$m3_color = get_post_meta($post_id, 'metric3_color', true);

/**
 * 🔹 FALLBACKS
 */
$m1_label = $m1_label ?: 'Capital Repaid';
$m1_value = $m1_value ?: '$2.1B+';
$m1_note  = $m1_note  ?: 'On-Chain Verified';
$m1_icon  = $m1_icon  ?: 'verified';
$m1_color = $m1_color ?: 'primary';

$m2_label = $m2_label ?: 'On-time Payout';
$m2_value = $m2_value ?: '98.2%';
$m2_note  = $m2_note  ?: '30-Day Rolling Avg.';
$m2_icon  = $m2_icon  ?: 'schedule';
$m2_color = $m2_color ?: 'secondary';

$m3_label = $m3_label ?: 'Avg. ROI (FY23)';
$m3_value = $m3_value ?: '12.4%';
$m3_note  = $m3_note  ?: 'Pro Tier Performance';
$m3_icon  = $m3_icon  ?: 'workspace_premium';
$m3_color = $m3_color ?: 'tertiary-container';
?>

<section class="py-24 bg-surface">
  <div class="max-w-7xl mx-auto px-6">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

      <!-- Metric 1 -->
      <div class="p-12 bg-surface-container-lowest border-l-4 border-<?php echo esc_attr($m1_color); ?>">
        <p class="text-on-surface-variant font-label text-[10px] uppercase tracking-widest mb-4">
          <?php echo esc_html($m1_label); ?>
        </p>

        <h2 class="text-6xl font-extrabold font-headline text-primary tabular-nums tracking-tighter mb-2">
          <?php echo esc_html($m1_value); ?>
        </h2>

        <div class="flex items-center gap-2 text-<?php echo esc_attr($m1_color); ?>">
          <span class="material-symbols-outlined text-sm">
            <?php echo esc_html($m1_icon); ?>
          </span>
          <span class="text-xs font-bold uppercase tracking-wider">
            <?php echo esc_html($m1_note); ?>
          </span>
        </div>
      </div>

      <!-- Metric 2 -->
      <div class="p-12 bg-surface-container-lowest border-l-4 border-<?php echo esc_attr($m2_color); ?>">
        <p class="text-on-surface-variant font-label text-[10px] uppercase tracking-widest mb-4">
          <?php echo esc_html($m2_label); ?>
        </p>

        <h2 class="text-6xl font-extrabold font-headline text-primary tabular-nums tracking-tighter mb-2">
          <?php echo esc_html($m2_value); ?>
        </h2>

        <div class="flex items-center gap-2 text-<?php echo esc_attr($m2_color); ?>">
          <span class="material-symbols-outlined text-sm">
            <?php echo esc_html($m2_icon); ?>
          </span>
          <span class="text-xs font-bold uppercase tracking-wider">
            <?php echo esc_html($m2_note); ?>
          </span>
        </div>
      </div>

      <!-- Metric 3 -->
      <div class="p-12 bg-surface-container-lowest border-l-4 border-<?php echo esc_attr($m3_color); ?>">
        <p class="text-on-surface-variant font-label text-[10px] uppercase tracking-widest mb-4">
          <?php echo esc_html($m3_label); ?>
        </p>

        <h2 class="text-6xl font-extrabold font-headline text-primary tabular-nums tracking-tighter mb-2">
          <?php echo esc_html($m3_value); ?>
        </h2>

        <div class="flex items-center gap-2 text-<?php echo esc_attr($m3_color); ?>">
          <span class="material-symbols-outlined text-sm">
            <?php echo esc_html($m3_icon); ?>
          </span>
          <span class="text-xs font-bold uppercase tracking-wider">
            <?php echo esc_html($m3_note); ?>
          </span>
        </div>
      </div>

    </div>

  </div>
</section>