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
        <form action='http://localhost/quan-ly-nhan-vien/uc001/viewCICOAdmin' method='GET'>
            <label for="date">Birthday:</label>
            <input type="string" id="date" name="bin">
            <input type="submit">
        </form>
        </div>
            <div class="history">
                <div class="header">
                    <div class="header-page">
                    </div>
                </div>
                <table id="history">
                    <tr>
                        <th>Employee_ID</th>
                        <th>Date</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Duration</th>
                    </tr>
                    <?php   
                        print_r($_GET);
                        if (isset($_GET['bin'])) {
                            echo $_GET['bin'];
                        }
                        else {
                            echo "hi";
                        }
                        if (!is_null($data)) {
                            foreach ($data as &$value) {
                                $date = $value["DATE"];
                                $time_in = $value["TIME_IN"];
                                $time_out = $value["TIME_OUT"];
                                $duration = $value['DURATION'];
                                $employee_id = $value['EMPLOYEE_ID'];
                                echo "<tr>";
                                echo "<td>$employee_id</td>";
                                echo "<td>$date</td>";
                                echo "<td>$time_in</td>";
                                echo "<td>$time_out</td>";
                                echo "<td>$duration</td>";
                                echo "</tr>";
                            }
                        }
                        else 
                            echo"<tr>There is no data</tr>";
                    ?>  
                </table>
                <div class="history-empty">
                    <img src="/asset/img/image/oh crap.png" alt="oh crap">
                    <p>There is no data!</p>
                </div>
                <div class="history-nofound">
                    <img src="/asset/img/image/nofound.png" alt="oh crap">
                    <p>no results found</p>
                </div>
            </div>
        </div>
    </div>
</div>