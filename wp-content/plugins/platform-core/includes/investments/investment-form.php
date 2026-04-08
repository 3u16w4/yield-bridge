<?php

function platform_investment_form($content) {

    if (!is_singular('deal') || !in_the_loop() || !is_main_query()) {
        return $content;
    }

    global $post;

    if (!current_user_can('subscriber') && !current_user_can('investor')) {
        return $content;
    }

    $deal_status = get_post_meta($post->ID, 'deal_status', true);
    $capital_required = floatval(get_post_meta($post->ID, 'capital_required', true));
    $minimum_investment = floatval(get_post_meta($post->ID, 'minimum_investment', true));
    $capital_raised = floatval(get_post_meta($post->ID, 'capital_raised', true));
    
    if ($deal_status !== 'Open' || $capital_raised >= $capital_required) {
        return $content;
    }

    ob_start();
    ?>

    <h3>Invest in this Deal</h3>

<p><strong>Minimum Investment:</strong> <?php echo number_format($minimum_investment, 2); ?></p>

<form method="post">
    <?php wp_nonce_field('submit_investment_action', 'investment_nonce'); ?>
    <input type="hidden" name="deal_id" value="<?php echo esc_attr($post->ID); ?>">

    <input type="number" 
           name="investment_amount" 
           step="0.01"
           min="<?php echo esc_attr($minimum_investment); ?>"
           placeholder="Minimum <?php echo esc_attr($minimum_investment); ?>"
           required>

    <button type="submit" name="submit_investment">Invest</button>
</form>

    <?php

    return $content . ob_get_clean();
}
add_filter('the_content', 'platform_investment_form');
