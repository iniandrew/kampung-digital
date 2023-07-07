$(document).ready(function () {
    const navbar = document.querySelector(".menu");
    const navBrand = document.querySelector(".navbar-brand");
    window.onscroll = () => {
        if (window.scrollY > 50) {
            navbar.classList.add("nav-active");
            navBrand.classList.remove("nav-brand");
            navBrand.classList.add("nav-brand-scroll");
            $(".nav-link").addClass("nav-menu-scroll");
            $(".nav-link").removeClass("nav-menu");
        } else {
            navbar.classList.remove("nav-active");
            navBrand.classList.remove("nav-brand-scroll");
            navBrand.classList.add("nav-brand");
            $(".nav-link").removeClass("nav-menu-scroll");
            $(".nav-link").addClass("nav-menu");
        }
    };

    var btn = document.getElementById("btn-up");
    window.addEventListener("scroll", function () {
        btn.classList.toggle("show", window.scrollY > 100);
    });

    $(".scroll-spy").scrollSpy({
        scrollDuration: 900,
        scrollEasing: "easeInBack",
        offsetElement: ".header",
        ignoreAnchors: [".not"],
    });

    function goTop() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    btn.addEventListener("click", goTop);
});
