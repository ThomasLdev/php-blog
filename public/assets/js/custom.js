window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    let scrollToTopBtn = document.getElementById("scrollToTopBtn");
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        scrollToTopBtn.style.display = "block";
    } else {
        scrollToTopBtn.style.display = "none";
    }
}

function topFunction() {
    let rootElement = document.documentElement;
    rootElement.scrollTo({
        top: 0,
        behavior: "smooth"})
}

