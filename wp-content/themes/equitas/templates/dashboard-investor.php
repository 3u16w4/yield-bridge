<?php
/*
Template Name: Investor Dashboard
*/

if (!is_user_logged_in()) {
    wp_redirect(wp_login_url());
    exit;
}

get_header();
?>

<div class="flex">

<?php get_template_part('template-parts/sidebar', 'investor'); ?>

<main class="ml-64 p-8 w-full">

<?php
$user_id = get_current_user_id();
$data = equitas_get_investor_metrics($user_id);
?>

<!-- HERO METRICS -->
<section class="mb-12">

<h2 class="text-5xl font-extrabold text-primary">
    $<?php echo number_format($data['aum'] ?? 0); ?>
</h2>

<div class="flex gap-10 mt-6">

<div>
<p>Expected ROI</p>
<p class="text-2xl font-bold">
    <?php echo $data['roi'] ?? '0%'; ?>
</p>
</div>

<div>
<p>Pending Payout</p>
<p class="text-2xl text-secondary">
    $<?php echo number_format($data['pending'] ?? 0); ?>
</p>
</div>

</div>

</section>

<!-- TABLE -->
<?php get_template_part('template-parts/dashboard/investor', 'table'); ?>

</main>

</div>

<?php get_footer(); ?>