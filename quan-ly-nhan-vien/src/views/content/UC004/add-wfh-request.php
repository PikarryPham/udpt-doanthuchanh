
<link rel="stylesheet" href="<?= $host_name ?>/public/css/WFH_request.css" />
<form id="form" method='POST' action="<?= $host_name ?>/uc004/createWFHRequest">
    <div class="modal-new-rq"> 
        <div class="modal-contain">
            <div class="modal__heading">
                <h1>create new WFH request</h1>
                <div class="button">
                    <button class="btn" type="button" disabled>submit</button>
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
                            <input type="date" name="start-date" id="start-date" />
                        </div>
                        <div class="date">
                            <p>end date</p>
                            <input type="date" name="end-date" id="end-date" />
                        </div>
                        <div class="fl_up">
                            <p>email follow up</p>
                            <select name="fl_up" id="">
                                <option value="1">yes</option>
                                <option value="0">no</option>
                            </select>
                        </div>
                        <div class="status">
                            <p>status</p>
                            <select name="fl_up" id="" readonly>
                                <option value="yes">draft </option>
                                <option value="no">reject</option>
                            </select>
                        </div>
                        <div class="date">
                            <p>created date</p>
                            <input type="date" name="" id="" />
                        </div>
                    </div>
                </div>

                <div class="textare-form">
                    <p>reason WFH</p>
                    <textarea
                        name="reason"
                        placeholder="Type something..."
                        cols="30"
                        rows="10"
                    ></textarea>
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
                    <tr>
                        <td>Date</td>
                        <td><i class="fa fa-iconname" aria-hidden="true"></i></td>
                        </tr>
                </table>
                <input type="hidden" name="listWFHDetail" id="listWFHDetail" />
            </div>
        </div>
    </div> 
</form>

<script>
    function onSubmit(event) {
        event.preventDefault()

        var listWFHDetail = []
        for (var r = 0, n = myTable.rows.length; r < n - 1; r++) {
            const value = formatDate(myTable.rows[r].cells[0].innerHTML);
            listWFHDetail.push(value)
        }

        event.target.submit()
    }
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


