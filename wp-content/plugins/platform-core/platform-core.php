<?php
/*
Plugin Name: Platform Core
Description: Core functionality for financial platform
Version: 1.0
*/

if (!defined('ABSPATH')) {
    exit;
}

define('PLATFORM_CORE_PATH', plugin_dir_path(__FILE__));

/* AUTH */
require_once PLATFORM_CORE_PATH . 'includes/auth/login.php';
require_once PLATFORM_CORE_PATH . 'includes/auth/logout.php';
require_once PLATFORM_CORE_PATH . 'includes/auth/registration.php';
require_once PLATFORM_CORE_PATH . 'includes/auth/dashboard-redirect.php';

/* ROLES */
require_once PLATFORM_CORE_PATH . 'includes/roles/role-menu.php';

/* DASHBOARDS */
require_once PLATFORM_CORE_PATH . 'includes/dashboard/investor-dashboard.php';

/* DEALS */
require_once PLATFORM_CORE_PATH . 'includes/deals/deal-cpt.php';
require_once PLATFORM_CORE_PATH . 'includes/deals/deal-submission.php';
require_once PLATFORM_CORE_PATH . 'includes/deals/deal-status.php';
require_once PLATFORM_CORE_PATH . 'includes/deals/deal-approval.php';
require_once PLATFORM_CORE_PATH . 'includes/deals/deal-display.php';
require_once PLATFORM_CORE_PATH . 'includes/deals/available-deals.php';

/* INVESTMENTS */
require_once PLATFORM_CORE_PATH . 'includes/investments/investment-cpt.php';
require_once PLATFORM_CORE_PATH . 'includes/investments/investment-form.php';
require_once PLATFORM_CORE_PATH . 'includes/investments/investment-engine.php';
require_once PLATFORM_CORE_PATH . 'includes/investments/investment-display.php';

/* SETTLEMENT */
require_once PLATFORM_CORE_PATH . 'includes/settlement/settlement-dashboard.php';
require_once PLATFORM_CORE_PATH . 'includes/settlement/payout-processor.php';

/* UTILITIES */
require_once PLATFORM_CORE_PATH . 'includes/utils/security-lock.php';

require_once plugin_dir_path(__FILE__) . 'includes/dashboard/dashboard-shortcode.php';