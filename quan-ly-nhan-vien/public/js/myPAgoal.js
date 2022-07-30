// Error
const modal_error_fix = document.querySelector('.js-modal-error-fix')
const js_fixs = document.querySelectorAll('.js-fix')
const modalContainer = document.querySelector('.js-modal-contain')
const modalClose_fix = document.querySelector('.js-modal-close_fix')

for (const js_fix of js_fixs) {
    js_fix.addEventListener('click',showError_fix)
}

function showError_fix () {
    modal_error_fix.classList.add('open')
}

function hideError_fix () {
    modal_error_fix.classList.remove('open')
}

modalClose_fix.addEventListener('click', hideError_fix)
modal_error_fix.addEventListener('click',hideError_fix)

modalContainer.addEventListener('click', function(even){
    even.stopPropagation()
})

