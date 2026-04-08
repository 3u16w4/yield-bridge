<?php

function platform_sponsor_settlement_dashboard() {

    if (!current_user_can('sp1') && !current_user_can('sp2')) {
        return "<p>Access denied.</p>";
    }

    $sponsor_id = get_current_user_id();

    $deals = get_posts(array(
        'post_type' => 'deal',
        'author'    => $sponsor_id,
        'post_status' => 'publish',
        'numberposts' => -1
    ));

    if (!$deals) return "<p>No deals found.</p>";

    ob_start();

    echo "<h2>Settlement Dashboard</h2>";

    foreach ($deals as $deal) {

        $deal_id = $deal->ID;
        $settlement_date = get_post_meta($deal_id, 'settlement_date', true);

        echo "<h3>" . esc_html($deal->post_title) . "</h3>";
        echo "<p><strong>Settlement Date:</strong> " . esc_html($settlement_date) . "</p>";

        $investments = get_posts(array(
            'post_type'  => 'investment',
            'numberposts'=> -1,
            'meta_query' => array(
                array(
                    'key'   => 'deal_id',
                    'value' => $deal_id
                )
            )
        ));

        if (!$investments) {
            echo "<p>No investments.</p>";
            continue;
        }

        echo "<table border='1' cellpadding='8' style='width:100%;margin-bottom:30px;'>";
        echo "<tr>
                <th>Investor</th>
                <th>Invested</th>
                <th>Expected Return</th>
                <th>Status</th>
                <th>Action</th>
              </tr>";

        foreach ($investments as $inv) {

            $investment_id = $inv->ID;
            $investor = get_userdata($inv->post_author);

            $amount = floatval(get_post_meta($investment_id, 'amount', true));
            $expected = floatval(get_post_meta($investment_id, 'expected_return', true));
            $payout_status = get_post_meta($investment_id, 'payout_status', true);
            $payout_date = get_post_meta($investment_id, 'payout_date', true);
            $payout_ref = get_post_meta($investment_id, 'payout_reference', true);

            $today = date('Y-m-d');
            $matured = (strtotime($today) >= strtotime($settlement_date));

            echo "<tr>";
            echo "<td>" . esc_html($investor->display_name) . "<br>" . esc_html($investor->user_email) . "</td>";
            echo "<td>" . number_format($amount,2) . "</td>";
            echo "<td>" . number_format($expected,2) . "</td>";

            if ($payout_status === 'paid') {
                echo "<td style='color:green;'>Paid<br>Ref: " . esc_html($payout_ref) . "<br>Date: " . esc_html($payout_date) . "</td>";
                echo "<td>Completed</td>";
            } else {

                echo "<td style='color:red;'>Pending</td>";

                if ($matured) {
                    echo "<td>
                        <form method='post'>
                            <input type='hidden' name='investment_id' value='{$investment_id}'>
                            <input type='text' name='payout_reference' placeholder='Transaction Ref' required>
                            <button type='submit' name='process_payout'>Pay Investor</button>
                        </form>
                    </td>";
                } else {
                    echo "<td>Not Matured</td>";
                }
            }

            echo "</tr>";
        }

        echo "</table>";
    }

    return ob_get_clean();
}
add_shortcode('platform_sponsor_settlement', 'platform_sponsor_settlement_dashboard');