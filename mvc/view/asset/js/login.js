// Selector
const passwordToggle = document.querySelector('.toggle-password')
const passwordInput =  document.querySelector('#password')
const errorMessage = document.querySelector('.error-message')
const loginForm = document.querySelector('.form')

// Event listener
passwordToggle.addEventListener('click', togglePassword)
loginForm.addEventListener('submit', onLogin)

function togglePassword() {
    if (passwordInput.type==='password') {
        passwordInput.type = 'text'
        passwordToggle.style.color = '#1C83C6'
    } else { 
        passwordInput.type = 'password'
        passwordToggle.style.color = '#656363'
    }
}

function onLogin(event) {
    event.preventDefault();

    if (passwordInput.value.length < 8) {
        errorMessage.innerHTML = 'The password must have at least 8 characters'
        errorMessage.style.visibility = 'visible'
    } else {
        errorMessage.style.visibility = 'hidden'
        errorMessage.innerHTML = 'Empty'
        event.target.submit()
    }
}