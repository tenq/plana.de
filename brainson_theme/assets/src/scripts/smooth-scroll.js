const links = document.getElementsByTagName("a");

for (const link of links) {
    if (link.href.includes('#')) {
        link.addEventListener("click", clickHandler);
    }
}

function clickHandler(e) {
    e.preventDefault();
    const href = this.getAttribute("href");
    const offsetTop = document.querySelector(href).offsetTop;

    scroll({
        top: offsetTop,
        behavior: "smooth"
    });
}