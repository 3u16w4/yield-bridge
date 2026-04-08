<?php
$current_user = wp_get_current_user();
?>

<header class="flex justify-between items-end mb-12">

    <div>
        <p class="text-xs uppercase tracking-widest text-gray-500">
            Vault Management Console
        </p>
        <h2 class="text-4xl font-extrabold text-primary">
            Sponsor Dashboard
        </h2>
    </div>

    <div class="flex items-center gap-4">

        <div class="text-right">
            <p class="text-xs text-gray-500">System Status</p>
            <p class="text-green-600 font-bold">Operational</p>
        </div>

        <div class="flex items-center gap-2 bg-gray-100 p-2 rounded-full">
            <img class="w-8 h-8 rounded-full"
                 src="<?php echo get_avatar_url($current_user->ID); ?>">
            <span class="text-sm font-bold">
                <?php echo $current_user->display_name; ?>
            </span>
        </div>

    </div>

</header>