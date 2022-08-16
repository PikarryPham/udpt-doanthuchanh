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
                <button class="btn" onclick=insertCICO()>Insert new log time</button>
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
                        <th>Duration</th>
                        <th>Action</th>
                    </tr>
                    <!-- <tr>
                        <td><input type="text" id="date" name="date"></td>
                        <td><input type="text" id="time_in" name="time_in"></td>
                        <td><input type="text" id="time_out" name="time_out"></td>
                        <td class="action-area">
                            <i class="fa-solid fa-trash-can js-trash js-del-re"></i>
                            <i class="fa-solid fa-pen js-fix"></i>
                        </td>
                    </tr> -->
                    <?php   
                        if (!is_null($data)) {
                            foreach ($data as &$value) {
                                $date = $value["DATE"];
                                $time_in = $value["TIME_IN"];
                                $time_out = $value["TIME_OUT"];
                                $duration = $value['DURATION'];
                                $param = $date . "+" . $value['EMPLOYEE_ID'];
                                echo "<tr>";
                                echo "<td>$date</td>";
                                echo "<td>$time_in</td>";
                                echo "<td>$time_out</td>";
                                echo "<td>$duration</td>";
                                echo "<td class='action-area'>
                                <i class='fa-solid fa-pen' onclick='updateCICO(\"$param\")'></i>
                                <i class='fa-solid fa-trash' onclick='deleteCICO(\"$param\")''></i>
                                </td>";
                                echo "</tr>";
                            }
                        }
                        else 
                            echo"<tr>There is no data</tr>";
                    ?>  
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

<script type="text/javascript">
    function updateCICO(param) {
        location.href="http://localhost/quan-ly-nhan-vien/uc001/insertCICO";
    }

    function deleteCICO(param) {
        fetch('http://127.0.0.1:5000/delete-check-in-check-out/'+param)
        .then((response) => {
            //return response.json();
        })
        .then((myJson) => {
            //console.log("When I add "+first+" and "+second+" I get: " + myJson.result);
        });
        alert("Đã xóa thành công!!!");
    }

    function insertCICO() {
        location.href="http://localhost/quan-ly-nhan-vien/uc001/insertCICO";
    }
</script>