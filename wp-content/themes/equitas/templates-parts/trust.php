<?php
$post_id = get_option('page_on_front');

// 🔹 Section Title
$trust_title = get_post_meta($post_id, 'trust_title', true);

// 🔹 Raw logos string
$trust_logos_raw = get_post_meta($post_id, 'trust_logos', true);

// 🔹 Convert to array safely
$trust_logos = [];

if (!empty($trust_logos_raw)) {
    $trust_logos = array_filter(
        array_map('trim', explode(',', $trust_logos_raw))
    );
}

// 🔹 Fallback (default logos)
if (empty($trust_logos)) {
    $trust_logos = [
        'VANGUARD_SEC',
        'FEDERAL_TRUST',
        'GLOBAL_CUSTODY',
        'PAYSTACK_SYS',
        'CREDIT_VALVE'
    ];
}
?>

<section class="bg-surface-container-low py-12">
  <div class="max-w-7xl mx-auto px-6">

    <!-- Title -->
    <p class="text-center text-on-surface-variant font-label text-[10px] uppercase tracking-widest mb-8 opacity-60">
      <?php echo esc_html(!empty($trust_title) ? $trust_title : 'Strategic Infrastructure Partners'); ?>
    </p>

    <!-- Logos -->
    <div class="flex flex-wrap justify-center items-center gap-12 lg:gap-24 opacity-40 grayscale">

      <?php foreach ($trust_logos as $logo): ?>

        <?php if (!empty($logo)) : ?>
          <div class="h-8 font-headline font-black text-2xl">
            <?php echo esc_html($logo); ?>
          </div>
        <?php endif; ?>

      <?php endforeach; ?>

    </div>

  </div>
</section>