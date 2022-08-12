<div class="modal-new-goal js-modal-edit-goal">
    <form class="modal-contain js-modal-contain-new-goal" id="edit-modal-create-new-goal">
    </form>
</div>

<div class="modal-new-goal js-modal-new-goal">
    <form class="modal-contain js-modal-contain-new-goal" id="modal-create-new-goal">
        <h1>create a new goal</h1>
        <div class="time">
            <div class="due-date">
                <p>due date</p>
                <input type="date" name="due_date" id="due_date" required>
            </div>
            <div class="due-date">
                <p>completed date</p>
                <input type="date" name="complete_date" id="complete_date" required>
            </div>
            <div class="select">
                <p>status</p>
                <select name="status" id="status">
                    <option value="Processing">Processing</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>
        </div>

        <div class="input-form">
            <div class="input">
                <p>goal/objects name</p>
                <input type="text" name="name" id="name" placeholder="type something here" required>
            </div>
            <div class="input">
                <p>action/steps</p>
                <input type="text" name="action" id="action" placeholder="type something here" required>
            </div>
            <div class="input">
                <p>comment</p>
                <input type="text" name="comment" id="comment" placeholder="type something here" required>
            </div>
        </div>

        <div class="button">
            <button style="cursor: pointer;" type="submit" class="btn save">save</button>
            <a href="#" onclick="hideGoalCreate()" class="btn cancel js-cancel">cancel</a>
        </div>

        <div class="toast-save-edit">
            <i class="fa-solid fa-circle-check"></i>
            <p>save your goal successfully!</p>
        </div>
    </form>
</div>

<div class="modal-unsubmit js-modal-unsubmit">
    <form method="post" class="modal-contain js-modal-contain-unsubmit" id="js-model-unsubmit">
        <h1>unsubmit request</h1>
        <p>Reason unsubmit:</p>
        <input type="hidden" id="id_PA_Goal">
        <textarea placeholder="type the reason that you want to unsubmit the PA form..." name="" id="reason-unsubmit" cols="30" rows="10"></textarea>
        <div class="button-unsubmit">
            <button type="submit" class="btn unsubmit-success">send</button>
            <button type="button" onclick="hideUnsubmitForm()" class="btn cancel-unsubmit">cancel</button>
        </div>
    </form>
</div>

<div class="modal-delete-re js-model-confirm-submit">
    <div class="modal-contain js-modal-contain-re">
        <div class="modal-header js-modal-header">
            <p class="modal--heading">Submit PA Goal</p>
            <div class="modal-close-delete-re js-modal-close-del-re">
                <i onclick="hideSubmitRequest()" class="fa-solid fa-xmark"></i>
            </div>
        </div>
        <div class="modal-content">
            <p>Do you want to Submit this goal? This step cannot be undo</p>
            <a href="#" onclick="choice_submit()" class="btn js-confirm">OK</a>
            <a href="#" onclick="hideSubmitRequest()" class="btn js-cancel-btn">cancel</a>
        </div>
    </div>
</div>

<div class="modal-delete-re js-modal-del-re">
    <div class="modal-contain js-modal-contain-re">
        <div class="modal-header js-modal-header">
            <p class="modal--heading">delete a goal</p>
            <div class="modal-close-delete-re js-modal-close-del-re">
                <i onclick="hideDelRequest()" class="fa-solid fa-xmark"></i>
            </div>
        </div>
        <div class="modal-content">
            <p>do you want to delete this goal? This step cannot be undo</p>
            <a href="#" onclick="showDelConfirm()" class="btn js-confirm">OK</a>
            <a href="#" onclick="hideDelRequest()" class="btn js-cancel-btn">cancel</a>
        </div>
    </div>
</div>

<div class="modal-delete-co js-modal-del-co">
    <div class="modal-contain js-modal-contain-co">
        <div class="modal-header js-modal-header">
            <p class="modal--heading">delete successfully</p>
            <div class="modal-close-delete-co js-modal-close-del-co">
                <i onclick="hideDelConfirm()" class="fa-solid fa-xmark"></i>
            </div>
        </div>
        <div class="modal-content">
            <p>congratulations! you deleted this goal successfully</p>
            <a href="#" onclick="hideDelConfirm()" class="btn ok-btn">OK</a>
        </div>
    </div>
</div>

<div class="modal-delete-re-all js-modal-del-re-all">
    <div class="modal-contain js-modal-contain-re-all">
        <div class="modal-header js-modal-header">
            <p class="modal--heading" id="heading-delete-modal">delete the goal(s)</p>
            <div class="modal-close-delete-re js-modal-close-del-re-all">
                <i onclick="hideDelRequestAll()" class="fa-solid fa-xmark"></i>
            </div>
        </div>
        <div class="modal-content">
            <p id="message-delete-modal">you have choose some goals to delete. do you want to delete them? This step cannot be undo</p>
            <a id="showDelConfirmAll" href="#" onclick="showDelConfirmAll()" class="btn js-confirm-all">OK</a>
            <a href="#" onclick="hideDelRequestAll()" class="btn js-cancel-all">cancel</a>
        </div>
    </div>
</div>

<div class="modal-delete-co-all js-modal-del-co-all">
    <div class="modal-contain js-modal-contain-co-all">
        <div class="modal-header js-modal-header">
            <p class="modal--heading" id="title-alert">delete successfully</p>
            <div class="modal-close-delete-co js-modal-close-del-co-all">
                <i onclick="hideDelConfirmAll()" class="fa-solid fa-xmark"></i>
            </div>
        </div>
        <div class="modal-content">
            <p id="message-alert">congratulations! you deleted those goals successfully</p>
            <a href="#" onclick="hideDelConfirmAll()" class="btn ok-btn-all">OK</a>
        </div>
    </div>
</div>

<div class="modal-edit-error js-modal-edit-error">
    <div class="modal-contain js-modal-contain-edit-error">
        <div class="modal-close js-modal-close-edit-error">
            <i onclick="hideError()" class="fa-solid fa-xmark"></i>
        </div>
        <div class="modal-content">
            <i class="fa-regular fa-circle-xmark"></i>
            <p style="text-transform: none;" id="content-eror">You cannot edit or submit your PA Goal Form anymore because time for your Self-Assessment request is overdue</p>
        </div>
    </div>
</div>

<div class="modal-delete-re-all" id="js-modal-done-alert">
    <div class="modal-contain js-modal-contain-re-all">
        <div class="modal-header js-modal-header">
            <p class="modal--heading" id="heading-model-alert">Unsubmit successfully</p>
            <div class="modal-close-delete-re js-modal-close-del-re-all">
                <i onclick="hideDelRequestAll()" class="fa-solid fa-xmark"></i>
            </div>
        </div>
        <div class="modal-content">
            <p id="content-model-alert">Congratulations! You have unsubmit form successfully. We have emailed to your appraiser about your unsubmission.</p>
            <a href="#" onclick="hideMolAlert1()" class="btn js-confirm-all">Go, View PA Goal</a>
            <a href="#" onclick="hideMolAlert2()" class="btn js-cancel-all">Go back to main</a>
        </div>
    </div>
</div>