<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
/* Default comment here */ 

document.addEventListener("click", function(e){

if(e.target.classList.contains("invest-btn")){

let deal = e.target.dataset.deal;

document.getElementById("investment-modal").style.display="flex";
document.getElementById("modal-deal-name").innerText = deal;

}

});</script>
<!-- end Simple Custom CSS and JS -->
