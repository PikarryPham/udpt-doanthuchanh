<div class="modal-new-rq js-modal-new-rq">
    <form id="form-post-request" method="post" action="<?= $host_name ?>/uc002/test"class="modal-contain js-modal-contain-new-rq">
        
    <input type="hidden" name="OTRequest_ID" id="OTRequest_ID" value="0">

        <div class="modal__heading">
            <h1 id="title-modal">create new OT request</h1>
            <div class="button">
                <button type="button" id="submit-btn-text" class="btn">submit</button>
                <button type="submit" id="submit-btn-save" class="btn">save</button>
                <button type="button" class="btn cancel">cancel</button>
            </div>
        </div>

        <div class="modal__body">
            <div class="employ_info">
                <h3>Employee's Information</h3>
                <div class="form flex_start">
                    <div class="ful-name">
                        <p>full name</p>
                        <input type="text" name="EMPLOYEE_NAME" id="EMPLOYEE_NAME" readonly="readonly" required>
                    </div>
                    <div class="email">
                        <p>email</p>
                        <input type="text" name="EMPLOYEE_EMAIL" id="EMPLOYEE_EMAIL" readonly="readonly" required>
                    </div>
                    <div class="department">
                        <p>department</p>
                        <input type="text" name="EMPLOYEE_DEPART_NAME" id="EMPLOYEE_DEPART_NAME" readonly="readonly" required>
                    </div>
                    <div class="employee ID">
                        <p>employee ID</p>
                        <input type="text" name="EMPLOYEE_ID" id="EMPLOYEE_ID" readonly="readonly" required>
                    </div>
                </div>
            </div>

            <div class="appraiser_info">
                <h3>Appraiser (Manager)'s Information</h3>
                <div class="form flex_start">
                    <div class="ful-name">
                        <p>full name</p>
                        <input type="text" name="MANAGER_NAME" id="MANAGER_NAME" readonly="readonly" required>
                    </div>
                    <div class="email">
                        <p>email</p>
                        <input type="text" name="MANAGER_EMAIL" id="MANAGER_EMAIL" readonly="readonly" required>
                    </div>
                    <div class="department">
                        <p>department</p>
                        <input type="text" name="MANAGER_DEPART_NAME" id="MANAGER_DEPART_NAME" readonly="readonly" required>
                    </div>
                    <div class="appraiser ID">
                        <p>appraiser (manager) ID</p>
                        <input type="text" name="MANAGER_ID" id="MANAGER_ID" readonly="readonly" required>
                    </div>
                </div>
            </div>

            <div class="OT_rq_info">
                <h3>OT Request Overview Information</h3>
                <div class="form flex_start">
                    <div class="date">
                        <p>start date</p>
                        <input type="date" name="START_DATE" id="start-date" required readonly="readonly">
                    </div>
                    <div class="date">
                        <p>end date</p>
                        <input type="date" name="END_DATE" id="end-date" required readonly="readonly">
                    </div>
                    <div class="total">
                        <p>total estimated hours</p>
                        <input type="number" name="ESTIMATED_HOURS" id="estimated_hours" value="0" required readonly="readonly">
                    </div>
                    <div class="fl_up">
                        <p>email follow up</p>
                        <select name="NOTIFICATION_FLAG" id="NOTIFICATION_FLAG">
                            <option value="0">no</option>
                            <option value="1">yes</option>
                        </select>
                    </div>
                    <div class="status">
                        <p>status</p>
                        <input type="text" name="STATUS" id="STATUS_REQUEST" readonly>
                    </div>
                    <div class="date">
                        <p>created date</p>
                        <input type="datetime-local" name="CREATE_DATE" id="today-date" readonly="readonly" required>
                    </div>
                </div>
            </div>

            <div class="textare-form">
                <p>reason OT</p>
                <textarea name="REASON" placeholder="Type something..." cols="30" rows="10" id="REASON_EMPLOYEE" required></textarea>
            </div>

            <div class="ot-rq-detail">
                <h3>OT request details</h3>
                <div class="form flex_start">
                    <div class="date">
                        <p>date</p>
                        <input type="date" name="" id="request-date" required>
                    </div>
                    <div class="date">
                        <p>hours</p>
                        <input type="number" max="4" min="1" name="" id="request-time" value="1" required>
                    </div>
                    <button class="btn" id="submit-ot-request-detail" type="button" onclick="hoursActive()">Add OT details</button>
                </div>
            </div>

            <table class="table text-align">
                <tbody>
                    <tr>
                        <th width="50%">date OT</th>
                        <th>hours</th>
                        <th>action</th>
                    </tr>
                </tbody>
                <tbody id="table-ot-detail">
                    
                </tbody>
                                
            </table>
        </div>
        <input type="hidden" name="number-ot" id="number-ot" value="0" required>

    </form>
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

<!-- model delete -->

<div class="modal-delete-re js-modal-del-re">
    <div class="modal-contain js-modal-contain-re">
        <div class="modal-header js-modal-header">
            <p class="modal--heading">Delete Request</p>
            <div class="modal-close-delete-re js-modal-close-del-re">
                <i onclick="hideDelRequest()" class="fa-solid fa-xmark"></i>
            </div>
        </div>
        <div class="modal-content">
            <p>Do you want to delete this request? This step cannot be undo.</p>
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
                <i onclick="hideDelConfirm ()" class="fa-solid fa-xmark"></i>
            </div>
        </div>
        <div class="modal-content">
            <p>Congratulations! You delete this request successfully!</p>
            <a href="#" onclick="hideDelConfirm ()" class="btn ok-btn">OK</a>
        </div>
    </div>
</div>

<!-- model delete -->

<div class="modal-delete-re js-modal-push-re">
    <div class="modal-contain js-modal-contain-re">
        <div class="modal-header js-modal-header">
            <p id="title-notification" class="modal--heading">Delete Request</p>
            <div class="modal-close-delete-re js-modal-close-del-re">
                <i onclick="hiddenNotification()" class="fa-solid fa-xmark"></i>
            </div>
        </div>
        <div class="modal-content">
            <p id="message-notification">Do you want to delete this request? This step cannot be undo.</p>
            <a href="#" onclick="hiddenNotification()" class="btn js-confirm">OK</a>
            <a href="#" onclick="hiddenNotificationAll()" class="btn js-cancel-btn">Back to main</a>
        </div>
        <br>
       <br> 
    </div>
</div>

<div class="modal-delete-re js-modal-unsubmit">
    <form id="model-unsubmit-request" method="post" class="modal-contain js-modal-contain-re">
        <div class="modal-header js-modal-header">
            <p id="title-notification" class="modal--heading" style="text-align: center;">Unsubmit Request</p>
        </div>
        <div class="modal-content">
            <input type="hidden" name="EMPLOYEE_ID" value="<?= $_SESSION['id'] ?>">
            <label class="modal-unsubmit-request-label" for="">Reason unsubmit: </label>
            <textarea id="modal-unsubmit-request-text" class="modal-unsubmit-request-textare" name="UNSUBMIT_REASON" id="" cols="30" rows="10" placeholder="Type the reason that you want to unsubmit the OT Request...."></textarea>
            <br><br>
            <button href="#" type="submit" style="background-color: var(--green); color: var(--white); cursor: pointer;" class="btn js-confirm">Send</button>
            <a href="#" onclick="hiddenModalUnSubmit()" class="btn js-cancel-btn">Cancel</a>
        </div>
       <br> 
    </form>
</div>