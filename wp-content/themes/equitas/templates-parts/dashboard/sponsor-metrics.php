<?php
$total_capital = 12840000;
$commission = 385200;
$retention = 98.2;
?>

<div class="grid grid-cols-12 gap-6 mb-12">

    <div class="col-span-12 lg:col-span-5 bg-primary text-white p-8 rounded-xl">
        <p class="text-xs uppercase">Total Capital Raised</p>

        <h3 class="text-5xl font-black">
            $<?php echo number_format($total_capital, 2); ?>
        </h3>

        <div class="flex justify-between mt-6">
            <div>
                <p class="text-xs">Commission</p>
                <p>$<?php echo number_format($commission, 2); ?></p>
            </div>

            <div>
                <p class="text-xs">Retention</p>
                <p><?php echo $retention; ?>%</p>
            </div>
        </div>
    </div>

</div>