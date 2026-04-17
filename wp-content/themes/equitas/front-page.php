
<?php get_header(); ?>

<main class="flex-grow pt-20">

  <?php get_template_part('templates-parts/hero'); ?>
  <?php get_template_part('templates-parts/trust'); ?>
  <?php get_template_part('templates-parts/metrics'); ?>

  <!-- Editable Content Block test git-->
  <section class="py-20">
    <div class="max-w-4xl mx-auto px-6">
      <?php
        if (have_posts()) :
          while (have_posts()) : the_post();
            the_content();
          endwhile;
        endif;
      ?>
    </div>
  </section>

  <?php get_template_part('templates-parts/platform'); ?>
  <?php get_template_part('templates-parts/cta'); ?>

</main>

<?php get_footer(); ?>