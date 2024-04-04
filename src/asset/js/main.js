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

// const navtoggle = document.querySelector('.navbar-toggler');

// const navcomponent = document.querySelector('.navbar-component');


// navtoggle.addEventListener('click', () => { 
//   navtoggle.classList.toggle('active');
//   navcomponent.classList.toggle('active');
// })

// Wait for the DOM to be ready
document.addEventListener('DOMContentLoaded', function() {
    // Toggle the dropdown when clicking on the user icon
    document.getElementById('userIcon').addEventListener('click', function() {
      document.getElementById('dropdown').classList.toggle('show');
    });
  
    // Close the dropdown if clicking outside of it
    window.addEventListener('click', function(event) {
      if (!event.target.matches('#userIcon') && !event.target.matches('.decision-node-icon')) {
        var dropdown = document.getElementById('dropdown');
        if (dropdown.classList.contains('show')) {
          dropdown.classList.remove('show');
        }
      }
    });
});