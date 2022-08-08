const root = document.getElementById('root');
var type = "EMPLOYEE_ID";
var page = 1;
var one_page = 5;
var all_page = 0;
var url_get_main = api_uc002 + `/ot_requests&${type}=${id_user}`
var new_data = [];
var OTRequest_ID = 0;
const formRequest = document.getElementById('form-post-request');

var data_request_ot = [];

function update_page(){
    var pass_page = (page-1)*one_page;
    url_get_main = api_uc002 + `/ot_requests&${type}=${id_user}&limit=${one_page}&offset=${pass_page}`;
}

function edit_page(data_page){
    var all_columns = data_page.count;
    all_page = Math.ceil(all_columns / one_page);
    if (page > all_page){
        page = all_page;
    }
    document.getElementById("current_page").textContent = page.toString();
    document.getElementById("all_page").textContent = all_page.toString();
}

function next_page(type){
    if (type == "up"){
        var action = 1;
    }else if (type == "down"){
        var action = -1;
    }
    page += action;
    if (page <= all_page && page > 0){
        update_page();
        generate_data_from_request();
    }else{
        page -= action; 
    }
}

update_page();

function generate_data(data = []){
    root.innerHTML = `
    <div class="history">
        <div class="header">
            <h4></h4>
            <div class="header-page">
                <i onclick="next_page('down')" class="fa-solid fa-angle-left" style="cursor: pointer;"></i>
                <span id="current_page">1</span>
                <span> / </span>
                <span id="all_page">1</span>
                <i onclick="next_page('up')" class="fa-solid fa-angle-right" style="cursor: pointer;"></i>
            </div>
        </div>
        <table style="background-color: white" id="history">
            <tr>
                <th>OTRequest_ID</th>
                <th>Total Hours</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>date created</th>
                <th>manager id</th>
                <th>rejected reason (if any)</th>
                <th>action</th>
            </tr>
        </table> 
    </div>`;
    for (var i = 0; i < data.length; i++){
        document.getElementById('history').innerHTML += `
        <tr>
            <td>${data[i].id}</td>
            <td>${data[i].ESTIMATED_HOURS}</td>
            <td>${data[i].START_DATE}</td>
            <td>${data[i].END_DATE}</td>
            <td class="${data[i].STATUS}">${data[i].STATUS}</td>
            <td>${data[i].CREATE_DATE}</td>
            <td>${data[i].MANAGER_ID}</td>
            <td>${data[i].MANAGER_COMMENT}</td>
            <td class="action-area">
                <i onclick="delete_ot_request('${data[i].id}', '${data[i].STATUS}')" class="fa-solid fa-trash-can js-trash js-del-re"></i>
                <i onclick="edit_ot_request(${data[i].id},'${data[i].STATUS}')" class="fa-solid fa-pen js-fix"></i>
            </td>
        </tr>
        `;
    }
    edit_page(data_request_ot.data.metadata.resultset);
}

function edit_ot_request(id, status){
    var url_get = `${api_uc002}/ot_request/${id}`;
    if (status == "Draft" || status == "Pending"){
        $.ajax({
            type: "GET",
            url: url_get,
            data: "data",
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    new_data = response.data;
                    update_profile_manager(new_data.MANAGER_ID);
                    insert_request_ot_detail(new_data.OTRequestDetails);
                    update_info_request_ot(new_data);
                    if (new_data.STATUS == "Pending"){
                        document.getElementById('submit-btn-text').innerHTML = "Unsubmit";
                    }
                    document.getElementById('OTRequest_ID').value = id;
                    modal_new_rq.classList.add('open');
                    document.getElementById('title-modal').innerHTML = "edit OT request";
                }
            }
        });
    }else{
        showError("You CAN ONLY edit OT request that has status is Draft or Pending");
    }
}

function delete_an_request_ot(id){
    var url_get = `${api_uc002}/destroy_request_ot/${id}`;
    if (document.getElementById("NOTIFICATION_FLAG").value == "1"){
        var id_employee     = document.getElementById('EMPLOYEE_ID').value;
        var name_employee   = document.getElementById('EMPLOYEE_NAME').value;
        var email_employee  = document.getElementById('EMPLOYEE_EMAIL').value;
        var id_OTRequest    = id;
        var action2         = "Xóa";
        send_mail_employee(id_employee, name_employee, email_employee, id_OTRequest, action2, "Không thể cung cấp nội dung khi đã xóa");
    }
    $.ajax({
        type: "GET",
        url: url_get,
        dataType: "json",
        success: function (response) {
            if (response.success){
                generate_data_from_request(false);
            }
        }
    });
}

function generate_data_from_request(check){
    $.ajax({
        type: "GET",
        url: url_get_main,
        data: "data",
        dataType: "json",
        success: function (response) {
            data_request_ot = response;
            if (data_request_ot.success) {
                generate_data(data_request_ot.data.value);
            }else{
                root.innerHTML = `
                    <img src="${host_name}/public/img/image/oh crap.png" width="420" height="300" alt="">
                    <p>you don't have any OT request. you can create a new one!</p>
                `;
            }
        }
    });
}

