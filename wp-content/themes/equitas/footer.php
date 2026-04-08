<!-- Footer -->
<footer class="bg-slate-100 py-12 mt-auto">
  <div class="flex flex-col md:flex-row justify-between items-center max-w-7xl mx-auto px-8 gap-8">

    <!-- LEFT -->
    <div class="flex flex-col gap-4 text-center md:text-left">
      <div class="text-lg font-black text-slate-900 font-headline">
        <?php bloginfo('name'); ?>
      </div>

      <p class="text-sm uppercase tracking-widest text-slate-500 max-w-xs leading-loose">
        © <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
      </p>
    </div>

    <!-- RIGHT (DYNAMIC MENU) -->
    <div class="flex flex-wrap justify-center gap-8">

      <?php
      wp_nav_menu([
          'theme_location' => 'footer',
          'container' => false,
          'menu_class' => 'flex flex-wrap justify-center gap-8',
          'fallback_cb' => false,
          'link_before' => '<span class="text-sm uppercase tracking-widest text-slate-500 hover:text-emerald-600 transition-colors">',
          'link_after'  => '</span>',
      ]);
      ?>

    </div>

  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>