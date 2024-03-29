// Get the navbar element
const navbar = document.getElementById("navbar");

// Get the offset position of the navbar
const sticky = navbar.offsetTop;

// Function to add the sticky class to the navbar when you reach its scroll position
function stickNavbar() {
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky");
    } else {
        navbar.classList.remove("sticky");
    }
}

// Add the scroll event listener
window.addEventListener("scroll", stickNavbar);
