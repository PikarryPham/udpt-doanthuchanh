// // Js for Error
// const modal_error = document.querySelector('.js-modal-error')
// const give_fbs = document.querySelectorAll('.give-fb')
// const modalContainer_er = document.querySelector('.js-modal-contain-er')
// const modalClose_er = document.querySelector('.js-modal-close-er')
// for (const give_fb of give_fbs) {
//     give_fb.addEventListener('click',showError)
// }

// function showError () {
//     modal_error.classList.add('open')
// }

// function hideError () {
//     modal_error.classList.remove('open')
// }

// modalClose_er.addEventListener('click', hideError)

// modal_error.addEventListener('click',hideError)

// modalContainer_er.addEventListener('click', function(even){
//     even.stopPropagation()
// })

// Js for feedback Error
const modal_feedback_er = document.querySelector('.js-modal-feedback-er')
const feedback_ers = document.querySelectorAll('.feedback-er')
const modalContainer_feedback_er = document.querySelector('.js-modal-contain-feedback-er')
const modalClose_feedback_er = document.querySelector('.js-modal-close-feedback-er')
for (const feedback_er of feedback_ers) {
    feedback_er.addEventListener('click',showError)
}

function showError () {
    modal_feedback_er.classList.add('open')
}

function hideError () {
    modal_feedback_er.classList.remove('open')
}

modalClose_feedback_er.addEventListener('click', hideError)

modal_feedback_er.addEventListener('click',hideError)

modalContainer_feedback_er.addEventListener('click', function(even){
    even.stopPropagation()
})

// // // Js for feedback form
// const modal_feedback_send = document.querySelector('.js-modal-feedback-send')
// const feedback_sends = document.querySelectorAll('.feedback')
// const modalContainer_feedback_send = document.querySelector('.js-modal-contain-feedback-send')
// const cancelClose = document.querySelector('.cancel')
// for (const feedback of feedback_sends) {
//     feedback.addEventListener('click',showFbSend)
// }

// function showFbSend () {
//     modal_feedback_send.classList.add('open')
// }

// function hideFbSend () {
//     modal_feedback_send.classList.remove('open')
// }

// cancelClose.addEventListener('click', hideFbSend)

// modal_feedback_send.addEventListener('click',hideFbSend)

// modalContainer_feedback_send.addEventListener('click', function(even){
//     even.stopPropagation()
// })

// // // Js for fbSucess
// const modal_fb_sucess = document.querySelector('.js-modal-fb-success')
// const saves = document.querySelectorAll('.save')
// const modalContainer_fb_sucess = document.querySelector('.js-modal-contain-fb-success')
// const modalClose_fb_sucess = document.querySelector('.js-modal-close-fb-success')
// const ok = document.querySelector('.ok')
// for (const save of saves) {
//     save.addEventListener('click',showfbSucess)
// }

// function showfbSucess () {
//     modal_fb_sucess.classList.add('open')
// }

// function hidefbSucess () {
//     modal_fb_sucess.classList.remove('open')
// }

// modalClose_fb_sucess.addEventListener('click', hidefbSucess)
// ok.addEventListener('click', hidefbSucess)
// // ok.addEventListener('click', hideFbSend)

// modal_fb_sucess.addEventListener('click',hidefbSucess)

// modalContainer_fb_sucess.addEventListener('click', function(even){
//     even.stopPropagation()
// })