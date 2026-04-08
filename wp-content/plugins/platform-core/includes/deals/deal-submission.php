<?php

function sponsor_deal_submission() {

    if (!current_user_can('sp1') && !current_user_can('sp2')) {
        return "<p>Access denied.</p>";
    }

    if (isset($_POST['submit_deal'])) {

        if (!isset($_POST['deal_nonce']) || 
            !wp_verify_nonce($_POST['deal_nonce'], 'submit_deal_action')) {
            return "<p>Security check failed.</p>";
        }

        $deal_id = wp_insert_post(array(
            'post_title'   => sanitize_text_field($_POST['deal_title']),
            'post_content' => sanitize_textarea_field($_POST['deal_description']),
            'post_status'  => 'pending',
            'post_type'    => 'deal',
            'post_author'  => get_current_user_id()
        ));

        if ($deal_id) {

            // Deal Details
            update_post_meta($deal_id, 'sector', sanitize_text_field($_POST['sector']));
            update_post_meta($deal_id, 'risk_grade', sanitize_text_field($_POST['risk_grade']));
            update_post_meta($deal_id, 'roi_percentage', floatval($_POST['roi_percentage']));
            update_post_meta($deal_id, 'duration_months', intval($_POST['duration_months']));
            update_post_meta($deal_id, 'minimum_investment', intval($_POST['minimum_investment']));
            update_post_meta($deal_id, 'capital_required', floatval($_POST['capital_required']));
            update_post_meta($deal_id, 'capital_raised', 0); // Always start at 0
            update_post_meta($deal_id, 'investor_count', 0);
            update_post_meta($deal_id, 'tier', sanitize_text_field($_POST['tier']));
            update_post_meta($deal_id, 'sponsor', get_current_user_id());
            update_post_meta($deal_id, 'funding_start_date', sanitize_text_field($_POST['funding_start_date']));
            update_post_meta($deal_id, 'funding_end_date', sanitize_text_field($_POST['funding_end_date']));
            update_post_meta($deal_id, 'settlement_date', sanitize_text_field($_POST['settlement_date']));
            update_post_meta($deal_id, 'deal_status', 'Scheduled');

            return "<p>Deal submitted for committee review.</p>";
        }
    }

    ob_start();
    ?>

    <form method="post">

        <?php wp_nonce_field('submit_deal_action', 'deal_nonce'); ?>

        <h3>Deal Information</h3>

        <input type="text" name="deal_title" placeholder="Deal Title" required>
        <textarea name="deal_description" placeholder="Deal Overview" required></textarea>

        <h3>Deal Details</h3>

        <label>Sector</label>
        <select name="sector" required>
            <option value="Real Estate">Real Estate</option>
            <option value="Agriculture">Agriculture</option>
            <option value="Trade">Trade</option>
            <option value="Tech">Tech</option>
            <option value="Manufacturing">Manufacturing</option>
            <option value="Other">Other</option>
        </select>

        <label>Risk Grade</label>
        <select name="risk_grade" required>
            <option value="Low">Low</option>
            <option value="Medium">Medium</option>
            <option value="High">High</option>
        </select>

        <label>ROI Percentage (%)</label>
        <input type="number" name="roi_percentage" step="0.01" required>

        <label>Duration (Months)</label>
        <input type="number" name="duration_months" required>

        <label>Capital Required</label>
        <input type="number" name="capital_required" step="0.01" required>
        <label>Minimum Investment Amount</label><br>
        <input type="number" name="minimum_investment" required min="1">
        <label>Tier</label>
        <select name="tier" required>
            <option value="Open">Open</option>
            <option value="Pro">Pro</option>
        </select>
        <label>Funding Start Date</label>
        <input type="date" name="funding_start_date" required>
        <label>Funding End Date</label>
        <input type="date" name="funding_end_date" required>
        <label>Settlement Date</label>
        <input type="date" name="settlement_date" required>

        <br><br>
        <button type="submit" name="submit_deal">Submit Deal</button>

    </form>

    <?php
    return ob_get_clean();
}
add_shortcode('sponsor_submit_deal', 'sponsor_deal_submission');