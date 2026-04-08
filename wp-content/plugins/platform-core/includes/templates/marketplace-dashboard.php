<?php

$args = array(
    'post_type' => 'deal',
    'post_status' => 'publish',
    'posts_per_page' => -1
);

$deals = new WP_Query($args);

?>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Manrope:wght@500;700;800&amp;display=swap" rel="stylesheet"/>
<!-- Material Symbols -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "tertiary-fixed": "#ffdea5",
              "surface-container-highest": "#e1e3e4",
              "error": "#ba1a1a",
              "on-error": "#ffffff",
              "primary-fixed-dim": "#adc8f2",
              "on-primary-fixed": "#001c38",
              "on-secondary-fixed": "#002110",
              "secondary-fixed": "#9df5bd",
              "surface-container-low": "#f3f4f5",
              "on-primary-fixed-variant": "#2c486b",
              "on-tertiary-fixed": "#261900",
              "on-primary-container": "#708bb2",
              "on-secondary": "#ffffff",
              "on-tertiary-fixed-variant": "#5d4201",
              "error-container": "#ffdad6",
              "surface-container": "#edeeef",
              "background": "#f8f9fa",
              "surface-container-lowest": "#ffffff",
              "primary-fixed": "#d3e3ff",
              "inverse-on-surface": "#f0f1f2",
              "surface": "#f8f9fa",
              "tertiary-fixed-dim": "#e9c176",
              "tertiary": "#130b00",
              "surface-tint": "#456084",
              "surface-variant": "#e1e3e4",
              "inverse-surface": "#2e3132",
              "outline": "#74777f",
              "surface-bright": "#f8f9fa",
              "on-error-container": "#93000a",
              "primary": "#000c1e",
              "on-tertiary": "#ffffff",
              "surface-dim": "#d9dadb",
              "secondary-fixed-dim": "#81d9a2",
              "on-secondary-container": "#0e7144",
              "on-background": "#191c1d",
              "on-surface-variant": "#43474e",
              "on-tertiary-container": "#a78541",
              "primary-container": "#002344",
              "secondary-container": "#9af2ba",
              "on-primary": "#ffffff",
              "inverse-primary": "#adc8f2",
              "on-secondary-fixed-variant": "#00522f",
              "tertiary-container": "#2f2000",
              "outline-variant": "#c3c6cf",
              "on-surface": "#191c1d",
              "surface-container-high": "#e7e8e9",
              "secondary": "#046d40"
            },
            fontFamily: {
              "headline": ["Manrope", "sans-serif"],
              "body": ["Inter", "sans-serif"],
              "label": ["Inter", "sans-serif"]
            },
            borderRadius: {"DEFAULT": "0.125rem", "lg": "0.25rem", "xl": "0.5rem", "full": "0.75rem"},
          },
        },
      }
    </script>
