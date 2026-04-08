<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
/* Default comment here */ 

document.addEventListener("DOMContentLoaded", function() {

    const toggle = document.createElement("button");
    toggle.innerHTML = "🌙";
    toggle.style.position = "fixed";
    toggle.style.bottom = "20px";
    toggle.style.right = "20px";
    toggle.style.zIndex = "9999";
    toggle.style.padding = "10px 14px";
    toggle.style.borderRadius = "50px";
    toggle.style.border = "none";
    toggle.style.cursor = "pointer";
    toggle.style.background = "#2563EB";
    toggle.style.color = "#fff";

    toggle.onclick = function() {
        document.body.classList.toggle("dark-mode");
    };

    document.body.appendChild(toggle);

});</script>
<!-- end Simple Custom CSS and JS -->
