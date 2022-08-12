var my_data = [];
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
        console.log(response);
      });
}

function no_data(){
    document.getElementById("action-button").style.display = "none";
    document.getElementById("nothing-content").style.display = "block";
}

function have_data(){
    document.getElementById("action-button").style.display = "block";
    document.getElementById("nothing-content").style.display = "none";
}

function formatDateShow(date) {
    var new_date = date.split(' ');
    var new_Date2 = "";
    for (let i = 0; i < 4 ; i++){
        new_Date2 += new_date[i] + ' ';
    }
    var d = new Date(new_Date2),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();
    
    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return `${[year, month, day].join('-')} ${date.split(' ')[4]}`;
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
          "status": [],
          limit: 100,
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

function update_view_PA_GOAL(info){
    document.getElementById("heading").innerHTML = `self assessment | deadline submit: ${formatDateShow(info.DEADLINE_PAGOAL)}`;
    document.getElementById("last-update").innerHTML = `<span style="color: black">last updated</span>: ${formatDateShow(info.LASTUPDATE_DATE)}`;
}

function render_data(my_data){
    var main_data = document.getElementById('detail-goal-name');
    main_data.innerHTML = "";
    for (let i = my_data.length - 1; i >= 0; i--){
        main_data.innerHTML += `
            <div class="goal-name">
                <div class="goal-name-checkbox">
                    <input type="checkbox" name="" id="">
                    <h4 style="width: calc(100% - 200px)">${my_data[i].GOAL_NAME}</h4>
                    <p class="pending">status: ${my_data[i].STATUS}</p>
                </div>
                <div class="time">
                    <p>due date: ${formatDateShow(my_data[i].DUE_DATE)}</p>
                    <p>complete date: ${formatDateShow(my_data[i].COMPLETED_DATE)}</p>
                </div>
                <div class="func">
                    <button onclick="showNewGoalCreate(${i})">see goal</button>
                    <button class="edit-error" style="cursor: not-allowed;>edit goal</button>
                    <button class="js-del-re" style="cursor: not-allowed;>delete goal</button>
                </div>
            </div>
        `;
    }
}

function edit_model(id){
    document.getElementById('model-view').innerHTML = `
        <div class="modal-contain js-modal-contain-new-goal">
            <h1>see a goal</h1>
            <div class="time">
                <div class="due-date">
                    <p>due date</p>
                    <input type="text" name="" id="" value="${formatDateShow(my_data[id].DUE_DATE)}" readonly>
                </div>
                <div class="due-date">
                    <p>completed date</p>
                    <input type="text" name="" id="" value="${formatDateShow(my_data[id].COMPLETED_DATE)}" readonly>
                </div>
                <div class="select">
                    <p>status</p>
                    <select name="" id="" readonly>
                        <option value=""">${my_data[id].STATUS}</"option>
                    </select>
                </div>
            </div>

            <div class="input-form">
                <div class="input">
                    <p>goal/objects name</p>
                    <input type="text" value="${my_data[id].GOAL_NAME}" placeholder="type something here" readonly>
                </div>
                <div class="input">
                    <p>action/steps</p>
                    <input type="text" value="${my_data[id].ACTION_STEP}" placeholder="type something here" readonly>
                </div>
                <div class="input">
                    <p>comment</p>
                    <input type="text" value="${my_data[id].COMMENT}" placeholder="type something here" readonly>
                </div>
            </div>

            <div class="button">
                <a href="#" onclick="hideNewGoalCreate()" class="btn cancel js-cancel">cancel</a>
            </div>
        </div>
    `;
}

function showNewGoalCreate (id) {
    edit_model(id);
    modal_view_goal.classList.add('open')
}

function hideNewGoalCreate () {
    modal_view_goal.classList.remove('open')
}

$(document).ready(function () {
    call_api();
    call_find_PA_GOAL(0);
});