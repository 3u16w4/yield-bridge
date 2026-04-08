<?php

function platform_available_deals() {

$args = array(
'post_type' => 'deal',
'post_status' => 'publish',
'posts_per_page' => -1,
);

$deals = new WP_Query($args);

ob_start();
?>

<div class="fintech-page">

<div class="fintech-filters">
<select id="sectorFilter">
<option value="all">All Sectors</option>
<option value="Real Estate">Real Estate</option>
<option value="Agriculture">Agriculture</option>
<option value="Trade">Trade</option>
<option value="Tech">Tech</option>
<option value="Manufacturing">Manufacturing</option>
<option value="Other">Other</option>
</select>

<select id="riskFilter">
<option value="all">All Risk</option>
<option value="Low">Low</option>
<option value="Medium">Medium</option>
<option value="High">High</option>
</select>
</div>

<div class="deals-grid" id="dealsContainer">

<?php if ($deals->have_posts()) : while ($deals->have_posts()) : $deals->the_post();

$deal_id = get_the_ID();

$sector   = get_post_meta($deal_id,'sector',true);
$risk     = get_post_meta($deal_id,'risk_grade',true);
$roi      = get_post_meta($deal_id,'roi_percentage',true);
$duration = get_post_meta($deal_id,'duration_months',true);

$capital_required = floatval(get_post_meta($deal_id,'capital_required',true));
$capital_raised   = floatval(get_post_meta($deal_id,'capital_raised',true));
$investors        = intval(get_post_meta($deal_id,'investor_count',true));

$funding_end = get_post_meta($deal_id,'funding_end_date',true);

$sponsor_id = get_post_meta($deal_id,'sponsor',true);
$sponsor_name = $sponsor_id ? get_the_author_meta('display_name',$sponsor_id) : 'Sponsor';

$sponsor_avatar = get_avatar_url($sponsor_id);
$sponsor_link = get_author_posts_url($sponsor_id);

$percentage = 0;
if ($capital_required > 0) {
$percentage = min(100, ($capital_raised/$capital_required)*100);
}

$today = current_time('Y-m-d');

$days_left = '';
$is_funded = ($capital_raised >= $capital_required);
$is_expired = false;
$is_closing_soon = false;

/* ---- DATE LOGIC ---- */

if ($funding_end) {

    $days_left = floor((strtotime($funding_end) - strtotime($today)) / 86400);

    if (strtotime($today) > strtotime($funding_end)) {
        $is_expired = true;
    }

    if (!$is_funded && !$is_expired && $days_left <= 3 && $days_left >= 0) {
        $is_closing_soon = true;
    }
}

/* ---- DEAL STATUS ENGINE ---- */

$status = 'open';

if ($is_funded) {
    $status = 'funded';
} elseif ($is_expired) {
    $status = 'expired';
} elseif ($is_closing_soon) {
    $status = 'closing';
}

?>

<div class="deal-card"
data-sector="<?php echo esc_attr($sector); ?>"
data-risk="<?php echo esc_attr($risk); ?>">

<div class="deal-header">

<h3><?php the_title(); ?></h3>

<div class="deal-badges">

<?php if ($status === 'funded') : ?>

<span class="badge funded">✔ Fully Funded</span>

<?php elseif ($status === 'expired') : ?>

<span class="badge closed">⛔ Funding Closed</span>

<?php elseif ($status === 'closing') : ?>

<span class="badge urgency">🔥 <?php echo $days_left; ?> days left</span>

<?php endif; ?>

</div>
</div>

<div class="deal-meta">

<div><strong>ROI:</strong> <?php echo esc_html($roi); ?>%</div>

<div>
<strong>Risk:</strong>
<span class="risk-level risk-<?php echo strtolower($risk); ?>">
<?php echo esc_html($risk); ?>
</span>
</div>

<div><strong>Duration:</strong> <?php echo esc_html($duration); ?> Months</div>
<div><strong>Sector:</strong> <?php echo esc_html($sector); ?></div>
<div><strong>Investors:</strong> <?php echo esc_html($investors); ?></div>

</div>

<div class="deal-progress">

<div class="progress-bar">
<div class="progress-fill"
style="width: <?php echo esc_attr($percentage); ?>%;">
</div>
</div>

<div class="progress-text">
₦<?php echo number_format($capital_raised); ?>
raised of ₦<?php echo number_format($capital_required); ?>
(<?php echo round($percentage); ?>%)
</div>

</div>

<?php if (!$is_funded && !$is_expired && $days_left !== '') : ?>
<div class="funding-countdown">
⏳ <?php echo $days_left >= 0 ? $days_left." days left" : "Funding closed"; ?>
</div>
<?php endif; ?>

<div class="deal-sponsor">

<img src="<?php echo esc_url($sponsor_avatar); ?>" class="sponsor-logo">

<div class="sponsor-info">
<span class="sponsor-label">Sponsor</span>

<a href="<?php echo esc_url($sponsor_link); ?>" class="sponsor-name">
<?php echo esc_html($sponsor_name); ?>
</a>

</div>

</div>

<div class="deal-footer">

<?php if ($status === 'funded') : ?>

<button class="invest-btn funded-btn" disabled>
Fully Funded
</button>

<?php elseif ($status === 'expired') : ?>

<button class="invest-btn funded-btn" disabled>
Funding Closed
</button>

<?php else : ?>

<button class="invest-btn open-invest-modal"
data-deal-id="<?php echo esc_attr($deal_id); ?>"
data-min="<?php echo esc_attr(get_post_meta($deal_id,'minimum_investment',true)); ?>"
data-roi="<?php echo esc_attr($roi); ?>">
Invest Now
</button>

<?php endif; ?>

<a href="<?php echo get_permalink(); ?>" class="deal-details-link">
Details
</a>

</div>

</div>

<?php endwhile; wp_reset_postdata(); endif; ?>

</div>
</div>


<!-- Investment Modal -->

<div id="investmentModal" class="investment-overlay">

    <div class="investment-modal-box">

        <span class="close-modal">&times;</span>

        <h3>Invest in Deal</h3>

        <form method="post" class="investment-form">

            <?php wp_nonce_field('submit_investment_action','investment_nonce'); ?>
            
            <p id="minimumInvestmentNotice"></p>

            <div class="roi-calculator">

            <p><strong>ROI:</strong> <span id="roiDisplay"></span>%</p>

            <p>
                <strong>Expected Return:</strong>
                <span id="expectedReturn">₦0</span>
            </p>

            <p>
                <strong>Profit:</strong>
                <span id="profitAmount">₦0</span>
            </p>

        </div>
            
            <input type="hidden" name="deal_id" id="modalDealId">

            <label>Investment Amount (₦)</label>

            <input type="number"
                   name="investment_amount"
                   id="investmentAmount"
                   step="0.01"
                   placeholder=""
                   required>

            <button type="submit" name="submit_investment" class="confirm-invest">
                Confirm Investment
            </button>

        </form>

    </div>

</div>


<script>

document.addEventListener("DOMContentLoaded", function(){

/* ---------------- FILTERING ---------------- */

const sectorFilter = document.getElementById("sectorFilter");
const riskFilter   = document.getElementById("riskFilter");
const cards        = document.querySelectorAll(".deal-card");

function filterDeals(){

const sector = sectorFilter.value;
const risk   = riskFilter.value;

cards.forEach(card => {

const cardSector = card.dataset.sector;
const cardRisk   = card.dataset.risk;

let show = true;

if(sector !== "all" && sector !== cardSector){ show = false; }
if(risk !== "all" && risk !== cardRisk){ show = false; }

card.style.display = show ? "block" : "none";

});

}

if(sectorFilter) sectorFilter.addEventListener("change", filterDeals);
if(riskFilter) riskFilter.addEventListener("change", filterDeals);


/* ---------------- MODAL LOGIC ---------------- */

const modal = document.getElementById("investmentModal");
const closeBtn = document.querySelector(".close-modal");
const investButtons = document.querySelectorAll(".open-invest-modal");

const amountField = document.getElementById("investmentAmount");
const roiDisplay = document.getElementById("roiDisplay");
const expectedReturn = document.getElementById("expectedReturn");
const profitAmount = document.getElementById("profitAmount");

let currentROI = 0;

investButtons.forEach(button => {

if(button.disabled) return;

button.addEventListener("click", function(){

const dealId = this.dataset.dealId;
const min    = this.dataset.min;
const roi    = this.dataset.roi;

currentROI = parseFloat(roi);

/* Populate modal fields */

document.getElementById("modalDealId").value = dealId;

document.getElementById("minimumInvestmentNotice").innerHTML =
"Minimum investment: <strong>₦" + Number(min).toLocaleString() + "</strong>";

roiDisplay.innerText = roi;

/* Input setup */

amountField.min = min;
amountField.placeholder = "Minimum ₦" + Number(min).toLocaleString();
amountField.value = "";

/* Reset calculator */

expectedReturn.innerText = "₦0";
profitAmount.innerText = "₦0";

/* Show modal */

modal.style.display = "flex";

});

});


/* ---------------- ROI CALCULATOR ---------------- */

if(amountField){

amountField.addEventListener("input", function(){

const amount = parseFloat(amountField.value);

if(!amount || amount <= 0){
expectedReturn.innerText="₦0";
profitAmount.innerText="₦0";
return;
}

const profit = amount * (currentROI / 100);
const total  = amount + profit;

expectedReturn.innerText = "₦" + total.toLocaleString();
profitAmount.innerText   = "₦" + profit.toLocaleString();

});

}


/* ---------------- CLOSE MODAL ---------------- */

if(closeBtn){

closeBtn.addEventListener("click", function(){
modal.style.display="none";
});

}

window.addEventListener("click", function(e){

if(e.target === modal){
modal.style.display="none";
}

});

});

</script>

<?php

return ob_get_clean();

}

