// Js for My leave page
const js_leaves = document.querySelectorAll('.js-leave-his')
const leave_his = document.querySelector('.leave-history')
const modalContainer = document.querySelector('.js-modal-contain')
const btn1 = document.querySelector('.btn1');
const btn2 = document.querySelector('.btn2');
const js_summarys = document.querySelectorAll('.js-summary')
const summary = document.querySelector('.summary')


for (const js_summary of js_summarys) {
    js_summary.addEventListener('click',showSummary)
}

for (const js_leave of js_leaves) {
    js_leave.addEventListener('click',showLeaveManagement)
}

function showLeaveManagement () {
    leave_his.classList.toggle('open')
    leave_his.classList.remove('hidden')
    document.getElementById('btn-leave').style.backgroundColor = "var(--green)"
    document.getElementById('btn-leave').style.color = "var(--white)"
    document.getElementById('content-body').style.backgroundColor = "var(--nav)"
    btn1.classList.add('open')
    btn2.classList.remove('open')
    summary.classList.remove('open')
}

function showSummary () {
    summary.classList.add('open')
    btn2.classList.add('open')
    btn1.classList.remove('open')
    document.getElementById('btn-leave').style.backgroundColor = "var(--primary-lighter)"
    document.getElementById('btn-leave').style.color = "var(--black)"
    leave_his.classList.remove('open')
    leave_his.classList.toggle("hidden")
}

modalContainer.addEventListener('click', function(even){
    even.stopPropagation()
})

// // Js for Error modal
// const modal_error = document.querySelector('.js-modal-error')
// const modal_error_fix = document.querySelector('.js-modal-error-fix')
// const js_trashs = document.querySelectorAll('.js-trash')
// const js_fixs = document.querySelectorAll('.js-fix')
// const modalClose = document.querySelector('.js-modal-close')
// const modalClose_fix = document.querySelector('.js-modal-close_fix')
// for (const js_trash of js_trashs) {
//     js_trash.addEventListener('click',showError)
// }

// for (const js_fix of js_fixs) {
//     js_fix.addEventListener('click',showError_fix)
// }

// function showError_fix () {
//     modal_error_fix.classList.add('open')
// }

// function hideError_fix () {
//     modal_error_fix.classList.remove('open')
// }

// function showError () {
//     modal_error.classList.add('open')
// }

// function hideError () {
//     modal_error.classList.remove('open')
// }

// modalClose.addEventListener('click', hideError)

// modalClose_fix.addEventListener('click', hideError_fix)

// modal_error.addEventListener('click',hideError)

// modal_error_fix.addEventListener('click',hideError_fix)

// modalContainer.addEventListener('click', function(even){
//     even.stopPropagation()
// })

// Js for Delete request 

const js_del_res = document.querySelectorAll('.js-del-re')
const js_del_cos = document.querySelectorAll('.js-confirm')
const modal_del_re = document.querySelector('.js-modal-del-re')
const modal_del_co = document.querySelector('.js-modal-del-co')
const modalContainer_res = document.querySelector('.js-modal-contain-re')
const modalContainer_cos = document.querySelector('.js-modal-contain-co')

const modalClose_del_re = document.querySelector('.js-modal-close-del-re')
const modalClose_del_co = document.querySelector('.js-modal-close-del-co')

const ok_btn = document.querySelector('.ok-btn')

for (const js_del_re of js_del_res) {
    js_del_re.addEventListener('click',showDelRequest)
}

for (const js_del_co of js_del_cos) {
    js_del_co.addEventListener('click',showDelConfirm)
}

function showDelRequest () {
    modal_del_re.classList.add('open')
}

function showDelConfirm () {
    modal_del_co.classList.add('open')
    modal_del_re.classList.remove('open')
}

function hideDelRequest () {
    modal_del_re.classList.remove('open')
}

function hideDelConfirm () {
    modal_del_co.classList.remove('open')
}

ok_btn.addEventListener('click', hideDelConfirm)
modalClose_del_re.addEventListener('click', hideDelRequest)
modalClose_del_co.addEventListener('click', hideDelConfirm)

modal_del_re.addEventListener('click',hideDelRequest)
modal_del_co.addEventListener('click',hideDelRequest)

modalContainer_res.addEventListener('click', function(even){
    even.stopPropagation()
})

modalContainer_cos.addEventListener('click', function(even){
    even.stopPropagation()
})