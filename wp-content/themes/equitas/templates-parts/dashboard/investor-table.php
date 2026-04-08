<?php
$investments = equitas_get_investments(get_current_user_id());
?>

<div class="bg-white rounded-xl shadow-sm">

<table class="w-full">

<thead>
<tr>
<th>Asset</th>
<th>Status</th>
<th>Principal</th>
<th>Payout</th>
</tr>
</thead>

<tbody>

<?php foreach ($investments as $inv): ?>

<tr class="border-t">

<td><?php echo esc_html($inv->title); ?></td>

<td><?php echo esc_html($inv->status); ?></td>

<td>$<?php echo number_format($inv->amount); ?></td>

<td>$<?php echo number_format($inv->payout); ?></td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>