function update_view_PA_GOAL(info){
    document.getElementById("heading").innerHTML = `self assessment | deadline submit: ${formatDateShow(info.DEADLINE_PAGOAL)}`;
    document.getElementById("last-update").innerHTML = `<span style="color: black">last updated</span>: ${formatDateShow(info.LASTUPDATE_DATE)}`;
    if (info.STATUS == "Pending"){
        document.getElementById("submit-btn").innerHTML = "UnSubmit";
        document.getElementById("submit-btn").onclick = showUnsubmitForm;
    }else{
        document.getElementById("submit-btn").innerHTML = "Submit";
        document.getElementById("submit-btn").onclick = showSubmitRequest;
    }
}

function render_data(my_data){
    var main_data = document.getElementById('detail-goal-name');
    main_data.innerHTML = "";
    for (let i = my_data.length - 1; i >= 0; i--){
        main_data.innerHTML += `
            <div class="goal-name" id="goal-key-${my_data[i].PAGOALDETAIL_ID}">
                <div class="goal-name-checkbox">
                    <input type="checkbox" class="check-box-delete" value="${my_data[i].PAGOALDETAIL_ID}"">
                    <h4 style="width: calc(100% - 200px)">${my_data[i].GOAL_NAME}</h4>
                    <p class="pending">status: ${my_data[i].STATUS}</p>
                </div>
                <div class="time">
                    <p>due date: ${formatDateShow(my_data[i].DUE_DATE)}</p>
                    <p>complete date: ${formatDateShow(my_data[i].COMPLETED_DATE)}</p>
                </div>
                <div class="func">
                    <button onclick="showNewGoalCreate(${i})">see goal</button>
                    <button onclick="get_new_goal_detail(${my_data[i].PAGOALDETAIL_ID})" class="edit-error">edit goal</button>
                    <button onclick="showDelRequest(${my_data[i].PAGOALDETAIL_ID})" class="js-del-re">delete goal</button>
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
                    <select name="" id="view-status" readonly>
                        <option value="Processing">Processing</option>
                        <option value="Completed">Completed</option>
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
    document.getElementById('view-status').value = my_data[id].STATUS;
}

Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});

function set_current_day(){
    $(document).ready( function() {
        $('#due_date').val(new Date().toDateInputValue());
    });
    $(document).ready( function() {
        $('#complete_date').val("1970-01-01");
    });
}

function start_check_delete(){
    $('.check-box-delete').off('click');
    $('.check-box-delete').on('click', function(){
        var index = id_deletes.indexOf(this.value);
        if (index > -1) { // only splice array when item is found
            id_deletes.splice(index, 1); // 2nd parameter means remove one item only
        }
        if (this.checked) {
            id_deletes.push(this.value);
        }
    });
}

function reset_form_create(){
    document.getElementById("modal-create-new-goal").reset();
    set_current_day();
}

function no_data(){
    document.getElementById("action-button").style.display = "none";
    document.getElementById("nothing-content").style.display = "block";
}

function have_data(){
    document.getElementById("action-button").style.display = "block";
    document.getElementById("nothing-content").style.display = "none";
}

function formatDate(date) {
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

    return [year, month, day].join('-');
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

function show_edit_modal(new_data){
    document.getElementById("edit-modal-create-new-goal").innerHTML = `
        <h1>Edit a new goal</h1>
        <input type="hidden" name="id_goal_detail" id="edit-id_goal_detail" value="${new_data.PAGOALDETAIL_ID}">
        <div class="time">
            <div class="due-date">
                <p>due date</p>
                <input type="date" name="due_date" id="edit-due_date" value="${formatDate(new_data.DUE_DATE)}" required>
            </div>
            <div class="due-date">
                <p>completed date</p>
                <input type="date" name="complete_date" id="edit-complete_date" value="${formatDate(new_data.COMPLETED_DATE)}" required>
            </div>
            <div class="select">
                <p>status</p>
                <select name="status" id="edit-status">
                    <option value="Processing">Processing</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>
        </div>

        <div class="input-form">
            <div class="input">
                <p>goal/objects name</p>
                <input type="text" name="name" id="edit-name" placeholder="type something here" value="${new_data.GOAL_NAME}" required>
            </div>
            <div class="input">
                <p>action/steps</p>
                <input type="text" name="action" id="edit-action" placeholder="type something here" value="${new_data.ACTION_STEP}" required>
            </div>
            <div class="input">
                <p>comment</p>
                <input type="text" name="comment" id="edit-comment" placeholder="type something here" value="${new_data.COMMENT}" required>
            </div>
        </div>

        <div class="button">
            <button style="cursor: pointer;" type="submit" class="btn save">save</button>
            <a href="#" onclick="hideGoalEdit()" class="btn cancel js-cancel">cancel</a>
        </div>

        <div class="toast-save-edit">
            <i class="fa-solid fa-circle-check"></i>
            <p>save your goal successfully!</p>
        </div>
    `;
    $('.js-modal-edit-goal')[0].classList.add('open');
    document.getElementById('edit-status').value = new_data.STATUS;
}
