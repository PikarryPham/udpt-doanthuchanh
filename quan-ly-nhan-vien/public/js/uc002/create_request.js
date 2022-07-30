var data_user = [];
var data_manager = [];
var table_ot = document.getElementById('table-ot-detail');
var table_count = 1;
var total_hours = 0;
var edit_type = false;
var edit_id   = 0;

Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});

function date_now(){
    const now = new Date();
    return new Date(now.getTime() - now.getTimezoneOffset() * 60000).toISOString().substring(0, 19);
}

function formatDate(date) {  
    return date.split("-").reverse().join("-");;
}
function update_hours(){
    total_hours = 0;
    var day = [];
    for(var i=1; i < table_count ; i++ ){
        var element = document.getElementById(`hour-ot-${i}`);
        if (element){
            total_hours += parseInt(element.value);
            day.push(document.getElementById(`date-ot-${i}`).value);
        }
    }
    day = day.sort();
    document.getElementById('start-date').value = day[0];
    document.getElementById('end-date').value = day[day.length - 1];
    document.getElementById('estimated_hours').value = total_hours;
}

function user_profile_update(data, type){
    document.getElementById(`${type}_NAME`).value = data.NAME;
    document.getElementById(`${type}_EMAIL`).value = data.EMAIL;
    document.getElementById(`${type}_DEPART_NAME`).value = data.DEPART_NAME;
    document.getElementById(`${type}_ID`).value = data.EMPLOYEE_ID; 
}

function deleteAnValue(id){
    var count = 0; 
    for(var i=1; i < table_count ; i++ ){
        var element = document.getElementById(`date-ot-${i}`);
        if (element){
            count ++;
        }
    }
    if (count == 1){
        showError("you cannot delete all ot request details");
    }else{
        document.getElementById(`colum-${id}`).remove();
        update_hours();
    }
}

function update_profile_manager(id){
    var api_get_manager = host_name + `/api_auth/get_user/${id}`;
    $.ajax({
        type: "GET",
        url: api_get_manager,
        dataType: "json",
        success: function (response) {
            data_manager = response;
            if (data_manager.success) {
                user_profile_update(data_manager.data, 'MANAGER');
            }
        }
    });
}

function update_profile_user(id){
    var api_get_user = host_name + `/api_auth/get_user/${id}`;
    $.ajax({
        type: "GET",
        url: api_get_user,
        dataType: "json",
        success: function (response) {
            data_user = response;
            if (data_user.success) {
                user_profile_update(data_user.data, 'EMPLOYEE');
                update_profile_manager(data_user.data.MANAGER_ID);
            }
        }
    });
}

function update_info_request_ot(data){
    document.getElementById('start-date').value = data.START_DATE.split(' ')[0];
    document.getElementById('end-date').value = data.END_DATE.split(' ')[0];
    document.getElementById('today-date').value = data.CREATE_DATE;
    document.getElementById('estimated_hours').value = data.ESTIMATED_HOURS;
    document.getElementById('NOTIFICATION_FLAG').value = data.NOTIFICATION_FLAG;
    document.getElementById('STATUS_REQUEST').value = data.STATUS;
    document.getElementById('OTRequest_ID').value = data.id;
    document.getElementById('REASON_EMPLOYEE').value = data.REASON;
    document.getElementById('title-modal').innerHTML = "edit OT request";
}

function reset_request_ot_detail(){
    table_ot.innerHTML = "";
    table_count = 1;
    edit_type = false;
    document.getElementById('title-modal').innerHTML = "create new OT request";
    document.getElementById('submit-btn-text').innerHTML = "Submit";
    document.getElementById('today-date').value = date_now();
    document.getElementById('start-date').value = new Date().toDateInputValue();
    document.getElementById('end-date').value = new Date().toDateInputValue();
    document.getElementById('request-date').value = new Date().toDateInputValue();
}

