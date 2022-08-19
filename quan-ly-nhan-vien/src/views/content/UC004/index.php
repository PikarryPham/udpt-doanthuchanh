
<link rel="stylesheet" href="<?= $host_name ?>/public/css/OT_request.css" />
<link rel="stylesheet" href="<?= $host_name ?>/public/css/myLeave.css" />


<div class="content">
    <div class="content__heading">
        <h1>WFH request</h1>
        <a href="<?= $host_name ?>/uc004/add"><button class="new-rq btn">new request WFH</button></a>
    </div>
    <div class="content__body">
        <div class="history">
            <div class="header">
                <h4></h4>
                <div class="header-page">
                    <a href="<?= $host_name ?>/uc004/pageDecrease"><i class="fa-solid fa-angle-left"></i></a>
                    <?php 
                        $totalPages = $data[1];
                        $currentPage = $data[2];
                        echo "<span>$currentPage/$totalPages</span>";
                    ?>
                    <a href="<?= $host_name ?>/uc004/pageIncrease"><i class="fa-solid fa-angle-right"></i></a>
                </div>
            </div>
            <table style="background-color: white" id="history">
                <tr>
                    <th>WFHRequest_ID</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Date Created</th>
                    <th>Manager ID</th>
                    <th>rejected reason (if any)</th>
                    <th>action</th>
                </tr>
                <?php 
                    $i = 0;

                    while ($i < count($data[0])) {
                        $rwfhID = $data[0][$i]["RWFH_ID"];
                        $fromDate = $data[0][$i]["FROM_DATE"];
                        $toDate = $data[0][$i]["TO_DATE"];
                        $status = $data[0][$i]["STATUS"];
                        $createDate = $data[0][$i]["CREATE_DATE"];
                        $managerID = $data[0][$i]["MANAGER_ID"];
                        $managerComment = $data[0][$i]["MANAGER_COMMENT"];

                        echo "<tr>";
                        echo "<td>$rwfhID</td>";
                        echo "<td>$fromDate</td>";
                        echo "<td>$toDate</td>";
                        echo "<td>$status</td>";
                        echo "<td>$createDate</td>";
                        echo "<td>$managerID</td>";
                        echo "<td>$managerComment</td>";
                        echo "<td class='action-area'>";
                        echo "<form method='POST' action='$host_name/uc004/delete'>"; 
                        echo "<input type='hidden' name='rwfhID' value='$rwfhID'/>";
                        echo "<button type='submit'><i class='fa-solid fa-trash-can js-trash js-del-re'></i></button>";
                        echo "</form>";
                        echo "<form method='POST' action='$host_name/uc004/update'>"; 
                        echo "<input type='hidden' name='updateRwfhID' value='$rwfhID'/>";
                        echo "<button type='submit' ><i class='fa-solid fa-pen js-fix'></i></button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";

                        $i += 1;
                    }
                ?>   
            </table>
        </div>
    </div>
</div>
<script>
    // function myEditFunction() {
    //     location.href="<?= $host_name ?>/public/src/views/content/UC004/add-wfh-request.php?rwfhID='$rwfhID'";
    // }
</script>