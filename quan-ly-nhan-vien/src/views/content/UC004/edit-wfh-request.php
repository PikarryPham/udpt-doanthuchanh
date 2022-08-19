<link rel="stylesheet" href="<?= $host_name ?>/public/css/WFH_request.css" />

<form id="form2" method='POST' action="<?= $host_name ?>/uc004/submit"></form>
<form id="form" method='POST' action="<?= $host_name ?>/uc004/updateWFHRequest">
    <div class="modal-new-rq"> 
        <div class="modal-contain">
            <div class="modal__heading">
                <h1>Update WFH request</h1>
                <div class="button">
                        <?php 
                            $rwfhID = $data[4];
                            echo "<input type='hidden' name='rwfhID' value='$rwfhID' form='form2' />";
                        ?>
                        <button class="btn" type="submit" form="form2">submit</button>
                    <button class="btn" type="submit">save</button>
                    <a href="<?= $host_name ?>/uc004/index"><button class="btn cancel" type="button">cancel</button></a>
                </div>
            </div>
            <div class="modal__body">
                <div class="employ_info">

                    <h3>Employee's Information</h3>
                    <div class="form flex_start">
                        <div class="employee ID">
                            <p>employee ID</p>
                            <?php
                                $employeeID= $data[0][0]["EMPLOYEE_ID"];
                                echo "<input type='text' name='employeeID' id='employeeID' value=$employeeID readonly/>";
                            ?>                        
                        </div>
                        <div class="ful-name">
                            <p>full name</p>
                            <?php
                                $employeeName= $data[0][0]["EMPLOYEE_NAME"];
                                echo "<input type='text' name='employeeName' id='employeeName' value='$employeeName' readonly/>";
                            ?>  
                        </div>
                        <div class="email">
                            <p>email</p>
                            <?php
                                $email= $data[0][0]["EMAIL"];
                                echo "<input type='text' name='employeeEmail' id='' value=$email readonly/>";
                            ?>  
                        </div>
                        <div class="department">
                            <p>department</p>
                            <?php
                                $depart= $data[0][0]["DEPARTMENT_NAME"];
                                echo "<input type='text' name='' id='' value='$depart' readonly/>";
                            ?>

                        </div>
                    </div>
                </div>
                <div class="appraiser_info">
                    <h3>Appraiser (Manager)'s Information</h3>
                    <div class="form flex_start">
                        <div class="ful-name">
                            <p>full name</p>
                            <?php
                                $managerName= $data[1][0]["NAME"];
                                echo "<input type='text' name='managerName' id='managerName' value='$managerName' readonly/>";
                            ?> 
                        </div>
                        <div class="email">
                            <p>email</p>
                            <?php
                                $email= $data[1][0]["EMAIL"];
                                echo "<input type='text' name='managerEmail' id='managerEmail' value=$email readonly/>";
                            ?> 
                        </div>
                        <div class="department">
                            <p>department</p>
                            <?php
                                $depart= $data[1][0]["DEPARTMENT_NAME"];
                                echo "<input type='text' name='managerDepart' id='managerDepart' value='$depart' readonly/>";
                            ?>
                        </div>
                        <div class="appraiser ID">
                            <p>appraiser (manager) ID</p>
                            <?php
                                $employeeID= $data[1][0]["EMPLOYEE_ID"];
                                echo "<input type='text' name='managerID' id='managerID' value=$employeeID readonly/>";
                            ?> 
                        </div>
                    </div>
                </div>

                <div class="WFH_rq_info">
                    <h3>WFH Request Overview Information</h3>
                    <div class="form flex_start">
                        <div class="date">
                            <p>start date</p>
                            <?php 
                                $startDate = $data[2]["FROM_DATE"];
                                $rwfhID = $data[4];
                                $myDateTime = strtotime($startDate);
                                $new_date_format = date('Y-m-d', $myDateTime);
                                echo "<input type='date' name='start-date' id='start-date' value=$new_date_format />";
                                echo "<input type='hidden' name='rwfhID' value=$rwfhID />";
                            ?>

                        </div>
                        <div class="date">
                            <p>end date</p>
                            <?php 
                                $endDate = $data[2]["TO_DATE"];
                                $myDateTime = strtotime($endDate);
                                $new_todate_format = date('Y-m-d', $myDateTime);
                                echo "<input type='date' name='end-date' id='end-date' value=$new_todate_format />";
                            ?>
                        </div>
                        <div class="fl_up">
                            <p>email follow up</p>
                            <select name="fl_up" id="">
                                <?php 
                                    $notificationFlag = $data[2]["NOTIFICATION_FLAG"];

                                    if ($notificationFlag == 1) {
                                        echo "<option value='1' selected>yes</option>";
                                        echo "<option value='0'>no</option>";
                                    } else {
                                        echo "<option value='1'>yes</option>";
                                        echo "<option value='0' selected>no</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="status">
                            <p>status</p>
                            <?php 
                                $status = $data[2]["STATUS"];
                                echo "<input name='status' value='$status' readonly/>"; 
                            ?>
                        </div>
                        <div class="date">
                            <p>create date</p>

                            <?php 
                                $createDate = $data[2]["CREATE_DATE"];
                                $myDateTime = strtotime($createDate);
                                $new_create_date_format = date('Y-m-d', $myDateTime);
                                echo "<input type='date' name='create-date' id='create-date' value=$new_create_date_format />";
                            ?>
                        </div>
                    </div>
                </div>

                <div class="textare-form">
                    <p>reason WFH</p>
                    <?php 
                        $reason = $data[2]["MANAGER_COMMENT"];
                        echo "<textarea name='reason' cols='30' rows='10' placeholder=$reason></textarea>";
                    ?>
                </div>

                <div class="ot-rq-detail">
                    <h3>WFH request details</h3>
                    <div class="form flex_start">
                        <div class="date">
                            <p>date</p>
                            <input type="date" name="" id="date-wfh" />
                        </div>
                        <button class="btn" onclick="myCreateFunction()" type="button" >Add WFH details</button>
                    </div>
                </div>

                <table class="table text-align" id="myTable">
                    <?php 
                        $i = 0;
                        $listWFHDetail = "";
                        while ($i < count($data[3])) {
                            $date = $data[3][$i]['DATE'];
                            $myDateTime = strtotime($date);
                            $new_create_date_format = date('d-m-Y', $myDateTime);
                            echo "<tr>";
                            echo "<td>$new_create_date_format</td>";
                            $listWFHDetail .= date('Y-m-d', $myDateTime) . " ";
                            echo "<td><i class='fa-solid fa-trash-can' onclick='myDeleteFunction($i)' aria-hidden='true'></i></td>";
                            echo "</tr>";
                            $i += 1;
                        }

                        echo "<input type='hidden' name='listWFHDetail' id='listWFHDetail' value='$listWFHDetail' />";
                    ?>
                    <tr>
                        <td>Date</td>
                        <td><i class="fa fa-iconname" aria-hidden="true"></i></td>
                    </tr>
                </table>

            </div>
        </div>
    </div> 
</form>

<script>
    function formatDate(date) {  
        return date.split("-").reverse().join("-");
    }

    function myCreateFunction() {
        var inputDate = document.getElementById('date-wfh').value;
        var startDate = document.getElementById('start-date');
        var endDate = document.getElementById('end-date');
        var table = document.getElementById("myTable");
        var listWFHDetail = document.getElementById("listWFHDetail");

        // Insert to table
        var row = table.insertRow(0);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        date_wfh= formatDate(inputDate);

        // Insert to form
        listWFHDetail.value += inputDate + " "

        cell1.innerHTML = date_wfh;
        cell2.innerHTML = "<i class='fa-solid fa-trash-can' onclick='myDeleteFunction()' aria-hidden='true'></i>";

        for (var r = 0, n = myTable.rows.length; r < n - 1; r++) {
            myTable.rows[r].cells[1].innerHTML = `<i class='fa-solid fa-trash-can' onclick='myDeleteFunction(${r})' aria-hidden='true'></i>`
        }

        // Set start date and end date
        if (startDate.value == null || startDate.value == "") {
            startDate.value = inputDate
        } else {
            if (inputDate < startDate.value) {
                startDate.value = inputDate
            }
        }

        if (endDate.value == null || endDate.value == "") {
            endDate.value = inputDate
        } else {
            if (inputDate > endDate.value) {
                endDate.value = inputDate
            }
        }

    }

    function myDeleteFunction(index) {
        var myTable = document.getElementById("myTable");
        var startDate = document.getElementById('start-date');
        var endDate = document.getElementById('end-date');
        var listWFHDetail = document.getElementById("listWFHDetail");
        listWFHDetail.value = ""

        // Delete row
        myTable.deleteRow(index)

        // Check to valid from date and to date
        if (myTable.length < 1) {
            startDate = ""
            endDate = ""
        } else {
            var min = formatDate(myTable.rows[0].cells[0].innerHTML)
            var max = formatDate(myTable.rows[0].cells[0].innerHTML)

            for (var r = 0, n = myTable.rows.length; r < n - 1; r++) {
                const value = formatDate(myTable.rows[r].cells[0].innerHTML);
                myTable.rows[r].cells[1].innerHTML = `<i class='fa-solid fa-trash-can' onclick='myDeleteFunction(${r})' aria-hidden='true'></i>`
                listWFHDetail.value += value + " "

                if (value > max) {
                    max = value
                } else if (value < min) {
                    min = value
                }
            }

            startDate.value = min
            endDate.value = max
        }
    }

</script>