<style>
      .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
      }
      .pro-gradient-border {
        border: 1px solid transparent;
        background: linear-gradient(#ffffff, #ffffff) padding-box,
                    linear-gradient(135deg, #e9c176, #2f2000) border-box;
      }
      .premium-glass {
        background: rgba(248, 249, 250, 0.8);
        backdrop-filter: blur(24px);
      }
      ::-webkit-scrollbar { width: 6px; }
      ::-webkit-scrollbar-track { background: #f3f4f5; }
      ::-webkit-scrollbar-thumb { background: #000c1e; border-radius: 10px; }
    </style>
<div class="flex">

<!-- SIDEBAR -->
<aside class="h-screen w-64 fixed left-0 top-0 pt-24 pb-6 bg-slate-100 flex flex-col z-40">
<div class="px-6 mb-8">
<div class="flex items-center gap-3">
<div class="w-8 h-8 bg-primary flex items-center justify-center rounded-lg">
<span class="material-symbols-outlined text-white text-sm" style="font-variation-settings: 'FILL' 1;">terminal</span>
</div>
<div>
<h2 class="text-sm font-black uppercase tracking-tighter text-slate-900">Vault Terminal</h2>
<p class="text-[10px] text-slate-500 font-medium uppercase tracking-widest leading-none">Institutional Grade</p>
</div>
</div>
</div>
<nav class="flex-1 space-y-1 overflow-y-auto px-2">
<a class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:bg-slate-200/50 rounded-lg transition-transform duration-200 hover:translate-x-1 group" href="#">
<span class="material-symbols-outlined text-lg">dashboard</span>
<span class="text-sm font-medium">Dashboard</span>
</a>
<a class="flex items-center gap-3 px-4 py-2.5 bg-white text-slate-900 shadow-sm rounded-lg transition-transform duration-200 hover:translate-x-1" href="#">
<span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">analytics</span>
<span class="text-sm font-bold">Active Deals</span>
</a>
<a class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:bg-slate-200/50 rounded-lg transition-transform duration-200 hover:translate-x-1 group" href="#">
<span class="material-symbols-outlined text-lg">handshake</span>
<span class="text-sm font-medium">Sponsorships</span>
</a>
<a class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:bg-slate-200/50 rounded-lg transition-transform duration-200 hover:translate-x-1 group" href="#">
<span class="material-symbols-outlined text-lg">payments</span>
<span class="text-sm font-medium">Settlements</span>
</a>
<a class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:bg-slate-200/50 rounded-lg transition-transform duration-200 hover:translate-x-1 group" href="#">
<span class="material-symbols-outlined text-lg">security</span>
<span class="text-sm font-medium">Risk Reports</span>
</a>
<a class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:bg-slate-200/50 rounded-lg transition-transform duration-200 hover:translate-x-1 group" href="#">
<span class="material-symbols-outlined text-lg">settings</span>
<span class="text-sm font-medium">Settings</span>
</a>
</nav>
<div class="mt-auto px-4 pt-4 space-y-1">
<button class="w-full flex items-center justify-between px-4 py-2 text-xs font-bold bg-slate-900 text-white rounded-lg mb-4 active:scale-95 transition-all">
<span>Switch Role</span>
<span class="material-symbols-outlined text-sm">swap_horiz</span>
</button>
<a class="flex items-center gap-3 px-4 py-2 text-slate-500 hover:bg-slate-200/50 rounded-lg transition-transform duration-200 hover:translate-x-1" href="#">
<span class="material-symbols-outlined text-lg">contact_support</span>
<span class="text-sm font-medium">Support</span>
</a>
<a class="flex items-center gap-3 px-4 py-2 text-error hover:bg-error-container/20 rounded-lg transition-transform duration-200 hover:translate-x-1" href="#">
<span class="material-symbols-outlined text-lg">logout</span>
<span class="text-sm font-medium">Sign Out</span>
</a>
</div>
</aside>
<!-- Main Content Stage -->
<main class="ml-64 w-full min-h-screen bg-surface p-12">
<header class="mb-12 flex justify-between items-end">
<div class="max-w-2xl">
<div class="flex items-center gap-3 mb-4">
<span class="label-md uppercase tracking-wider text-on-surface-variant font-medium">Asset Exchange</span>
<div class="h-px w-12 bg-outline-variant"></div>
</div>
<h1 class="font-headline text-5xl font-extrabold text-primary tracking-tight leading-tight">Institutional Marketplace</h1>
<p class="mt-4 text-on-surface-variant text-lg">Direct access to private equity, real estate syndications, and high-yield agricultural bonds.</p>
</div>
<div class="flex gap-4">
<div class="bg-surface-container-low p-1 rounded-lg flex">
<button class="px-6 py-2 bg-surface-container-lowest text-primary font-bold text-sm rounded shadow-sm">Grid View</button>
<button class="px-6 py-2 text-on-surface-variant font-medium text-sm">List View</button>
</div>
</div>
</header>
<!-- Filters Section -->
<section class="mb-12 flex flex-wrap gap-4 items-center bg-surface-container-low p-6 rounded-xl">
<div class="flex flex-col gap-1">
<span class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant ml-1">Asset Sector</span>
<div class="relative group">
<select class="appearance-none bg-surface-container-lowest border-none py-2.5 pl-4 pr-10 rounded-lg text-sm font-semibold text-primary focus:ring-2 focus:ring-primary w-48 shadow-sm">
<option>All Sectors</option>
<option>Real Estate</option>
<option>Agriculture</option>
<option>Logistics</option>
<option>Technology</option>
</select>
<span class="material-symbols-outlined absolute right-3 top-2.5 text-slate-400 pointer-events-none">expand_more</span>
</div>
</div>
<div class="flex flex-col gap-1">
<span class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant ml-1">Risk Grade</span>
<div class="relative group">
<select class="appearance-none bg-surface-container-lowest border-none py-2.5 pl-4 pr-10 rounded-lg text-sm font-semibold text-primary focus:ring-2 focus:ring-primary w-40 shadow-sm">
<option>All Grades</option>
<option>Grade A+</option>
<option>Grade A</option>
<option>Grade B</option>
</select>
<span class="material-symbols-outlined absolute right-3 top-2.5 text-slate-400 pointer-events-none">expand_more</span>
</div>
</div>
<div class="flex flex-col gap-1">
<span class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant ml-1">Min. Entry</span>
<div class="relative group">
<select class="appearance-none bg-surface-container-lowest border-none py-2.5 pl-4 pr-10 rounded-lg text-sm font-semibold text-primary focus:ring-2 focus:ring-primary w-40 shadow-sm">
<option>$10,000</option>
<option>$50,000</option>
<option>$100,000+</option>
</select>
<span class="material-symbols-outlined absolute right-3 top-2.5 text-slate-400 pointer-events-none">expand_more</span>
</div>
</div>
<button class="ml-auto mt-5 px-8 py-3 bg-primary text-white font-bold rounded-lg hover:opacity-90 transition-all flex items-center gap-2">
<span class="material-symbols-outlined text-sm">filter_alt</span>
                    Apply Filters
                </button>
</section>

<!-- Open Tier Deals -->
<section class="mb-20">
<div class="flex items-center justify-between mb-8">
<h3 class="font-headline text-2xl font-bold text-primary flex items-center gap-3">
<span class="w-2 h-8 bg-secondary rounded-full"></span>
                        Open Tier Opportunities
                    </h3>
</div>
<!-- DEAL GRID -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

<?php if ($deals->have_posts()) : while ($deals->have_posts()) : $deals->the_post();

$deal_id = get_the_ID();

$roi = floatval(get_post_meta($deal_id,'roi_percentage',true));
$sector = get_post_meta($deal_id,'sector',true);

$capital_required = floatval(get_post_meta($deal_id,'capital_required',true));
$capital_raised = floatval(get_post_meta($deal_id,'capital_raised',true));

$minimum = floatval(get_post_meta($deal_id,'minimum_investment',true));

$funding_end = get_post_meta($deal_id,'funding_end_date',true);

$progress = ($capital_required > 0)
    ? min(100, ($capital_raised/$capital_required)*100)
    : 0;

$today = current_time('Y-m-d');
$is_closed = ($funding_end && strtotime($today) > strtotime($funding_end));

?>

<div class="bg-white rounded-xl p-6 shadow hover:-translate-y-1 transition">
   <!-- IMAGE -->
    <div class="h-40 bg-gray-200 rounded mb-4"></div>

    <!-- HEADER -->
    <div class="flex justify-between mb-2">
        <span class="text-xs uppercase text-gray-500"><?php echo esc_html($sector); ?></span>
        <span class="text-green-600 font-bold text-sm">+<?php echo esc_html($roi); ?>%</span>
    </div>

    <!-- TITLE -->
    <h3 class="text-lg font-bold mb-4">
        <?php the_title(); ?>
    </h3>

    <!-- PROGRESS -->
    <div class="mb-4">
        <div class="flex justify-between text-xs mb-1">
            <span>Funding</span>
            <span><?php echo round($progress); ?>%</span>
        </div>

        <div class="w-full bg-gray-200 h-2 rounded">
            <div class="bg-blue-600 h-2 rounded"
                 style="width: <?php echo esc_attr($progress); ?>%">
            </div>
        </div>
    </div>
    
    <!--card-flag-->
    <div class="absolute top-3 right-3 bg-surface-container-lowest/90 backdrop-blur px-3 py-1 rounded text-[10px] font-extrabold text-primary uppercase tracking-widest">
                                Grade A
                            </div>
    <!-- MIN INVEST -->
    <div class="flex justify-between items-center pt-4 border-t">

        <div>
            <p class="text-xs text-gray-500">Minimum</p>
            <p class="font-bold">₦<?php echo number_format($minimum); ?></p>
        </div>

        <!-- BUTTON -->
        <button 
            class="px-4 py-2 rounded-lg text-sm font-bold text-white
            <?php echo $is_closed ? 'bg-gray-400 cursor-not-allowed' : 'bg-blue-600 hover:opacity-90'; ?>"
            <?php echo $is_closed ? 'disabled' : ''; ?>
        >
            <?php echo $is_closed ? 'Closed' : 'Invest'; ?>
        </button>

    </div>
</div>

<?php endwhile; wp_reset_postdata(); endif; ?>

</div>
</section>

<!-- Pro Tier Locked Section -->
<section class="relative">
<div class="flex items-center justify-between mb-8">
<h3 class="font-headline text-2xl font-bold text-primary flex items-center gap-3">
<span class="w-2 h-8 bg-tertiary-fixed-dim rounded-full"></span>
                        Institutional Pro Tier
                    </h3>
<div class="pro-gradient-border px-3 py-1 rounded-full">
<span class="text-[10px] font-bold uppercase tracking-widest text-on-tertiary-fixed-variant">Qualified Investors Only</span>
</div>
</div>
<!-- Blurred Grid Background -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-8 pointer-events-none select-none">
<div class="bg-surface-container-lowest/40 blur-md rounded-xl p-6">
<div class="h-48 w-full bg-surface-container-highest rounded-lg mb-6"></div>
<div class="h-6 w-3/4 bg-surface-container-highest rounded mb-4"></div>
<div class="h-4 w-1/2 bg-surface-container-highest rounded"></div>
</div>
<div class="bg-surface-container-lowest/40 blur-md rounded-xl p-6">
<div class="h-48 w-full bg-surface-container-highest rounded-lg mb-6"></div>
<div class="h-6 w-3/4 bg-surface-container-highest rounded mb-4"></div>
<div class="h-4 w-1/2 bg-surface-container-highest rounded"></div>
</div>
</div>
<!-- Overlay CTA -->
<div class="absolute inset-0 flex items-center justify-center z-10">
<div class="bg-white/90 backdrop-blur-xl p-10 rounded-2xl shadow-2xl max-w-lg text-center border border-tertiary-fixed">
<div class="w-16 h-16 bg-tertiary-fixed text-on-tertiary-fixed rounded-full flex items-center justify-center mx-auto mb-6">
<span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">lock</span>
</div>
<h4 class="font-headline text-2xl font-extrabold text-primary mb-3">Unlock Premium Dealflow</h4>
<p class="text-on-surface-variant mb-8 font-medium">Access private equity opportunities with 18%+ target returns and direct GP co-investment rights.</p>
<div class="space-y-4">
<button class="w-full py-4 bg-primary text-white font-bold rounded-lg shadow-lg hover:translate-y-[-2px] transition-all">
                                Subscribe to Pro Terminal
                            </button>
<p class="text-[10px] text-on-surface-variant font-bold uppercase tracking-widest">Pricing starts at $2,400 / Year Billed Annually</p>
</div>
<div class="mt-8 pt-8 border-t border-surface-container grid grid-cols-3 gap-4">
<div>
<p class="text-xl font-bold text-primary">12+</p>
<p class="text-[8px] font-bold uppercase tracking-widest text-on-surface-variant">Active Pro Deals</p>
</div>
<div>
<p class="text-xl font-bold text-primary">24/7</p>
<p class="text-[8px] font-bold uppercase tracking-widest text-on-surface-variant">Analyst Support</p>
</div>
<div>
<p class="text-xl font-bold text-primary">$2B+</p>
<p class="text-[8px] font-bold uppercase tracking-widest text-on-surface-variant">Under Mgmt</p>
</div>
</div>
</div>
</div>
</section>
<!-- Bottom CTA Section -->
<section class="mt-24 p-12 bg-primary rounded-2xl relative overflow-hidden">
<div class="absolute top-0 right-0 w-1/2 h-full opacity-10">
<svg class="h-full w-full" viewbox="0 0 100 100">
<circle cx="80" cy="20" fill="white" fill-opacity="0.2" r="40"></circle>
<circle cx="90" cy="50" fill="white" fill-opacity="0.1" r="20"></circle>
</svg>
</div>
<div class="relative z-10 max-w-2xl">
<h2 class="font-headline text-4xl font-extrabold text-white mb-6">Level Up Your Institutional Strategy</h2>
<p class="text-on-primary-container text-lg mb-8 leading-relaxed">Join 4,500+ accredited investors receiving weekly curated insights and early access to the world's most exclusive asset classes.</p>
<div class="flex gap-4">
<button class="px-8 py-4 bg-secondary text-white font-bold rounded-lg flex items-center gap-2 hover:opacity-90 active:scale-95 transition-all">
                            Start Free Trial
                            <span class="material-symbols-outlined">arrow_forward</span>
</button>
<button class="px-8 py-4 border border-on-primary-container text-white font-bold rounded-lg hover:bg-white/5 transition-all">
                            Contact Specialist
                        </button>
</div>
</div>
</section>
</main>
</div>