<link rel="stylesheet" href="<?= $host_name ?>/public/css/myLeave.css">
<link rel="stylesheet" href="<?= $host_name ?>/public/css/navbar.css">

<div class="content">
    <div class="content-header">
        <div class="header">
            <h1 class="heading">my leave</h1>
            <div class="button-list">
                <p class="btn1 js-leave-his" id="btn-leave">leave history</p>
                <p class="btn2 js-summary">summary</p>
            </div>
        </div>
    </div>
    <div class="content-body leave-history" id="content-body">
        <div class="js-modal-contain">
            <h4 class="search-leavinf">search leave information</h4>
            <form id="form-leave-history" action="" method="get" onsubmit="return false;">
                <div class="content-body-leave">
                    <div class="leave-from">
                        <p>leave from</p>
                        <input type="date" name="leave_from">
                    </div>

                    <div class="leave-to">
                        <p>leave to</p>
                        <input type="date" name="leave_to">
                    </div>

                    <div class="leave-type">
                        <p>leave type</p>
                        <select id="leave-type" name="leave_type">
                            <option value="0">All New Types</option>
                            <option value="1">Annual Leave</option>
                            <option value="2">Personal Leave</option>
                            <option value="3">Compensation Leave</option>
                            <option value="4">Sick Leave (Non-paid)</option>
                            <option value="5">Non-paid Leave</option>
                            <option value="6">Maternity Leave (Non-paid)</option>
                            <option value="7">Engagement Ceremony</option>
                            <option value="8">Wedding Leave</option>
                            <option value="9">Relative Funeral Leave</option>
                        </select>
                    </div>
                </div>

                <div class="show-leave-status">
                    <p>show leave with status</p>
                    <div class="squarecheck">
                        <label for="squarecheck2">approved</label>
                        <input type="checkbox" name="leave_status" value="Approved" id="squarecheck2">
                    </div>
                    <div class="squarecheck">
                        <label for="squarecheck3">rejected</label>
                        <input type="checkbox" name="leave_status" value="Rejected" id="squarecheck3">
                    </div>
                    <div class="squarecheck">
                        <label for="squarecheck4">cancelled</label>
                        <input type="checkbox" name="leave_status" value="Cancelled" id="squarecheck4">
                    </div>
                    <div class="squarecheck">
                        <label for="squarecheck5">pending</label>
                        <input type="checkbox" name="leave_status" value="Pending" id="squarecheck5">
                    </div>
                    <div class="squarecheck">
                        <label for="squarecheck6">draft</label>
                        <input type="checkbox" name="leave_status" value="Draft" id="squarecheck6">
                    </div>
                </div>

                <div class="func-button">
                    <button type="submit" class="btn">search</button>
                    <button type="reset" class="btn">reset all</button>
                </div>
            </form>

            <div id="root-leave-history"></div>
        </div>
    </div>

    <div class="content-body summary">
        <div class="js-modal-contain">
                <select name="year" id="year" onchange="onChangeYear(this);">
                <option value="2015">by 2015</option>
                <option value="2016">by 2016</option>
                <option value="2017">by 2017</option>
                <option value="2018">by 2018</option>
                <option value="2019">by 2019</option>
                <option value="2020">by 2020</option>
                <option value="2021">by 2021</option>
                <option value="2022">by 2022</option>
                <option value="2023">by 2023</option>
                <option value="2024">by 2024</option>
            </select>

            <div id="root-summary"></div>
        </div>
    </div>
</div>

<?php
    require_once "./src/views/content/UC010/modal.php"
?>

<!-- <script>
    const id_of_user   = <?= $_SESSION["id"] ?>;
    const api_uc010 = "<?= $api_uc010 ?>";
    const host_name_uc010 = "<?= $host_name ?>";
    const api_uc010_summary = "<?= $api_uc010_summary ?>";
    const api_uc010_update_history = "<?= $api_uc010_update_history ?>";
</script> -->

<script src="<?= $host_name ?>/public/js/uc010/leave_manage.js"></script>