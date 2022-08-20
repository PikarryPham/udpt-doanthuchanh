const modal_edit_eror = document.querySelector('.js-modal-edit-error');

function page_check(){
    if (page + 1 > all_page){
        page = all_page - 1;
    }
    if (page < 0){
        page = 0;
    }
    document.getElementById("current_page").textContent = `${page + 1}`;
    document.getElementById("end_page").textContent     = `${all_page}`;
}
function change_page(type){
    var new_page = page + type;
    var call = false;
    if (new_page >= 0 && new_page + 1 <= all_page){
        page = new_page;
        call = true;
    }
    if (call){
        call_data_My_PA_Goal();
    }
}

function search_data(){
    page = 0;
    call_data_My_PA_Goal();
}

function null_data_My_PA_Goal(){
    document.getElementById("data-history").innerHTML = "";
    document.getElementById("nothing-content").style.display = "block";
    document.getElementById("current_page").textContent = `0`;
    document.getElementById("end_page").textContent     = `0`;
}

function render_data(data){
    document.getElementById("data-history").innerHTML = "";
    document.getElementById("nothing-content").style.display = "none";
    for(var i = 0 ; i < data.length ; i++){
        document.getElementById("data-history").innerHTML += `
            <tr>
                <td>${data[i].PAGOAL_ID}</td>
                <td>${data[i].TOTAL_GOALS}</td>
                <td>${formatDateShow(data[i].DEADLINE_PAGOAL)}</td>
                <td>${formatDateShow(data[i].LASTUPDATE_DATE)}</td>
                <td class="${data[i].STATUS}">${data[i].STATUS}</td>
                <td>${data[i].MANAGER_ID}</td>
                <td>${data[i].MANAGER_COMMENT}</td>
                <td class="action-area">
                    <a href="${host_name}/UC0131_132/self_result_view/${data[i].PAGOAL_ID}">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                    <i onclick="edit_PA('${data[i].PAGOAL_ID}','${data[i].STATUS}','${data[i].DEADLINE_PAGOAL}')" class="fa-solid fa-pen js-fix"></i>
                </td>
            </tr>
        `;
    }
}

function get_status(){
    var all_status = ["Approved", "Rejected", "Cancelled", "Pending", "Draft"];
    var status = [];
    if (document.getElementById(`squarecheck1`).checked == false){
        for (var i = 0; i < all_status.length; i++){
            if (document.getElementById(`squarecheck${i + 2}`).checked){
                status.push(all_status[i]);
            }
        }
    }
    return status;
}
document.getElementById("squarecheck1").addEventListener("click", function(){
    if (document.getElementById(`squarecheck1`).checked){
        for (var i = 0; i < 5; i++){
            document.getElementById(`squarecheck${i + 2}`).checked = true;
        }
    }else{
        for (var i = 0; i < 5; i++){
            document.getElementById(`squarecheck${i + 2}`).checked = false;
        }
    }
});
$(".check_con").click(function(){
    if (this.checked == false){
        document.getElementById(`squarecheck1`).checked = false;
    }
    var count = 0;
    for (var i = 0; i < 5; i++){
        if(document.getElementById(`squarecheck${i + 2}`).checked){
            count++;
        }
    }
    if (count == 5){
        document.getElementById(`squarecheck1`).checked = true;
    }
})

function setting_ajax(){
    var my_url = `${uc0131_132}/get-pa-goals`;
    var settings
    settings = {
        url: "https://damp-shelf-80253.herokuapp.com/api/uc0131_132/get-pa-goals",
        method: "POST",
        timeout: 0,
        headers: {
          "Content-Type": "application/json",
        },
        data: JSON.stringify({
          employee_id: id_user,
          page: page,
          status: get_status(),
          limit: limit_page
        }),
      };
    var date_update   = document.getElementById("date_update").value;
    var date_deadline = document.getElementById("date_deadline").value;
    if (date_update != ''){
        settings = {
            url: "https://damp-shelf-80253.herokuapp.com/api/uc0131_132/get-pa-goals",
            method: "POST",
            timeout: 0,
            headers: {
              "Content-Type": "application/json",
            },
            data: JSON.stringify({
              employee_id: id_user,
              page: page,
              status: get_status(),
              last_update: date_update,
              limit: limit_page
            }),
          };
    }
    if (date_deadline != 0){
        settings = {
            url: "https://damp-shelf-80253.herokuapp.com/api/uc0131_132/get-pa-goals",
            method: "POST",
            timeout: 0,
            headers: {
              "Content-Type": "application/json",
            },
            data: JSON.stringify({
              employee_id: id_user,
              page: page,
              status: get_status(),
              deadline: date_deadline,
              limit: limit_page
            }),
          };
    }
    if (date_deadline != '' && date_update != ''){
        settings = {
            url: "https://damp-shelf-80253.herokuapp.com/api/uc0131_132/get-pa-goals",
            method: "POST",
            timeout: 0,
            headers: {
              "Content-Type": "application/json",
            },
            data: JSON.stringify({
              employee_id: id_user,
              page: page,
              status: get_status(),
              last_update: date_update,
              deadline: date_deadline,
              limit: limit_page
            }),
          };
    }
    return settings;
}

function reset_all(){
    document.getElementById("date_update").value = '';
    document.getElementById("date_deadline").value = '';
    document.getElementById("squarecheck1").checked = true;
    document.getElementById("squarecheck1").click();
    call_data_My_PA_Goal();
}

function edit_PA(url, status, deadline){

    var date_now = new Date().toLocaleString();
    var check = true;
    if (status == "Pending" || status == "Draft"){
        check = true;
    }else{
        check = false;
        showError("You cannot edit your PA Goal Form anymore because your PA Goal Form’s status is not Pending or Draft");
    }
    if (formatDate(new Date()) > formatDate(deadline)){
        check = false;
        showError("You cannot edit your PA Goal Form anymore because time for your Self-Assessment request is overdue");
    }
    if (check){
        var my_url = `${host_name}/UC0131_132/self_result/${url}`;
        window.location.assign(my_url);
    }
}

function showError (content) {
    modal_edit_eror.classList.add('open')
    document.getElementById("content-error-alert").innerHTML = content;
}

function hideError () {
    modal_edit_eror.classList.remove('open')
}

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();
    
    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('/');
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