$(document).ready(function () {
    generate_data_from_request(false);
});

formRequest.addEventListener('submit', function (e) {
    e.preventDefault();
    var id = document.getElementById('OTRequest_ID').value;
    var values = $(this).serialize();
    var status = document.getElementById('STATUS_REQUEST').value;
    if (document.getElementById('estimated_hours').value != '0'){
        if (id == 0){
            var url_post = `${api_uc002}/create_ot`;
            $.ajax({
                type: "POST",
                url: url_post,
                data: values,
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        generate_data_from_request(false);
                        if (status == "Pending"){
                            edit_ot_request(response.data["ROT_ID"], "Pending");
                            showNotification("Submit successfully", "Congratulations! You submit the OT request successfully. You can go back to main to see the request.");
                            var id_employee     = document.getElementById('EMPLOYEE_ID').value;
                            var name_employee   = document.getElementById('EMPLOYEE_NAME').value;
                            var name_manager    = document.getElementById('MANAGER_NAME').value;
                            var email_manager   = document.getElementById('MANAGER_EMAIL').value;
                            send_mail_manager(id_employee, name_employee, name_manager, email_manager);
                        }else{
                            edit_ot_request(response.data["ROT_ID"], "Draft");
                            showNotification("save successfully", "Congratulations! You save the OT request successfully. You can go back to main to see the request.");
                        }
                        if (document.getElementById("NOTIFICATION_FLAG").value == "1"){
                            var id_employee     = document.getElementById('EMPLOYEE_ID').value;
                            var name_employee   = document.getElementById('EMPLOYEE_NAME').value;
                            var email_employee  = document.getElementById('EMPLOYEE_EMAIL').value;
                            var id_OTRequest    = document.getElementById('OTRequest_ID').value;
                            var action1         = document.getElementById('STATUS_REQUEST').value;
                            var action2         = "Tạo mới"
                            send_mail_employee(id_employee, name_employee, email_employee, response.data["ROT_ID"], action2, get_content_ot_request(action1));
                        }
                    }
                }
            });
        }else{
            var url_post = `${api_uc002}/edit_request_ot/${id}`;
            $.ajax({
                type: "POST",
                url: url_post,
                data: values,
                dataType: "json",
                success: function (response) {
                    if (new_data.STATUS == "Draft"){
                        var id_employee     = document.getElementById('EMPLOYEE_ID').value;
                        var name_employee   = document.getElementById('EMPLOYEE_NAME').value;
                        var name_manager    = document.getElementById('MANAGER_NAME').value;
                        var email_manager   = document.getElementById('MANAGER_EMAIL').value;
                        send_mail_manager(id_employee, name_employee, name_manager, email_manager);
                        showNotification("Submit successfully", "Congratulations! You submit the OT request successfully. You can go back to main to see the request.");
                    }else{
                        showNotification("save successfully", "Congratulations! You save the OT request successfully. You can go back to main to see the request.");
                    }

                    var id_employee     = document.getElementById('EMPLOYEE_ID').value;
                    var name_employee   = document.getElementById('EMPLOYEE_NAME').value;
                    var email_employee  = document.getElementById('EMPLOYEE_EMAIL').value;
                    var id_OTRequest    = document.getElementById('OTRequest_ID').value;
                    var action1         = document.getElementById('STATUS_REQUEST').value;
                    var action2         = "Chỉnh sửa"
                    var OTRequest_ID    = document.getElementById('OTRequest_ID').value;

                    send_mail_employee(id_employee, name_employee, email_employee, OTRequest_ID, action2, get_content_ot_request(action1));

                    edit_ot_request(new_data.ROT_ID, new_data.STATUS);
                    generate_data_from_request(false);
                }
            });
        }
    }else{
        showError("The ot request details part cannot be left blank");
    }
});

document.getElementById('model-unsubmit-request').addEventListener('submit', function (e) {
    e.preventDefault();
    var id = new_data.ROT_ID;;
    var url_post = `${api_uc002}/canceled_request_ot/${id}`;
    var values = $(this).serialize();
    $.ajax({
        type: "POST",
        url: url_post,
        data: values,
        dataType: "json",
        success: function (response) {
            generate_data_from_request(false);
            reset_request_ot_detail();
            hiddenModalUnSubmit();
            hideNewOTRequest();
            showNotification("Unsubmit successfully", "Congratulations! You have unsubmit request successfully. We have emailed to your appraiser about your unsubmission.")
        }
    });
    if (document.getElementById("NOTIFICATION_FLAG").value == "1"){
        var id_employee     = document.getElementById('EMPLOYEE_ID').value;
        var name_employee   = document.getElementById('EMPLOYEE_NAME').value;
        var email_employee  = document.getElementById('EMPLOYEE_EMAIL').value;
        var id_OTRequest    = document.getElementById('OTRequest_ID').value;
        var action1         = 'Canceled';
        var action2         = "Hủy đăng kí";
        send_mail_employee(id_employee, name_employee, email_employee, id_OTRequest, action2, get_content_ot_request(action1));
    }
})