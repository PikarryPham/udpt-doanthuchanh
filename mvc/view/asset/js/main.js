const wfh_manages = document.querySelectorAll('.js-wfh-manage')
const modal = document.querySelector('.js-modal')
const modalContainer = document.querySelector('.js-modal-contain')
const modalClose = document.querySelector('.js-modal-close')

for (const wfh_manage of wfh_manages) {
    wfh_manage.addEventListener('click',showNotification)
}

function showNotification () {
    modal.classList.add('open')
}

function hideNotification () {
    modal.classList.remove('open')
}

modalClose.addEventListener('click', hideNotification)

modal.addEventListener('click',hideNotification)

modalContainer.addEventListener('click', function(even){
    even.stopPropagation()
})

// Js for Error
const modal_error = document.querySelector('.js-modal-error')
const wfh_manages_er = document.querySelectorAll('.js-wfh-manage-er')
const modalContainer_er = document.querySelector('.js-modal-contain-er')
const modalClose_er = document.querySelector('.js-modal-close-er')
for (const wfh_manage of wfh_manages_er) {
    wfh_manage.addEventListener('click',showError)
}

function showError () {
    modal_error.classList.add('open')
}

function hideError () {
    modal_error.classList.remove('open')
}

modalClose_er.addEventListener('click', hideError)

modal_error.addEventListener('click',hideError)

modalContainer_er.addEventListener('click', function(even){
    even.stopPropagation()
})