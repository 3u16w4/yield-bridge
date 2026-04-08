<?php

function platform_my_investments_shortcode() {

    // Access control
    if (!current_user_can('inv1') && !current_user_can('inv2')) {
        return "<p>Access denied.</p>";
    }

    $user_id = get_current_user_id();

    $investments = get_posts(array(
        'post_type'   => 'investment',
        'post_status' => 'publish',
        'author'      => $user_id,
        'numberposts' => -1
    ));

    if (!$investments) {
        return "<p>You have not made any investments yet.</p>";
    }

    // Aggregate investments per deal
    $portfolio = array();

    foreach ($investments as $investment) {

        $deal_id = get_post_meta($investment->ID, 'deal_id', true);
        $amount  = floatval(get_post_meta($investment->ID, 'amount', true));

        if (!$deal_id) continue;

        if (!isset($portfolio[$deal_id])) {
            $portfolio[$deal_id] = 0;
        }

        $portfolio[$deal_id] += $amount;
    }

    ob_start();

    $grand_total = 0;
    $grand_expected = 0;
    ?>

    <div class="fintech-page">

        <!-- HEADER -->
        <div class="fintech-hero">
            <h1>My Investment Portfolio</h1>
            <p>Track your investments, returns and maturity timelines</p>
        </div>

        <!-- SUMMARY -->
        <div class="portfolio-summary">

            <div class="summary-card">
                <h4>Total Invested</h4>
                <p id="totalInvested">₦0</p>
            </div>

            <div class="summary-card">
                <h4>Expected Returns</h4>
                <p id="expectedReturns">₦0</p>
            </div>

            <div class="summary-card">
                <h4>Active Deals</h4>
                <p><?php echo count($portfolio); ?></p>
            </div>

        </div>

        <!-- DEALS -->
        <div class="deals-grid">

        <?php foreach ($portfolio as $deal_id => $total_invested) :

            $deal = get_post($deal_id);
            if (!$deal) continue;

            $deal_link = get_permalink($deal_id);

            $roi       = floatval(get_post_meta($deal_id, 'roi_percentage', true));
            $status    = get_post_meta($deal_id, 'deal_status', true);
            $status    = $status ? strtolower($status) : 'open';

            $duration  = get_post_meta($deal_id, 'duration_months', true);
            $settlement_date = get_post_meta($deal_id, 'settlement_date', true);

            // Calculations
            $expected_return = $total_invested * (1 + ($roi / 100));

            $grand_total += $total_invested;
            $grand_expected += $expected_return;

            // Safe defaults
            $today = current_time('Y-m-d');
            $maturity_status = '';
            $maturity_class = 'inactive';

            if ($settlement_date) {

                $date_diff = (strtotime($settlement_date) - strtotime($today)) / 86400;
                $days_remaining = intval($date_diff);

                if ($days_remaining > 0) {
                    $maturity_status = $days_remaining . ' days remaining';
                    $maturity_class = 'active';
                } else {
                    $maturity_status = 'Matured';
                    $maturity_class = 'matured';
                }
            }

            // SAFE progress calculation
            $progress_width = 0;

            if ($total_invested > 0) {
                $progress_width = ($expected_return / $total_invested) * 50;
                if ($progress_width > 100) {
                    $progress_width = 100;
                }
            }

        ?>

        <div class="deal-card investment-card">

            <!-- HEADER -->
            <div class="deal-header">
                <h3>
                    <a href="<?php echo esc_url($deal_link); ?>">
                        <?php echo esc_html($deal->post_title); ?>
                    </a>
                </h3>

                <span class="badge <?php echo esc_attr($status); ?>">
                    <?php echo esc_html(ucfirst($status)); ?>
                </span>
            </div>

            <!-- META -->
            <div class="deal-meta">

                <div>
                    <strong>Invested</strong><br>
                    ₦<?php echo number_format($total_invested, 2); ?>
                </div>

                <div>
                    <strong>Expected</strong><br>
                    ₦<?php echo number_format($expected_return, 2); ?>
                </div>

                <div>
                    <strong>ROI</strong><br>
                    <?php echo esc_html($roi); ?>%
                </div>

                <div>
                    <strong>Duration</strong><br>
                    <?php echo esc_html($duration); ?> mo
                </div>

            </div>

            <!-- PROGRESS -->
            <div class="investment-progress">

                <div class="progress-bar">
                    <div class="progress-fill"
                         style="width: <?php echo esc_attr($progress_width); ?>%;">
                    </div>
                </div>

                <div class="progress-text">
                    Return Growth Projection
                </div>

            </div>

            <!-- FOOTER -->
            <div class="investment-footer">

                <div>
                    <?php if ($settlement_date) : ?>
                        <p><strong>Settlement:</strong> <?php echo esc_html($settlement_date); ?></p>
                    <?php endif; ?>
                </div>

                <span class="maturity <?php echo esc_attr($maturity_class); ?>">
                    <?php echo esc_html($maturity_status); ?>
                </span>

            </div>

        </div>

        <?php endforeach; ?>

        </div>

        <!-- TOTALS -->
        <div class="portfolio-total">

            <h3>Total Invested: ₦<?php echo number_format($grand_total, 2); ?></h3>

            <h3>Total Expected Value: ₦<?php echo number_format($grand_expected, 2); ?></h3>

        </div>

    </div>

    <!-- SAFE JS -->
    <script>
    (function(){

        const totalEl = document.getElementById("totalInvested");
        const expectedEl = document.getElementById("expectedReturns");

        if(totalEl){
            totalEl.innerText = "₦" + Number(<?php echo $grand_total; ?>).toLocaleString();
        }

        if(expectedEl){
            expectedEl.innerText = "₦" + Number(<?php echo $grand_expected; ?>).toLocaleString();
        }

    })();
    </script>

    <?php

    return ob_get_clean();
}

add_shortcode('platform_my_investments', 'platform_my_investments_shortcode');