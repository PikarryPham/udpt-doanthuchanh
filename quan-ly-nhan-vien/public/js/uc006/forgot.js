// Selector
const emailInput = document.querySelector('#email')
const errorMessage = document.querySelector('.error-message')
const loginForm = document.querySelector('.form')

// Event listener
loginForm.addEventListener('submit', onForgotPassword)
async function onForgotPassword(event) {
    event.preventDefault();

    // Call API to check if email is valid
    if (passwordInput.value.length < 4) {
        errorMessage.innerHTML = 'The email doesn not exit'
        errorMessage.style.display = 'block'
    } else {
        errorMessage.style.display = 'none'
        errorMessage.innerHTML = 'Empty'
    }

    event.target.submit()
}