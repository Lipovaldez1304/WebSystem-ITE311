<script>
    const toggleBtn = document.getElementById("toggleBtn");
    const sidebar = document.getElementById("sidebar");
    const topbar = document.getElementById("topbar");
    const mainContent = document.getElementById("mainContent");

    // -------------------------------
    // Toggle Sidebar ONLY via Hamburger Button
    // -------------------------------
    toggleBtn.addEventListener("click", function (e) {
        e.stopPropagation(); 

        sidebar.classList.toggle("collapsed");
        topbar.classList.toggle("collapsed");
        mainContent.classList.toggle("collapsed");
        toggleBtn.classList.toggle("collapsed"); 
    });
</script>

</body>
</html>