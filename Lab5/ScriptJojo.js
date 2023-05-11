// Wait until the DOM content has loaded before running the code
document.addEventListener('DOMContentLoaded', function() {
    // Get references to all relevant form elements
    const form = document.querySelector('form');
    const email = document.getElementById('email');
    const Login = document.getElementById('Username');
    const password = document.getElementById('pass');
    const Password2 = document.getElementById('pass2');
    const newsletter = document.getElementById('newsletter');
    const terms = document.getElementById('terms');

    // Adds an event listeners to the form and newsletter checkbox
    form.addEventListener('submit', validateForm);
    form.addEventListener('reset', clearErrors);
    newsletter.addEventListener('change', newsletterWarning);

    // Function to validate the form
    function validateForm(event) {
      // Prevent the default form submission behavior
    event.preventDefault();

      // Assume the form is valid to start with, this helps with checking the values
    let isValid = true;

      // Clear any previous error messages
    clearErrors();

      //checks the email value, if its wrong, it displays this error
    if (!CheckEmail(email.value)) {
        showError(email, 'Invalid email format');
        isValid = false;
    }
        // checks the Username value if its wrong, it displays this error 
    if (!CheckUsername(Login.value)) {
        showError(Login, 'Login name must be non-empty and less than 20 characters');
        isValid = false;
    }

      // Checks the password value if its wrong, it displays this error
    if (!CheckPass(password.value)) {
        showError(password, 'Password must be at least 6 characters long and contain at least one uppercase and one lowercase letter');
        isValid = false;
    }

      // Checks the value of the retype password if its not equal to the password, it displays this error
    if (password.value !== Password2.value || confirmPassword.value === '') {
        showError(Password2, 'Passwords must match and not be blank');
        isValid = false;
    }

      // Check if the terms and conditions checkbox is checked if it is not it displays this error 
    if (!terms.checked) {
        showError(terms, 'You must accept the terms and conditions');
        isValid = false;
    }

      // If the form is valid, show an alert that says that the from is valid
    if (isValid) {
        alert('Data is valid!!');
        form.submit();
    }
    }

    // Function to validate the email input, it has to match the right input (xyx@xyz.xyz)
    function CheckEmail(email) {
    const regex = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
    return regex.test(email);
    }

    // Function to check the Username to see if its less than 20 characters long 
    function CheckUsername(Login) {
    return Login.length > 0 && loginName.length < 20;
    }

    // Function to check the password input by checking the length and character types
    function CheckPass(password) {
    const minLength = 6;
    const hasUpperCase = /[A-Z]/.test(password);
    const hasLowerCase = /[a-z]/.test(password);

    return password.length >= minLength && hasUpperCase && hasLowerCase;
    }

    // Function to show an error message next to an input element
    function showError(input, message) {
      // Creates a new span element to hold the error message
    const error = document.createElement('span');
    error.className = 'error-message';
    error.style.color = 'red';
    error.textContent = message;

      // Inserts the error message after the input element
    input.parentNode.insertBefore(error, input.nextSibling);

      // Changes the border color of the input element to red
    input.style.borderColor = 'red';
    }

    // Function to remove all error messages and reset input element border colors
    function clearErrors() {
    const errorMessages = document.querySelectorAll('.error-message');
      // removes any existing error messages from the DOM
    errorMessages.forEach(function(error) {
        error.remove();
    });

    const inputs = [email, Login, password, Password2, terms];
      // resets the border color of all input fields
    inputs.forEach(function(input) {
        input.style.borderColor = '';
    });
    }

    function newsletterAlert() {
    if (newsletter.checked) {
        // warns the user about possible spam if they have checked the newsletter checkbox
        alert('Please be aware of possible spam when subscribing to our newsletter.');
    }
    }
});