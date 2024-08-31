const form = document.querySelector('form');
const usernameInput = document.getElementById('username');
const emailInput = document.getElementById('email');
const 
 passwordInput = document.getElementById('password');
const confirmPasswordInput = document.getElementById('confirmPassword'); 

const usernameError = document.getElementById('usernameError');
const emailError = document.getElementById('emailError');
const passwordError = document.getElementById('passwordError'); 

const confirmPasswordError = document.getElementById('confirmPasswordError');

form.addEventListener('submit', 
 (event) => {
    clearErrors();
    if (usernameInput.value === '') {
        usernameError.textContent = 'Username is required';
        event.preventDefault();
    }
    if (emailInput.value === '') {
        emailError.textContent = 'email is required';
        event.preventDefault();
    }
    if (passwordInput.value === '') {
      passwordError.textContent = 'password is required';
        event.preventDefault();
    }
    if (confirmpasswordInput.value === '') {
      confirmpasswordError.textContent = 'confirmpassword is required';
        event.preventDefault();
    }
    if (profilepictureInput.value === '') {
       profilepictureError.textContent = 'profilepicture is required';
        event.preventDefault();
    }
});

function clearErrors() {
    // Clear error messages
}