add_shortcode('available_deals','platform_available_deals');

function display_deal_financials($content) {

    if (!is_singular('deal') || !in_the_loop() || !is_main_query()) {
        return $content;
    }

    global $post;

    $sector            = get_post_meta($post->ID, 'sector', true);
    $risk_grade        = get_post_meta($post->ID, 'risk_grade', true);
    $roi_percentage    = get_post_meta($post->ID, 'roi_percentage', true);
    $duration_months   = get_post_meta($post->ID, 'duration_months', true);
    $capital_required  = floatval(get_post_meta($post->ID, 'capital_required', true));
    $minimum_investment = floatval(get_post_meta($post->ID, 'minimum_investment', true));
    $capital_raised    = floatval(get_post_meta($post->ID, 'capital_raised', true));
    $investor_count    = intval(get_post_meta($post->ID, 'investor_count', true));
    $tier              = get_post_meta($post->ID, 'tier', true);
    $sponsor_id        = get_post_meta($post->ID, 'sponsor', true);
    $settlement_date   = get_post_meta($post->ID, 'settlement_date', true);
    $deal_status       = get_post_meta($post->ID, 'deal_status', true);

    $sponsor_name = $sponsor_id ? get_the_author_meta('display_name', $sponsor_id) : 'N/A';

    // Funding progress
    $progress = 0;
    if ($capital_required > 0) {
        $progress = ($capital_raised / $capital_required) * 100;
    }

    ob_start();
    ?>

    <div class="deal-financials" style="margin-top:30px;padding:20px;border:1px solid #ddd;">

        <h3>Deal Overview</h3>

        <p><strong>Sector:</strong> <?php echo esc_html($sector); ?></p>
        <p><strong>Risk Grade:</strong> <?php echo esc_html($risk_grade); ?></p>
        <p><strong>ROI:</strong> <?php echo esc_html($roi_percentage); ?>%</p>
        <p><strong>Duration:</strong> <?php echo esc_html($duration_months); ?> months</p>

        <hr>

        <h3>Funding Details</h3>

<p><strong>Capital Required:</strong> <?php echo number_format($capital_required, 2); ?></p>
<p><strong>Capital Raised:</strong> <?php echo number_format($capital_raised, 2); ?></p>
<p><strong>Minimum Investment:</strong> <?php echo number_format($minimum_investment, 2); ?></p>
<p><strong>Investors:</strong> <?php echo esc_html($investor_count); ?></p>
<p><strong>Funding Progress:</strong> <?php echo round($progress, 2); ?>%</p>

        <div style="background:#eee;height:20px;width:100%;margin-bottom:15px;">
            <div style="background:#2e7d32;height:20px;width:<?php echo esc_attr($progress); ?>%;"></div>
        </div>

        <hr>

        <h3>Deal Classification</h3>

        <p><strong>Tier:</strong> <?php echo esc_html($tier); ?></p>
        <p><strong>Status:</strong> <?php echo esc_html($deal_status); ?></p>
        <p><strong>Settlement Date:</strong> <?php echo esc_html($settlement_date); ?></p>
        <p><strong>Sponsor:</strong> <?php echo esc_html($sponsor_name); ?></p>

    </div>

    <?php

    return $content . ob_get_clean();
}
add_filter('the_content', 'display_deal_financials');