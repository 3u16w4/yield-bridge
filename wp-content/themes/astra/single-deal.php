<?php
get_header();

if (have_posts()) :
    while (have_posts()) : the_post(); ?>

        <div class="deal-single-wrapper">
            <h1><?php the_title(); ?></h1>

            <p><strong>Status:</strong> <?php echo esc_html(get_post_status()); ?></p>

            <h3>Deal Overview</h3>
            <div>
                <?php the_content(); ?>
                <br/>
            </div>
        </div>

    <?php endwhile;
endif;

get_footer();