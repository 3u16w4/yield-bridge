<?php
/* Template Name: Sponsor Dashboard */

if (!is_user_logged_in()) {
    wp_redirect(wp_login_url());
    exit;
}

get_header();
?>

<div class="dashboard-wrapper flex">

    <?php get_template_part('templates-parts/dashboard/sidebar'); ?>

    <main class="ml-64 p-8 min-h-screen bg-surface w-full">

        <?php get_template_part('templates-parts/dashboard/header'); ?>

        <?php get_template_part('templates-parts/dashboard/sponsor-metrics'); ?>

        <div class="grid grid-cols-12 gap-8 mt-8">
            <div class="col-span-12 lg:col-span-8">
                <?php get_template_part('templates-parts/dashboard/deals-table'); ?>
            </div>

            <div class="col-span-12 lg:col-span-4">
                <?php get_template_part('templates-parts/dashboard/settlement'); ?>
            </div>
        </div>

        <?php get_template_part('templates-parts/dashboard/footer'); ?>

    </main>
</div>

<?php get_footer(); ?>