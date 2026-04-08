<?php get_header(); ?>

<main class="flex-grow pt-20">

  <div class="max-w-4xl mx-auto px-6 py-16">

    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
    ?>

        <h1 class="text-4xl font-bold font-headline mb-6">
            <?php the_title(); ?>
        </h1>

        <div class="prose max-w-none">
            <?php the_content(); ?>
        </div>

    <?php
        endwhile;
    endif;
    ?>

  </div>

</main>

<?php get_footer(); ?>