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
            <form class="content-body-leave">
                <div class="leave-from">
                    <p>leave from</p>
                    <input type="date" id="">
                </div>

                <div class="leave-to">
                    <p>leave to</p>
                    <input type="date" id="">
                </div>

                <div class="leave-type">
                    <p>leave type</p>
                    <select id="leave-type">
                        <option value="all new types">all new types</option>
                        <option value="annual leave">annual leave</option>
                        <option value="personal leave">personal leave</option>
                        <option value="compensation leave">compensation leave</option>
                        <option value="sick leave (non-paid)">sick leave (non-paid)</option>
                        <option value="non-paid leave">non-paid leave</option>
                        <option value="maternity leave (non-paid)">maternity leave (non-paid)</option>
                        <option value="engagement ceremony">engagement ceremony</option>
                        <option value="relative funeral leave">relative funeral leave</option>
                        <option value="wedding leave">wedding leave</option>
                    </select>
                </div>
            </form>
            <div class="show-leave-status">
                <p>show leave with status</p>
                <div class="squarecheck">
                    <label for="squarecheck1">all</label>
                    <input type="checkbox" name="check" id="squarecheck1">
                </div>
                <div class="squarecheck">
                    <label for="squarecheck2">accepted</label>
                    <input type="checkbox" name="check" id="squarecheck2">
                </div>
                <div class="squarecheck">
                    <label for="squarecheck3">rejected</label>
                    <input type="checkbox" name="check" id="squarecheck3">
                </div>
                <div class="squarecheck">
                    <label for="squarecheck4">cancelled</label>
                    <input type="checkbox" name="check" id="squarecheck4">
                </div>
                <div class="squarecheck">
                    <label for="squarecheck5">pending approval</label>
                    <input type="checkbox" name="check" id="squarecheck5">
                </div>
                <div class="squarecheck">
                    <label for="squarecheck6">draft</label>
                    <input type="checkbox" name="check" id="squarecheck6">
                </div>
            </div>

            <div class="func-button">
                <button class="btn">search</button>
                <button class="btn">reset all</button>
            </div>

            <div class="history">
                <div class="header">
                    <h4>history</h4>
                    <div class="header-page">
                        <i class="fa-solid fa-angle-left"></i>
                        <span>1/1</span>
                        <i class="fa-solid fa-angle-right"></i>
                    </div>
                </div>
                <table id="history">
                    <tr>
                        <th>employee_id</th>
                        <th>leave type</th>
                        <th>leave from</th>
                        <th>leave to</th>
                        <th>status</th>
                        <th>date created</th>
                        <th>manager id</th>
                        <th>rejected reason (if any)</th>
                        <th>action</th>
                    </tr>
                    <tr>
                        <td>1234</td>
                        <td>annual leave</td>
                        <td>10/07/2022</td>
                        <td>20/07/2022</td>
                        <td class="pending">pending</td>
                        <td>01/07/2022</td>
                        <td>1256</td>
                        <td>none</td>
                        <td class="action-area">
                            <i class="fa-solid fa-trash-can js-trash js-del-re"></i>
                            <i class="fa-solid fa-pen js-fix"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>1234</td>
                        <td>annual leave</td>
                        <td>10/07/2022</td>
                        <td>20/07/2022</td>
                        <td class="rejected">rejected</td>
                        <td>01/07/2022</td>
                        <td>1256</td>
                        <td>none</td>
                        <td class="action-area">
                            <i class="fa-solid fa-trash-can js-trash js-del-re"></i>
                            <i class="fa-solid fa-pen js-fix"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>1234</td>
                        <td>annual leave</td>
                        <td>10/07/2022</td>
                        <td>20/07/2022</td>
                        <td class="approved">approved</td>
                        <td>01/07/2022</td>
                        <td>1256</td>
                        <td>none</td>
                        <td class="action-area">
                            <i class="fa-solid fa-trash-can js-trash js-del-re"></i>
                            <i class="fa-solid fa-pen js-fix"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>1234</td>
                        <td>annual leave</td>
                        <td>10/07/2022</td>
                        <td>20/07/2022</td>
                        <td class="draft">draft</td>
                        <td>01/07/2022</td>
                        <td>1256</td>
                        <td>none</td>
                        <td class="action-area">
                            <i class="fa-solid fa-trash-can js-trash js-del-re"></i>
                            <i class="fa-solid fa-pen js-fix"></i>
                        </td>
                    </tr>
                </table>
                <div class="history-empty">
                    <img src="/asset/img/image/oh crap.png" alt="oh crap">
                    <p>you don't have any leave request!</p>
                </div>
                <div class="history-nofound">
                    <img src="/asset/img/image/nofound.png" alt="oh crap">
                    <p>no results found</p>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body summary">
        <div class="js-modal-contain">
            <select name="year" id="year">
                <option value="by 2022">by 2022</option>
                <option value="by 2023">by 2023</option>
                <option value="by 2024">by 2024</option>
                <option value="by 2025">by 2025</option>
                <option value="by 2026">by 2026</option>
            </select>
            <table>
                <tr>
                    <th>leave type</th>
                    <th>total day(s)</th>
                    <th>token day(s)</th>
                    <th>remaining days</th>
                </tr>
                <tr>
                    <td>annual leave</td>
                    <td>16</td>
                    <td>2</td>
                    <td>14</td>
                </tr>
                <tr>
                    <td>personal leave</td>
                    <td>6</td>
                    <td>1</td>
                    <td>3</td>
                </tr>
                <tr>
                    <td>sick leave (Non-paid)</td>
                    <td>30</td>
                    <td>0</td>
                    <td>30</td>
                </tr>
                <tr>
                    <td>non-paid leave</td>
                    <td>30</td>
                    <td>0</td>
                    <td>30</td>
                </tr>
                <tr>
                    <td>maternity leave (Non-paid)</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                </tr>
                <tr>
                    <td>engagement ceremony</td>
                    <td>1</td>
                    <td>0</td>
                    <td>1</td>
                </tr>
                <tr>
                    <td>relative funeral leave</td>
                    <td>3</td>
                    <td>0</td>
                    <td>3</td>
                </tr>
                <tr>
                    <td>wedding leave</td>
                    <td>3</td>
                    <td>0</td>
                    <td>3</td>
                </tr>
            </table>
        </div>
    </div>
</div>

<?php
require_once "./src/views/content/UC010/modal.php"
?>

<script src="<?= $host_name ?>/public/js/uc010/leave_manage.js"></script>