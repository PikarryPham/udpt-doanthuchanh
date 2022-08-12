<link rel="stylesheet" href="<?= $host_name ?>/public/css/sel_as_n_goal.css">
<link rel="stylesheet" href="<?= $host_name ?>/public/css/myPAgoal.css">
<div class="content">
    <h1>my PA goal history</h1>
    <p class="sub-heading">self assessment history</p>
    <div class="my-fb-body">
        <div class="input-line">
            <div class="year-respond">
                <p>last update by from year</p>
                <input type="number" id="date_update" min="2015" max="2025" step="1" placeholder="All Year" class="date">
            </div>

            <div class="respond-dl">
                <p>responded deadline for form by year</p>
                <input type="number" id="date_deadline" min="2015" max="2025" step="1" placeholder="All Year" class="date">
            </div>
        </div>

        <div class="show-status">
            <p>show feedback with status</p>
            <div class="squarecheck">
                <label for="squarecheck1">all</label>
                <input type="checkbox" name="check" id="squarecheck1">
            </div>
            <div class="squarecheck">
                <label for="squarecheck2">Approved</label>
                <input type="checkbox" name="check" class="check_con" id="squarecheck2">
            </div>
            <div class="squarecheck">
                <label for="squarecheck3">Rejected</label>
                <input type="checkbox" name="check" class="check_con" id="squarecheck3">
            </div>
            <div class="squarecheck">
                <label for="squarecheck4">Cancelled</label>
                <input type="checkbox" name="check" class="check_con" id="squarecheck4">
            </div>
            <div class="squarecheck">
                <label for="squarecheck5">Pendinng approval</label>
                <input type="checkbox" name="check" class="check_con" id="squarecheck5">
            </div>
            <div class="squarecheck">
                <label for="squarecheck6">Draft</label>
                <input type="checkbox" name="check" class="check_con" id="squarecheck6">
            </div>
        </div>

        <div class="func-button">
            <button onclick="search_data()" class="btn">search</button>
            <button onclick="reset_all()" class="btn">reset all</button>
        </div>
    </div>
    <div class="pa-goal">
        <div class="header">
            <h4>history</h4>
            <div class="header-page">
                <i onclick="change_page(-1)" style="cursor:pointer" class="fa-solid fa-angle-left"></i>
                <p>
                    <span id="current_page">1</span>
                    <span>/</span>
                    <span id="end_page">1</span>
                </p>
                <i onclick="change_page(1)" style="cursor:pointer" class="fa-solid fa-angle-right"></i>
            </div>
        </div>
        <table id="history">
            <tbody>
                <tr>
                    <th>PAGoalForm_id</th>
                    <th>total goals</th>
                    <th>deadline date</th>
                    <th>last updated date</th>
                    <th>status</th>
                    <th>manager ID</th>
                    <th>rejected reason (if any)</th>
                    <th>action</th>
                </tr>
            </tbody>
            <tbody id="data-history">
            </tbody>
        </table>
        <div class="nothing-content" style="margin-top: 20px; margin-left: 50%; transform: translateX(-30%);" id="nothing-content">
            <img src="<?= $host_name ?>/public/img/image/oh crap.png" width="300" height="210" alt="">
            <p>Couldn't find any records. You can search again</p>
        </div>
    </div>
</div>

<div class="modal-edit-error js-modal-edit-error">
    <div class="modal-contain js-modal-contain-edit-error">
            <div class="modal-close js-modal-close-edit-error">
                <i onclick="hideError()" style="cursor:pointer" class="fa-solid fa-xmark"></i>
            </div>
        <div class="modal-content">
            <i class="fa-regular fa-circle-xmark"></i>
            <p id="content-error-alert" style="text-transform: none;">You cannot edit or submit your PA Goal Form anymore because time for your Self-Assessment request is overdue</p>
        </div>
    </div>
</div>



<script src="<?= $host_name ?>/public/js/UC0131_132/main_function.js"></script>
<script src="<?= $host_name ?>/public/js/UC0131_132/call_api.js"></script>
<!-- <script src="<?= $host_name ?>/public/js/UC0131_132/provi_fb.js"></script> -->