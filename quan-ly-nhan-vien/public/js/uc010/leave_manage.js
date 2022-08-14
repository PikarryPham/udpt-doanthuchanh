// Js for My leave page
var page = 1;
var per_page = 5;
var all_page = 0;
var url_get_leave_request = api_uc010 + `/get-leave-requests?employee_id=${id_user}`;
var leave_history_id = 0;
var leave_types = {
    1: 'Annual Leave',
    2: 'Personal Leave',
    3: 'Compensation Leave',
    4: 'Sick Leave (Non-paid)',
    5: 'Non-paid Leave',
    6: 'Maternity Leave (Non-paid)',
    7: 'Engagement Ceremony',
    8: 'Wedding Leave',
    9: 'Relative Funeral Leave',
}
var data_leave_histories = [];
var formData = {
    leave_from: '',
    leave_to: '',
    leave_type: 0,
    leave_status: [],
}

const root_leave_history = document.getElementById('root-leave-history');
const root_summary = document.getElementById('root-summary');
const leave_his = document.querySelector('.leave-history');
const summary = document.querySelector('.summary');
const js_leaves = document.querySelectorAll('.js-leave-his');
const js_summaries = document.querySelectorAll('.js-summary');

const modalContainer = document.querySelector('.js-modal-contain');
const btn1 = document.querySelector('.btn1');
const btn2 = document.querySelector('.btn2');

for (const js_summary of js_summaries) {
    js_summary.addEventListener('click', showSummary);
}

for (const js_leave of js_leaves) {
    js_leave.addEventListener('click', showLeaveManagement);
}

modalContainer.addEventListener('click', function (even) {
    even.stopPropagation();
})

function showLeaveManagement() {
    leave_his.classList.toggle('open');
    leave_his.classList.remove('hidden');
    document.getElementById('btn-leave').style.backgroundColor = "var(--green)";
    document.getElementById('btn-leave').style.color = "var(--white)";
    document.getElementById('content-body').style.backgroundColor = "var(--nav)";
    btn1.classList.add('open');
    btn2.classList.remove('open');
    summary.classList.remove('open');
    get_leave_histories();
}

function showSummary() {
    summary.classList.add('open');
    btn2.classList.add('open');
    btn1.classList.remove('open');
    document.getElementById('btn-leave').style.backgroundColor = "var(--primary-lighter)";
    document.getElementById('btn-leave').style.color = "var(--black)";
    leave_his.classList.remove('open');
    leave_his.classList.toggle("hidden");
    get_data_summaries();
}

// Js for Delete request
const modal_del_re = document.querySelector('.js-modal-del-re');
const modal_del_co = document.querySelector('.js-modal-del-co');
const modalContainer_res = document.querySelector('.js-modal-contain-re');
const modalContainer_cos = document.querySelector('.js-modal-contain-co');
const modal_error = document.querySelector('.js-modal-error');
const modalClose_er = document.querySelector('.js-modal-close')
const modalClose_del_res = document.querySelectorAll('.js-modal-close-del-re');
const modalClose_del_cos = document.querySelectorAll('.js-modal-close-del-co');

for (const modal_close_del_re of modalClose_del_res) {
    modal_close_del_re.addEventListener('click', hideDelRequest);
}

for (const modal_close_del_co of modalClose_del_cos) {
    modal_close_del_co.addEventListener('click', hideDelConfirm);
}

modalContainer_res.addEventListener('click', function (even) {
    even.stopPropagation();
})

modalContainer_cos.addEventListener('click', function (even) {
    even.stopPropagation();
})

modalClose_er.addEventListener('click', hideError);

function showError () {
    modal_error.classList.add('open')
}

function hideError () {
    modal_error.classList.remove('open')
}

function showDelRequest() {
    modal_del_re.classList.add('open');
}

function showDelConfirm() {
    modal_del_co.classList.add('open');
    modal_del_re.classList.remove('open');
}

function hideDelRequest() {
    modal_del_re.classList.remove('open');
}

function hideDelConfirm() {
    modal_del_co.classList.remove('open');
}

function get_leave_histories() {
    $.ajax({
        type: 'GET',
        url: url_get_leave_request,
        dataType: 'json',
        success: function (response) {
            console.log(response);
            data_leave_histories = response;
            if (response.success && response.data.length) {
                generate_data(response.data);
            } else {
                root_leave_history.innerHTML = `
                    <img src="${host_name}/public/img/image/oh crap.png" width="420" height="300" alt="">
                    <p>you don't have any leave request.</p>
                `;
            }
        },
        error: function () {
            root_leave_history.innerHTML = `
                <img src="${host_name}/public/img/image/oh crap.png" width="420" height="300" alt="">
                <p>you don't have any leave request.</p>
            `;
        }
    });
}

function update_page(formData) {
    url_get_leave_request = api_uc010 + `/get-leave-requests?employee_id=${id_user}&leave_from=${formData.leave_from}&leave_to=${formData.leave_to}&leave_type=${formData.leave_type}&status=${formData.leave_status}&limit=${per_page}&page=${page - 1}`;
}

function next_back_page(type) {
    if (type == "next") {
        var action = 1;
    } else if (type == "back") {
        var action = -1;
    }

    page += action;
    if (page <= all_page && page > 0) {
        update_page(formData);
        get_leave_histories();
    } else {
        page -= action;
    }
}

function edit_number_total_page(page_count) {
    all_page = Math.ceil(page_count / per_page);

    if (page > all_page) {
        page = all_page;
    }

    document.getElementById("current_page").textContent = page.toString();
    document.getElementById("all_page").textContent = all_page.toString();
}

