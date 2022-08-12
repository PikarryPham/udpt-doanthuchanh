const modal_new_goal = document.querySelector('.js-modal-new-goal')
const modal_edit_eror = document.querySelector('.js-modal-edit-error')
const modal_unsubmit = document.querySelector('.js-modal-unsubmit')
const modal_del_re = document.querySelector('.js-modal-del-re')
const modal_del_co = document.querySelector('.js-modal-del-co')
const modal_del_re_all = document.querySelector('.js-modal-del-re-all')
const modal_del_co_all = document.querySelector('.js-modal-del-co-all')
const modal_submit    = document.querySelector('.js-model-confirm-submit')

function showSubmitRequest(){
    if (my_data.length == 0){
        showError("You need at least 1 record to submit");
    }else{
        modal_submit.classList.add('open');
    }
}

function hideSubmitRequest(){
    modal_submit.classList.remove('open');
}

function choice_submit(){
    get_email_admin();
    change_status();
    hideSubmitRequest();
    showConfOftions("submit successfully", "Your manuscript has been successfully changed to pending");
}

function showNewGoalCreate (id) {
    edit_model(id);
    modal_view_goal.classList.add('open')
}

function hideNewGoalCreate () {
    modal_view_goal.classList.remove('open')
}

function showGoalCreate() {
    modal_new_goal.classList.add('open')
}

function hideGoalCreate() {
    modal_new_goal.classList.remove('open')
}

function showError(text) {
    document.getElementById('content-eror').innerHTML = text;
    modal_edit_eror.classList.add('open')
}

function hideError() {
    modal_edit_eror.classList.remove('open')
}

function showUnsubmitForm() {
    modal_unsubmit.classList.add('open')
}

function hideUnsubmitForm() {
    modal_unsubmit.classList.remove('open')
}

function showDelRequest(id) {
    modal_del_re.classList.add('open')
    id_delete = id;
}

function showDelConfirm() {
    modal_del_co.classList.add('open')
    modal_del_re.classList.remove('open')
    delete_goal([id_delete.toString()]);
}

function hideDelRequest() {
    modal_del_re.classList.remove('open')
}

function hideDelConfirm() {
    modal_del_co.classList.remove('open')
}

function showDelRequestAll() {
    document.getElementById("heading-delete-modal").innerHTML = "delete the goal(s)";
    document.getElementById("message-delete-modal").innerHTML = "you have choose some goals to delete. do you want to delete them? This step cannot be undo";
    document.getElementById("showDelConfirmAll").onclick = showDelConfirmAll;
    if (id_deletes.length == 0){
        showError("You have not selected any records yet");
    }else{
        modal_del_re_all.classList.add('open')
    }
}

function showDeleteAll(){
    document.getElementById("heading-delete-modal").innerHTML = "delete all the goals";
    document.getElementById("message-delete-modal").innerHTML = "Do you want to delete all existing records?";
    document.getElementById("showDelConfirmAll").onclick = showDelConfirmAll;
    modal_del_re_all.classList.add('open')
}

function showDeleteConfirmAll() {
    modal_del_co_all.classList.add('open')
    modal_del_re_all.classList.remove('open')
    delete_goal([]);
}

function showDelConfirmAll() {
    modal_del_co_all.classList.add('open')
    modal_del_re_all.classList.remove('open')
    delete_goal(id_deletes);
}

function showConfOftions(title, message) {
    document.getElementById("title-alert").innerHTML = title;
    document.getElementById("message-alert").innerHTML = message;
    modal_del_co_all.classList.add('open')
}

function hideDelRequestAll() {
    modal_del_re_all.classList.remove('open')
}

function hideDelConfirmAll() {
    modal_del_co_all.classList.remove('open')
}

function showMolAlert() {
    document.getElementById("js-modal-done-alert").classList.add('open');
    hideUnsubmitForm();
}

function hideMolAlert1(){
    window.location = `${host_name}/UC0131_132/self_result_view/${pa_goal_id}`;
}

function hideMolAlert2(){
    window.location = `${host_name}/UC0131_132/myPAgoal`;
}

function hideGoalEdit(){
    $('.js-modal-edit-goal')[0].classList.remove('open')
}