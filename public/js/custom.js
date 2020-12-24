let scrollToTopBtn = document.getElementById("scrollToTopBtn");
let rootElement = document.documentElement;

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        scrollToTopBtn.style.display = "block";
    } else {
        scrollToTopBtn.style.display = "none";
    }
}

function topFunction() {
    rootElement.scrollTo({
        top: 0,
        behavior: "smooth"})
}

