// Correctly get the first navbar element
const navbar = document.getElementById("header-bar-js"); // Access the first element

// Make sure navbar exists to avoid errors
if (navbar) {
    // Get the offset position of the navbar correctly
    const sticky = navbar.offsetTop;

    // Function to add the sticky class to the navbar when you reach its scroll position
    function stickHeader() {
        if (window.pageYOffset > sticky) {
            navbar.classList.add("sticky");
        } else {
            navbar.classList.remove("sticky");
        }
    }

    // Add the scroll event listener
    window.addEventListener("scroll", stickHeader);
}
