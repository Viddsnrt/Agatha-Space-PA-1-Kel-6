// public/js/app.js
document.addEventListener('DOMContentLoaded', function () {
    // Navbar scroll effect
    const mainNavbar = document.getElementById("mainNavbar");
    if (mainNavbar) {
        window.addEventListener("scroll", function () {
            if (window.scrollY > 50) {
                mainNavbar.classList.add("scrolled");
            } else {
                mainNavbar.classList.remove("scrolled");
            }
        });
    }

    // Aktifkan tooltips Bootstrap jika Anda menggunakannya
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

});