"use strict";

window.addEventListener("load", function () {
    var flexky = document.getElementById("flexky"),
        open = document.getElementById("btn-menu"),
        menu = document.getElementById("flexky-menu");
    if (window.pageYOffset > 100) flexky.classList.add("flexky--scroll");
    window.addEventListener("scroll", function () {
        window.pageYOffset > 100 && window.innerWidth > 900 ? flexky.classList.add("flexky--scroll") : flexky.classList.remove("flexky--scroll");
    });
    open.addEventListener("click", function () {
        menu.classList.toggle("flexky__container--active");
    });
});