<aside class="h-screen w-64 fixed left-0 top-0 bg-slate-100 dark:bg-slate-900/50 flex flex-col py-6 z-50">

    <div class="px-6 mb-8">
        <h1 class="text-lg font-black uppercase">Vault Terminal</h1>
    </div>

    <nav class="flex-1 px-4 space-y-1">

        <a href="#" class="dashboard-link active">Dashboard</a>
        <a href="#" class="dashboard-link">Active Deals</a>
        <a href="#" class="dashboard-link">Sponsorships</a>
        <a href="#" class="dashboard-link">Settlements</a>
        <a href="#" class="dashboard-link">Risk Reports</a>
        <a href="#" class="dashboard-link">Settings</a>

    </nav>

    <div class="mt-auto px-4 pt-6 border-t">
        <a href="<?php echo wp_logout_url(); ?>" class="dashboard-link text-red-500">
            Sign Out
        </a>
    </div>

</aside>