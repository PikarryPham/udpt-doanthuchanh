const modal_edit_eror = document.querySelector('.js-modal-edit-error');
const modal_del_co = document.querySelector('.js-modal-del-co');
const modal_del_re = document.querySelector('.js-modal-del-re');
const modal_notification = document.querySelector('.js-modal-push-re');
const modal_new_rq = document.querySelector('.js-modal-new-rq');
const create_rqs = document.querySelectorAll('.new-rq');
const modalContainer_new_rq = document.querySelector('.js-modal-contain-new-rq');
const cancel = document.querySelector('.cancel');
const modal_unsubmit = document.querySelector('.js-modal-unsubmit');

for (const create_rq of create_rqs) {
    create_rq.addEventListener('click',showNewOTRequest)
}

function showNewOTRequest () {
    modal_new_rq.classList.add('open')
    if(document.getElementById('OTRequest_ID').value != "0"){
        document.getElementById('OTRequest_ID').value = 0;
        reset_request_ot_detail();
        document.getElementById('REASON_EMPLOYEE').value = "";
    }
    document.getElementById('STATUS_REQUEST').value = "Draft";
}

function hideNewOTRequest () {
    modal_new_rq.classList.remove('open')
}

cancel.addEventListener('click',hideNewOTRequest)

modalContainer_new_rq.addEventListener('click', function(even){
    even.stopPropagation()
})

function showError (content) {
    modal_edit_eror.classList.add('open')
    document.getElementById("content-error-alert").innerHTML = content;
}

function hideError () {
    modal_edit_eror.classList.remove('open')
}

function showDelRequest () {
    modal_del_re.classList.add('open')
}

function showDelConfirm () {
    delete_an_request_ot(OTRequest_ID);
    modal_del_re.classList.remove('open')
    modal_del_co.classList.add('open')
}

function hideDelRequest () {
    modal_del_re.classList.remove('open')
}

function hideDelConfirm () {
    modal_del_co.classList.remove('open')
}

function showNotification(title, message) {
    modal_notification.classList.add('open');
    document.getElementById('title-notification').innerHTML = title;
    document.getElementById('message-notification').innerHTML = message;
}

function hiddenNotification() {
    modal_notification.classList.remove('open');
}

function hiddenNotificationAll(){
    modal_notification.classList.remove('open');
    modal_new_rq.classList.remove('open');
}

function hiddenModalUnSubmit(){
    modal_unsubmit.classList.remove('open');
}

function showModalUnSubmit(){
    modal_unsubmit.classList.add('open');
}