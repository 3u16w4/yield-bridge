<?php

function platform_investor_dashboard_shortcode() {

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
        return "<p>No investment data available.</p>";
    }

    $portfolio = [];
    $payout_summary = [
        'paid' => 0,
        'pending' => 0
    ];

    foreach ($investments as $inv) {

        $deal_id = get_post_meta($inv->ID, 'deal_id', true);
        $amount  = floatval(get_post_meta($inv->ID, 'amount', true));
        $expected = floatval(get_post_meta($inv->ID, 'expected_return', true));
        $payout_status = get_post_meta($inv->ID, 'payout_status', true);

        if (!$deal_id) continue;

        if (!isset($portfolio[$deal_id])) {
            $portfolio[$deal_id] = [
                'invested' => 0,
                'expected' => 0,
                'title' => get_the_title($deal_id)
            ];
        }

        $portfolio[$deal_id]['invested'] += $amount;
        $portfolio[$deal_id]['expected'] += $expected;

        // Payout tracking
        if ($payout_status === 'paid') {
            $payout_summary['paid'] += $expected;
        } else {
            $payout_summary['pending'] += $expected;
        }
    }

    // Totals
    $total_invested = 0;
    $total_expected = 0;

    foreach ($portfolio as $data) {
        $total_invested += $data['invested'];
        $total_expected += $data['expected'];
    }

    $total_profit = $total_expected - $total_invested;

    ob_start();
    ?>

    <div class="fintech-page">

        <div class="fintech-hero">
            <h1>Investor Dashboard</h1>
            <p>Analytics, performance and payout tracking</p>
        </div>

        <!-- KPI CARDS -->
        <div class="portfolio-summary">

            <div class="summary-card">
                <h4>Total Invested</h4>
                <p>₦<?php echo number_format($total_invested, 2); ?></p>
            </div>

            <div class="summary-card">
                <h4>Expected Value</h4>
                <p>₦<?php echo number_format($total_expected, 2); ?></p>
            </div>

            <div class="summary-card">
                <h4>Total Profit</h4>
                <p>₦<?php echo number_format($total_profit, 2); ?></p>
            </div>

            <div class="summary-card">
                <h4>Payout Pending</h4>
                <p>₦<?php echo number_format($payout_summary['pending'], 2); ?></p>
            </div>

        </div>

        <!-- CHARTS -->
        <div class="charts-grid">

            <div class="chart-card">
                <h3>Portfolio Allocation</h3>
                <canvas id="portfolioChart"></canvas>
            </div>

            <div class="chart-card">
                <h3>ROI Projection</h3>
                <canvas id="roiChart"></canvas>
            </div>

        </div>

        <!-- PAYOUT TABLE -->
        <div class="payout-table">

            <h3>Payout Tracking</h3>

            <table>
                <tr>
                    <th>Deal</th>
                    <th>Invested</th>
                    <th>Expected</th>
                    <th>Status</th>
                </tr>

                <?php foreach ($portfolio as $deal_id => $data):

                    $status = get_post_meta($deal_id, 'deal_status', true);
                    $status = $status ? $status : 'Open';

                ?>

                <tr>
                    <td><?php echo esc_html($data['title']); ?></td>
                    <td>₦<?php echo number_format($data['invested'], 2); ?></td>
                    <td>₦<?php echo number_format($data['expected'], 2); ?></td>
                    <td><?php echo esc_html($status); ?></td>
                </tr>

                <?php endforeach; ?>

            </table>

        </div>

    </div>

    <!-- CHART.JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function(){

        const labels = <?php echo json_encode(array_column($portfolio, 'title')); ?>;
        const investedData = <?php echo json_encode(array_column($portfolio, 'invested')); ?>;
        const expectedData = <?php echo json_encode(array_column($portfolio, 'expected')); ?>;

        // Portfolio Allocation Chart
        new Chart(document.getElementById("portfolioChart"), {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: investedData
                }]
            }
        });

        // ROI Chart
        new Chart(document.getElementById("roiChart"), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    { label: "Invested", data: investedData },
                    { label: "Expected", data: expectedData }
                ]
            }
        });

    });
    </script>

    <?php

    return ob_get_clean();
}

add_shortcode('investor_dashboard', 'platform_investor_dashboard_shortcode');