<<?php
$post_id = get_option('page_on_front');

// 🔹 Hero Fields
$hero_badge           = get_post_meta($post_id, 'hero_badge', true);
$hero_title      = get_post_meta($post_id, 'hero_title_main', true);
$hero_title_highlight = get_post_meta($post_id, 'hero_title_highlight', true);
$hero_subtitle        = get_post_meta($post_id, 'hero_subtitle', true);

// 🔹 Buttons
$hero_btn1_text = get_post_meta($post_id, 'hero_btn1_text', true);
$hero_btn1_link = get_post_meta($post_id, 'hero_btn1_link', true);

$hero_btn2_text = get_post_meta($post_id, 'hero_btn2_text', true);
$hero_btn2_link = get_post_meta($post_id, 'hero_btn2_link', true);

// 🔹 Image
$hero_image = get_post_meta($post_id, 'hero_image', true);
?>

<section class="relative overflow-hidden bg-surface py-24 lg:py-32">
  
  <div class="max-w-7xl mx-auto px-6 relative z-10">
    <div class="max-w-3xl">

      <!-- Badge -->
      <span class="inline-block px-3 py-1 bg-surface-container-high text-on-surface-variant text-[10px] uppercase tracking-[0.2em] mb-6 font-bold">
        <?php echo esc_html($hero_badge ?: 'Institutional Clarity'); ?>
      </span>

      <!-- Title -->
      <h1 class="text-6xl lg:text-8xl font-extrabold font-headline text-primary leading-[1.05] tracking-tighter mb-8">
        <?php echo esc_html($hero_title ?: 'Institutional Grade Capital.'); ?>
        <span class="text-on-primary-container">
          <?php echo esc_html($hero_title_highlight ?: 'Automated Efficiency.'); ?>
        </span>
      </h1>

      <!-- Subtitle -->
      <p class="text-xl text-on-surface-variant leading-relaxed mb-10 max-w-2xl">
        <?php echo esc_html($hero_subtitle ?: 'Default subtitle'); ?>
      </p>

      <!-- Buttons -->
      <div class="flex flex-wrap gap-4">
        
        <?php if (!empty($hero_btn1_text)) : ?>
          <a href="<?php echo esc_url($hero_btn1_link ?: '#'); ?>"
             class="bg-primary text-on-primary px-8 py-4 rounded-lg font-bold text-lg flex items-center gap-2 hover:scale-[0.98] transition-transform">
            <?php echo esc_html($hero_btn1_text); ?>
            <span class="material-symbols-outlined">trending_flat</span>
          </a>
        <?php endif; ?>

        <?php if (!empty($hero_btn2_text)) : ?>
          <a href="<?php echo esc_url($hero_btn2_link ?: '#'); ?>"
             class="bg-surface-container-highest text-primary px-8 py-4 rounded-lg font-bold text-lg hover:bg-surface-container-high transition-colors">
            <?php echo esc_html($hero_btn2_text); ?>
          </a>
        <?php endif; ?>

      </div>

    </div>
  </div>

  <!-- Hero Image -->
  <?php if (!empty($hero_image)) : ?>
    <div class="absolute right-[-10%] top-20 w-1/2 h-full opacity-20 lg:opacity-100">
      <div class="relative w-full h-[600px] bg-surface-container-low rounded-tl-[100px] overflow-hidden">
        <img src="<?php echo esc_url($hero_image); ?>"
             alt="Modern architecture glass and steel"
             class="w-full h-full object-cover grayscale mix-blend-multiply">
      </div>
    </div>
  <?php endif; ?>

</section>