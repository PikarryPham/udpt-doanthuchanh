<link rel="stylesheet" href="<?= $host_name ?>/public/css/sel_as_n_goal.css">
<div class="content">
    <div class="content-header">
        <h1 class="heading" id="heading">self assessment | deadline submit: 2022-07-15 23:00:00</h1>
    </div>
    <div class="content-body">
        <div class="per-ex">
            <div class="perform">
                <h4>performance & development agreement</h4>
                <p id="last-update">last updated:</p>
            </div>
            <a href="#" class="export" style="cursor: not-allowed;">export PDF</a>
        </div>
        <div class="user-info">
            <p class="dark-60">Fullname: <?= $_SESSION['name'] ?> - Employee ID: <?= $_SESSION['id'] ?></p>
        </div>
        <div class="button">
            <button class="btn btn-submit" style="cursor: not-allowed;">submit</button>
            <!-- <button class="btn btn-save" style="cursor: not-allowed;">save</button> -->
            <a href="<?= $host_name ?>/UC0131_132/myPAgoal">
                <button class="btn btn-cancel">cancel</button>
            </a>
        </div>
        <div class="add-new">
            <div class="js-add-new">
                <i class="fa-solid fa-circle-plus js-create" style="cursor: not-allowed;"></i>
                <span style="cursor: not-allowed;">add a new goal</span>
            </div>
            <div class="delete-line" id="action-button">
                <button class="btn-delete js-del-re-all" style="cursor: not-allowed;">delete</button>
                <button class="delete-all" style="cursor: not-allowed;">delete all</button>
            </div>
        </div>
        <div class="nothing-content" id="nothing-content">
            <img src="<?= $host_name ?>/public/img/image/oh crap.png" width="300" height="210" alt="">
            <p>you don't have any goal. you can create a new one!</p>
        </div>
    </div>

    <div class="goal-name-box" id="detail-goal-name">

    </div>
</div>

<div class="modal-new-goal js-modal-view-goal" id="model-view">
    <div class="modal-contain js-modal-contain-new-goal">
        <h1>see a goal</h1>
        <div class="time">
            <div class="due-date">
                <p>due date</p>
                <input type="date" name="" id="" readonly>
            </div>
            <div class="due-date">
                <p>completed date</p>
                <input type="date" name="" id="" readonly>
            </div>
            <div class="select">
                <p>status</p>
                <select name="" id="" readonly>
                    <option value="">processing</option>
                </select>
            </div>
        </div>

        <div class="input-form">
            <div class="input">
                <p>goal/objects name</p>
                <input type="text" placeholder="type something here" readonly>
            </div>
            <div class="input">
                <p>action/steps</p>
                <input type="text" placeholder="type something here" readonly>
            </div>
            <div class="input">
                <p>comment</p>
                <input type="text" placeholder="type something here" readonly>
            </div>
        </div>

        <div class="button">
            <a href="#" onclick="hideNewGoalCreate()" class="btn cancel js-cancel">cancel</a>
        </div>
    </div>
</div>

<script>
    var pa_goal_id = <?= $data[0] ?>
</script>
<script src="<?= $host_name ?>/public/js/UC0131_132/call_api_view.js"></script>