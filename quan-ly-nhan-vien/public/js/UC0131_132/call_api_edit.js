var my_data = [];
var id_deletes = [];
var id_delete = 0;
const modal_view_goal = document.querySelector('.js-modal-view-goal')
function call_api(){
    var settings = {
        "url": "http://127.0.0.1:5000/api/uc0131_132/get-pa-goal",
        "method": "POST",
        "timeout": 0,
        "headers": {
          "Content-Type": "application/json"
        },
        "data": JSON.stringify({
          "pa_goal_id": `${pa_goal_id}`
        }),
      };
      
      $.ajax(settings).done(function (response) {
        render_data(response.data);
        my_data = response.data;
        if (my_data.length == 0){
            no_data();
        }else{
            have_data();
        }
        id_deletes = [];
        start_check_delete()
      });
}

function call_find_PA_GOAL(page){
    var settings = {
        "url": "http://127.0.0.1:5000/api/uc0131_132/get-pa-goals",
        "method": "POST",
        "timeout": 0,
        "headers": {
          "Content-Type": "application/json"
        },
        "data": JSON.stringify({
          "page": `${page}`,
          "employee_id": `${id_user}`,
          "status": []
        }),
      };
      
      $.ajax(settings).done(function (response) {
        var new_data = response.data;
        for (var i = 0; i < new_data.length; i++) {
            if (pa_goal_id == new_data[i].PAGOAL_ID){
                update_view_PA_GOAL(new_data[i]);
                break;
            }else if (response.total_records == 5){
                call_find_PA_GOAL(page + 1);
            }
        }
      });
}

document.getElementById("js-model-unsubmit").addEventListener("submit", function(e){
    e.preventDefault();
    var reasons = document.getElementById("reason-unsubmit");
    if (reasons.value != ""){
        var settings = {
            "url": "http://127.0.0.1:5000/api/uc0131_132/unsubmit",
            "method": "POST",
            "timeout": 0,
            "headers": {
            "Content-Type": "application/json"
            },
            "data": JSON.stringify({
            "pa_goal_id": `${pa_goal_id}`,
            "reason" : reasons.value
            }),
        };
        
        $.ajax(settings).done(function (response) {
            showMolAlert();
        });
    }else{
        showError("reason field cannot be empty");
    }
});

document.getElementById("modal-create-new-goal").addEventListener("submit", function (e) {
    e.preventDefault();
    var check = false;
    var datetime = new Date().toISOString().split('T')[0];

    if (document.getElementById(`due_date`).value >= datetime || document.getElementById(`complete_date`).datetime >= datetime){
        check = true;
    }else{
        showError("due date must be big now");
    }
    if (check){
        var settings = {
            "url": "http://127.0.0.1:5000/api/uc0131_132/add-goal",
            "method": "POST",
            "timeout": 0,
            "headers": {
            "Content-Type": "application/json"
            },
            "data": JSON.stringify({
                "pa_goal_id" : `${pa_goal_id}`,
                "due_date" : document.getElementById("due_date").value,
                "complete_date" : document.getElementById("complete_date").value,
                "status" : document.getElementById("status").value,
                "name" : document.getElementById("name").value,
                "action" : document.getElementById("action").value,
                "comment" : document.getElementById("comment").value
            }),
        };
        
        $.ajax(settings).done(function (response) {
            showConfOftions("add data Successfully", "a new data has been added");
            hideGoalCreate();
            reset_form_create();
            call_api();
        });
    }
});

document.getElementById("edit-modal-create-new-goal").addEventListener("submit", function (e){
    e.preventDefault();
    var check = false;
    var datetime = new Date().toISOString().split('T')[0];

    if (document.getElementById(`due_date`).value >= datetime){
        check = true;
    }else{
        showError("due date must be big now");
    }
    if (check){
        var settings = {
            "url": "http://127.0.0.1:5000/api/uc0131_132/edit-goal",
            "method": "POST",
            "timeout": 0,
            "headers": {
            "Content-Type": "application/json"
            },
            "data": JSON.stringify({
                "pa_goal_id" : `${pa_goal_id}`,
                "pa_goal_detail_id": document.getElementById("edit-id_goal_detail").value,
                "due_date" : document.getElementById("edit-due_date").value,
                "complete_date" : document.getElementById("edit-complete_date").value,
                "status" : document.getElementById("edit-status").value,
                "name" : document.getElementById("edit-name").value,
                "action" : document.getElementById("edit-action").value,
                "comment" : document.getElementById("edit-comment").value
            }),
        };
        
        $.ajax(settings).done(function (response) {
            showConfOftions("Edit an data Successfully", "an data has been updated");
            hideGoalCreate();
            hideGoalEdit();
            call_api();
        });
    }
})

function delete_goal(ids = []){
    var settings = {
        "url": "http://127.0.0.1:5000/api/uc0131_132/delete-goal",
        "method": "POST",
        "timeout": 0,
        "headers": {
        "Content-Type": "application/json"
        },
        "data": JSON.stringify({
            "pa_goal_id" : `${pa_goal_id}`,
            "pa_goal_detail_ids":ids
        }),
    };
    $.ajax(settings).done(function (response) {
        call_api();
    });
}

function get_new_goal_detail(id_goal){
    var id = id_goal.toString();
    var settings = {
        "url": "http://127.0.0.1:5000/api/uc0131_132/view-goal",
        "method": "POST",
        "timeout": 0,
        "headers": {
          "Content-Type": "application/json"
        },
        "data": JSON.stringify({
          "pa_goal_id": `${pa_goal_id}`,
          "pa_goal_detail_ids": [id]
        }),
      };
      
      $.ajax(settings).done(function (response) {
        show_edit_modal(response.data[0]);
        console.log(response.data[0])
      });
}

function change_status(){
    
    var settings = {
        "url": "http://127.0.0.1:5000/api/uc0131_132/change-status",
        "method": "POST",
        "timeout": 0,
        "headers": {
        "Content-Type": "application/json"
        },
        "data": JSON.stringify({
            "pa_goal_id" : `${pa_goal_id}`,
            "status"     : "Pending",
        }),
    };
    $.ajax(settings).done(function (response) {
        call_find_PA_GOAL(0);
    });
}

$(document).ready(function () {
    call_api();
    call_find_PA_GOAL(0);
    set_current_day();
});

function get_email_admin(){
    var my_url = `${host_name}/api_auth/get_user/${my_data[0].MANAGER_ID}`;
    $.ajax({
        type: "GET",
        url: my_url,
        dataType: "json",
        success: function (response) {
            send_mail_admin(response.data.EMAIL, id_user, name_employee);
        }
    });
}

function send_mail_admin(manager_email, id_employee, name_employee) {
    var settings = {
        "url": "http://127.0.0.1:5000/api/uc0131_132/send-email",
        "method": "POST",
        "timeout": 0,
        "headers": {
          "Content-Type": "application/json"
        },
        "data": JSON.stringify({
          "employee_id": id_employee.toString(),
          "employee_name": name_employee,
          "manager_email": manager_email
        }),
      };
      
      $.ajax(settings).done(function (response) {
        console.log(response);
      });
}