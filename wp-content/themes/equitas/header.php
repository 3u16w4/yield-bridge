<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php bloginfo('name'); ?> | <?php bloginfo('description'); ?></title>

<?php wp_head(); ?>
</head>

<body <?php body_class('bg-surface text-on-surface font-body antialiased min-h-screen flex flex-col'); ?>>

<header class="fixed top-0 w-full z-50 bg-slate-50/80 backdrop-blur-xl">

<nav class="flex justify-between items-center max-w-7xl mx-auto px-6 h-20">

    <!-- LOGO -->
    <div class="text-xl font-bold tracking-tighter text-slate-900 font-headline">
        <?php bloginfo('name'); ?>
    </div>

    <!-- DESKTOP MENU -->
    <div class="hidden md:flex items-center gap-8">

        <?php
        wp_nav_menu([
            'theme_location' => 'primary',
            'container' => false,
            'menu_class' => 'flex gap-8 items-center',
            'fallback_cb' => false,
            'link_before' => '<span class="font-headline tracking-tight text-slate-500 hover:text-slate-900 transition">',
            'link_after' => '</span>',
        ]);
        ?>

    </div>

    <!-- RIGHT SIDE -->
    <div class="flex items-center gap-4">

        <?php if (!is_user_logged_in()): ?>
            <a href="<?php echo wp_login_url(); ?>" class="hidden md:block text-slate-900 font-semibold px-4 py-2">
                Login
            </a>
        <?php else: ?>
            <a href="<?php echo site_url('/investor-dashboard'); ?>" class="hidden md:block text-slate-900 font-semibold px-4 py-2">
                Dashboard
            </a>
        <?php endif; ?>

        <a href="#" class="hidden md:inline-block bg-primary text-on-primary px-6 py-2.5 rounded-lg font-bold">
            Get Started
        </a>

        <!-- MOBILE MENU BUTTON -->
        <button id="menuToggle" class="md:hidden">
            <span class="material-symbols-outlined text-3xl">menu</span>
        </button>

    </div>

</nav>

<!-- MOBILE MENU PANEL -->
<div id="mobileMenu" class="fixed top-0 left-0 w-full h-full bg-white z-50 transform -translate-x-full transition-transform duration-300">

    <div class="p-6 flex justify-between items-center border-b">
        <h2 class="font-bold text-lg"><?php bloginfo('name'); ?></h2>

        <button id="menuClose">
            <span class="material-symbols-outlined text-3xl">close</span>
        </button>
    </div>

    <div class="p-6 flex flex-col gap-6">

        <?php
        wp_nav_menu([
            'theme_location' => 'primary',
            'container' => false,
            'menu_class' => 'flex flex-col gap-6 text-lg',
        ]);
        ?>

        <hr>

        <?php if (!is_user_logged_in()): ?>
            <a href="<?php echo wp_login_url(); ?>" class="text-lg font-semibold">Login</a>
        <?php else: ?>
            <a href="<?php echo site_url('/investor-dashboard'); ?>" class="text-lg font-semibold">Dashboard</a>
        <?php endif; ?>

        <a href="#" class="bg-primary text-white px-6 py-3 rounded-lg text-center font-bold">
            Get Started
        </a>

    </div>

</div>

</header>