function generate_data(data = []) {
    root_leave_history.innerHTML = `
    <div class="history">
        <div class="header">
            <h4>history</h4>
            <div class="header-page">
                <i onclick="next_back_page('back')" class="fa-solid fa-angle-left" style="cursor: pointer;"></i>
                <span id="current_page" style="padding:0 5px;">1</span>
                <span> / </span>
                <span id="all_page" style="padding:0 5px;">1</span>
                <i onclick="next_back_page('next')" class="fa-solid fa-angle-right" style="cursor: pointer;"></i>
            </div>
        </div>
        <table style="background-color: white" id="history">
            <tr>
                <th>Employee Id</th>
                <th>Leave Type</th>
                <th>Leave From</th>
                <th>Leave To</th>
                <th>Status</th>
                <th>Date Created</th>
                <th>Manager Id</th>
                <th>Rejected Reason (If Any)</th>
                <th>Action</th>
            </tr>
        </table> 
    </div>`;
    for (var i = 0; i < data.length; i++) {
        document.getElementById('history').innerHTML += `
        <tr>
            <td>${data[i].EMPLOYEE_ID}</td>
            <td>${leave_types[data[i].LEAVE_TYPE]}</td>
            <td>${formatDate(data[i].LEAVE_FROM)}</td>
            <td>${formatDate(data[i].LEAVE_TO)}</td>
            <td class="${data[i].STATUS}">${data[i].STATUS}</td>
            <td>${formatDate(data[i].CREATE_DATE)}</td>
            <td>${data[i].MANAGER_ID}</td>
            <td>${data[i].MANAGER_COMMENT || ''}</td>
            <td class="action-area">
                <i onclick="delete_leave_request('${data[i].RLEAVE_ID}', '${data[i].STATUS}')" class="fa-solid fa-trash-can js-trash js-del-re"></i>
            </td>
        </tr>
        `;
    }

    edit_number_total_page(data_leave_histories.total);
}

function generate_data_summary(data = []) {
    var leave_types_data = data.leave_types;
    var leave_type_histories_data = data.leave_type_histories;

    root_summary.innerHTML = `
    <table id="summary">
        <tr>
            <th>Leave Type</th>
            <th>Total Day(S)</th>
            <th>Used Day(S)</th>
            <th>Remaining Days</th>
        </tr>
    </table>`;
    for (var i = 0; i < leave_types_data.length; i++) {
        document.getElementById('summary').innerHTML += `
        <tr>
            <td>${leave_types_data[i][1]}</td>
            <td>${parseInt(leave_types_data[i][2])}</td>
            <td>${leave_type_histories_data[leave_types_data[i][0]] ? parseInt(leave_type_histories_data[leave_types_data[i][0]][2]) : 0}</td>
            <td>${leave_type_histories_data[leave_types_data[i][0]] ? parseInt(leave_types_data[i][2]) - parseInt(leave_type_histories_data[leave_types_data[i][0]][2]) : parseInt(leave_types_data[i][2])}</td>
        </tr>
        `;
    }
}

function delete_leave_request(id, status) {
    if (status != "Draft") {
        showError();
    } else {
        showDelRequest();
        leave_history_id = id;
    }
}

function delete_an_request_leave() {
    $.ajax({
        type: "DELETE",
        url: `${api_uc010}/delete-a-request?rleave_id=${leave_history_id}`,
        success: function (response) {
            if (response.success) {
                showDelConfirm();
                get_leave_histories();
                update_leave_history(response.data);
            }
        },
        error: function (e) {
            console.log(e);
        }
    });
}

function update_leave_history(data) {
    $.ajax({
        type: 'POST',
        url: api_uc010_update_history,
        data: {
            employee_id: data[1],
            leave_typeid: data[4],
            create_date: formatDate(data[8], 'Y'),
            number_days: data[3],
        },
        success: function (response) {
            console.log(response);
        },
        error: function (e) {
            console.log(e);
        }
    });
}

$(document).ready(function () {
    update_page(formData);
    get_leave_histories();
});

$('#form-leave-history').on('submit', function (e) {
    e.preventDefault();

    var form = $(this), data = {};
    form.find('[name]').each(function() {
        var input = $(this), name = input.attr('name');
        data[name] = input.val();
    });

    var checkboxValues = [];
    $('input[name=leave_status]:checked').map(function() {
        checkboxValues.push($(this).val());
    });

    data['leave_status'] = checkboxValues;
    formData = data;
    console.log(formData);

    update_page(formData);
    get_leave_histories();
});

$('.js-delete-confirm').on('click', function () {
    delete_an_request_leave();
});

// Js for summary
function get_data_summaries(year = '2015') {
    $.ajax({
        type: 'POST',
        url: api_uc010_summary,
        data: {
            year: year
        },
        success: function (response) {
            console.log(response);
            if (response.success && response.data.leave_types.length) {
                generate_data_summary(response.data);
            } else {
                root_summary.innerHTML = `
                    <img src="${host_name}/public/img/image/oh crap.png" width="420" height="300" alt="">
                    <p>you don't have any leave request.</p>
                `;
            }
        },
        error: function () {
            root_summary.innerHTML = `
                <img src="${host_name}/public/img/image/oh crap.png" width="420" height="300" alt="">
                <p>you don't have any leave request.</p>
            `;
        }
    });
}

function onChangeYear(ev) {
    get_data_summaries($(ev).val());
}

// JS for common
function formatDate(date, type = 'dmY') {
    var d = new Date(date), month = '', day = '', year = '';

    month = (d.getMonth() + 1).toString();
    day = d.getDate().toString();
    year = d.getFullYear();

    if (month.length < 2) {
        month = '0' + month;
    }

    if (day.length < 2) {
        day = '0' + day;
    }

    if (type == 'dmY') {
        return [day, month, year].join('/');
    } else if (type == 'mY') {
        return [month, year].join('/');
    } else if (type == 'Y') {
        return year;
    }
}