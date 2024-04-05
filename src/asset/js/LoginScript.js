const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});


document.addEventListener('DOMContentLoaded', function() {
    const firstNameInput = document.getElementById('first_name');
    const lastNameInput = document.getElementById('last_name');
    const passwordInput = document.getElementById('pwd');
    const confirmPasswordInput = document.getElementById('pwd_confirm');

    function validateName(input) {
        const regex = /^[a-zA-Z0-9 ]+$/;
        return regex.test(input.value); // Returns true if input matches the regex, false otherwise
    }

    function passwordsMatch(password, confirmPassword) {
        return password.value === confirmPassword.value;
    }

    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const isValidFirstName = validateName(firstNameInput);
        const isValidLastName = validateName(lastNameInput);
        const isPasswordMatch = passwordsMatch(passwordInput, confirmPasswordInput);

        let errorMessage = "Please fix the following errors before submitting:";
        let errorsExist = false;

        if (!isValidFirstName || !isValidLastName) {
            errorMessage += "\n\n* No Special Characters for First and Last Name";
            errorsExist = true;
        }

        if (!isPasswordMatch) {
            errorMessage += "\n\n* Password and Confirm Password do not match";
            errorsExist = true;
        }

        if (errorsExist) {
            // Prevent form submission
            e.preventDefault();
            // Show an alert with the error messages
            alert(errorMessage);
        }
    });
});

var toggleButton = document.getElementById('toggleForms');

document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('container');
    const toggleButton = document.getElementById('toggleForms');
    const signUpForm = document.querySelector('.sign-up');
    const signInForm = document.querySelector('.sign-in');

    // Function to toggle visibility based on the 'active' class
    function toggleForms() {
        // Toggle 'active' class on the container
        container.classList.toggle('active');
        adjustVisibility(); // Adjust visibility after toggling
    }

    // Function to adjust the form visibility based on window size and 'active' class
    function adjustVisibility() {
        if (window.innerWidth < 769) {
            // Small screens: Display only one form based on 'active' class
            if (container.classList.contains('active')) {
                signUpForm.style.display = 'block';
                signInForm.style.display = 'none';
                toggleButton.textContent = 'To Sign-In'; // Update button text accordingly
                toggleButton.style.display = 'block';
            } else {
                signInForm.style.display = 'block';
                signUpForm.style.display = 'none';
                toggleButton.textContent = 'To Sign-Up'; // Update button text accordingly
                toggleButton.style.display = 'block';
            }
        } else {
            // Larger screens: Show both forms
            signUpForm.style.display = 'block';
            signInForm.style.display = 'block';
            toggleButton.style.display = 'none'; // Optionally, hide the toggle button as both forms are visible
        }
    }

    // Event listeners
    toggleButton.addEventListener('click', toggleForms);
    window.addEventListener('resize', adjustVisibility);

    // Initial call to set the correct visibility based on current window size
    adjustVisibility();
});

