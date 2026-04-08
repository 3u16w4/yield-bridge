<?php
$user_id = get_current_user_id();
$data = equitas_get_investor_metrics($user_id);
?>

<div>
    <h2 class="text-4xl font-bold">
        $<?php echo number_format($data['aum'] ?? 0); ?>
    </h2>

    <p>Expected ROI: <?php echo $data['roi'] ?? '0%'; ?></p>
</div>