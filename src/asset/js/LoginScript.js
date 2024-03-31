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