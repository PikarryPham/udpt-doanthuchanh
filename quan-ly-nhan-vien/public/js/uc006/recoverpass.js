// Selector
const passwordToggle = document.querySelector('.toggle-new-password')
const confirmPasswordToggle = document.querySelector('.toggle-confirm-password')
const newPasswordInput = document.querySelector('#newpassword')
const confirmPasswordInput = document.querySelector('#confirmnewpassword')

const newErrorMessage = document.querySelector('.error-message')
const confirmErrorMessage = document.querySelector('.confirm-error-message')
const loginForm = document.querySelector('.form')

// Event listener
newPasswordInput.addEventListener('input', onPasswordInputChange)
passwordToggle.addEventListener('click', newTogglePassword)
confirmPasswordToggle.addEventListener('click',confirmTogglePassword)
loginForm.addEventListener('submit', onRecover)

function newTogglePassword(index) {
        if (newPasswordInput.type==='password') {
            newPasswordInput.type = 'text'
            passwordToggle.style.color = '#1C83C6'
        } else { 
            newPasswordInput.type = 'password'
            passwordToggle.style.color = '#656363'
        }
}

function confirmTogglePassword(index) {
    if (confirmPasswordInput.type==='password') {
        confirmPasswordInput.type = 'text'
        confirmPasswordToggle.style.color = '#1C83C6'
    } else { 
        confirmPasswordInput.type = 'password'
        confirmPasswordToggle.style.color = '#656363'
    }
}

function onPasswordInputChange(event) {
    if (newPasswordInput.value.length < 4) {
        newErrorMessage.innerHTML = 'The password length is required at least 4 characters long.'
        newErrorMessage.style.display = 'block'
    } else {
        newErrorMessage.style.display = 'none'
        newErrorMessage.innerHTML = 'Empty'
    }
}

async function onRecover(event) {
    event.preventDefault();

    if (newPasswordInput.value!=confirmPasswordInput.value) {
        confirmErrorMessage.innerHTML = 'Passwords does not match'
        confirmErrorMessage.style.display = 'block'
    } else {
        confirmErrorMessage.style.display = 'none'
        confirmErrorMessage.innerHTML = 'Empty'
        event.target.submit()
    }
}