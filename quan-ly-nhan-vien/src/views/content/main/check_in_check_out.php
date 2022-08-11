<link rel="stylesheet" href="<?= $host_name ?>/public/css/myLeave.css">
<link rel="stylesheet" href="<?= $host_name ?>/public/css/navbar.css">
<div class="content">
    <div class="content-header">
        <div class="header">
            <h1 class="heading">check in/check out</h1>
        </div>
    </div>
    <div class="content-body leave-history" id="content-body">
        <div class="js-modal-contain">

            <div class="func-button">
                <button class="btn">submit</button>
                <button class="btn">save</button>
                <input type='date' id='datepicker' name='from' size='9' value='' />
            </div>

            <div class="history">
                <div class="header">
                    <div class="header-page">
                    </div>
                </div>
                <table id="history">
                    <tr>
                        <th>Date</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td>10/07/2022</td>
                        <td>08:00</td>
                        <td>17:00</td>
                        <td class="action-area">
                            <i class="fa-solid fa-trash-can js-trash js-del-re"></i>
                            <i class="fa-solid fa-pen js-fix"></i>
                        </td>
                    </tr>
                </table>
                <div class="history-empty">
                    <img src="/asset/img/image/oh crap.png" alt="oh crap">
                    <p>you don't have any check-in check-out!</p>
                </div>
                <div class="history-nofound">
                    <img src="/asset/img/image/nofound.png" alt="oh crap">
                    <p>no results found</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once "./src/views/content/UC001/modal.php"
?>

<script src="<?= $host_name ?>/public/js/uc010/leave_manage.js"></script>