function insert_request_ot_detail(data){
    reset_request_ot_detail();
    for(var i=0; i < data.length; i++){
        table_ot.innerHTML += `
            <tr id="colum-${table_count}">
                <td>${formatDate(data[i].DATE)}</td>
                <td>${data[i].HOUR}</td>
                <td>
                    <i style="cursor: pointer;" onclick="deleteAnValue(${table_count})" class="fa-solid fa-trash-can"></i>
                    <i style="cursor: pointer;" onclick="editAnValue(${table_count})" class="fa-solid fa-pen"></i>
                </td>
                <input id="date-ot-${table_count}" type="hidden" name="date-ot-${table_count}" value="${data[i].DATE}">
                <input id="hour-ot-${table_count}" type="hidden" name="hour-ot-${table_count}" value="${data[i].HOUR}">
            </tr>
        `
        table_count++;
    }
    document.getElementById('number-ot').value = table_count;
    update_hours();
}

function editAnValue(id){
    edit_id = id;
    edit_type = true;
    document.getElementById("request-date").value = document.getElementById(`date-ot-${id}`).value;
    document.getElementById("request-time").value = document.getElementById(`hour-ot-${id}`).value;
    document.getElementById("submit-ot-request-detail").innerHTML = "Edit OT details";
}

function delete_ot_request(id, status){
    if (status != "Draft"){
        showError("You CAN ONLY delete OT request that has status is Draft.");
    }else{
        showDelRequest();
        OTRequest_ID = id;
    }
}

function hoursActive(){
    var date_ot = document.getElementById('request-date').value;
    var hour_ot = document.getElementById('request-time').value;
    if (check_request_ot_details(hour_ot, date_ot)){
        if (edit_type == false){
            table_ot.innerHTML += `
            <tr id="colum-${table_count}">
                    <td>${formatDate(date_ot)}</td>
                    <td>${hour_ot}</td>
                    <td>
                    <i style="cursor: pointer;" onclick="deleteAnValue(${table_count})" class="fa-solid fa-trash-can"></i>
                    <i style="cursor: pointer;" onclick="editAnValue(${table_count})" class="fa-solid fa-pen"></i>
                    </td>
                    <input id="date-ot-${table_count}" type="hidden" name="date-ot-${table_count}" value="${date_ot}">
                    <input id="hour-ot-${table_count}" type="hidden" name="hour-ot-${table_count}" value="${hour_ot}">
                </tr>
            `;
            table_count++;
            document.getElementById('number-ot').value = table_count;
        }else{
            document.getElementById(`colum-${edit_id}`).innerHTML = `
                <td>${formatDate(date_ot)}</td>
                <td>${hour_ot}</td>
                <td>
                <i style="cursor: pointer;" onclick="deleteAnValue(${edit_id})" class="fa-solid fa-trash-can"></i>
                <i style="cursor: pointer;" onclick="editAnValue(${edit_id})" class="fa-solid fa-pen"></i>
                </td>
                <input id="date-ot-${edit_id}" type="hidden" name="date-ot-${edit_id}" value="${date_ot}">
                <input id="hour-ot-${edit_id}" type="hidden" name="hour-ot-${edit_id}" value="${hour_ot}">
            `;
        }
    }
    document.getElementById('request-time').value = 1;
    update_hours();
    document.getElementById("submit-ot-request-detail").innerHTML = "Add OT details";
    edit_type = false;
}

function check_request_ot_details(hour_ot, date_ot){
    var today = new Date().toDateInputValue();
    if (hour_ot > 4 && hour_ot <= 0){
        showError("You can't enter > 4 hours/day");
        return false;
    }
    if (date_ot < today){
        console.log(today)
        console.log(date_ot)
        showError("you can't ask for the date in the past");
        return false;
    }
    for(var i=1; i < table_count ; i++ ){
        var element = document.getElementById(`date-ot-${i}`);
        if (element){
            if (edit_id != i){
                if (element.value == date_ot){
                    showError(`${date_ot} can't have 2 requests ot`);
                    return false;
                }
            }
        }
    }
    return true;
}

reset_request_ot_detail()

$(document).ready(function () {
    update_profile_user(id_user)
});

document.getElementById('submit-btn-text').addEventListener('click', function(e){
    if (document.getElementById('OTRequest_ID').value == "0"){
        document.getElementById('STATUS_REQUEST').value = "Pending";
        document.getElementById('submit-btn-save').click();
    }else{
        if (new_data.STATUS == "Pending"){
            showModalUnSubmit();
            document.getElementById('modal-unsubmit-request-text').value = "";
        }else{
            document.getElementById('STATUS_REQUEST').value = "Pending";
            document.getElementById('submit-btn-save').click();
        }
    }
})