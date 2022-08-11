<link rel="stylesheet" href="<?= $host_name ?>/public/css/myLeave.css">
<link rel="stylesheet" href="<?= $host_name ?>/public/css/navbar.css">
<link rel="stylesheet" href="<?= $host_name ?>/public/css/document.css">
<div class="content">
    <div class="content-header">
        <div class="header">
            <h1 class="heading">document list</h1>
        </div>
    </div>
    <div class="content-body leave-history" id="content-body">
        <div class="js-modal-contain">

            <div class="func-button">
                <button class="btn" onclick=uploadFile()>Upload file</button>
            </div>

            <div class="history">
                <div class="header">
                    <div class="header-page">
                    </div>
                </div>
                <table id="history">
                    <tr>
                        <th>File</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    <?php   
                        if (!is_null($data)) {
                            foreach ($data as &$value) {
                                $document_id = $value["document_id"];
                                $content = $value["content"];
                                $title = $value["title"];
                                $date = $value['create_date'];
                                echo "<tr>";
                                //echo "<tr onClick='location.href=$content'>";
                                echo "<td>";
                                echo "<a href='.https://drive.google.com/drive/u/0/folders/1meH45ZlXT4zmCnKD2MhI-auKKr7kRIug.' target='_blank'></a>$title";
                                echo "</td>";
                                echo "<td>$date</td>";
                                echo "<td class='action-area'>
                                <i class='fa-solid fa-eye js-open' id='openFile' onclick='openFile(\"$content\")'></i>
                                <i class='fa-solid fa-trash id='deleteFile' onclick='deleteFile(\"$document_id\")''></i>
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
        <?php   
    ?>  
    <!-- <script>
        console.log(<?= json_encode($data) ?>);
    </script> -->
    </div>
</div>

<script type="text/javascript">
    function openFile(param) {
        location.href = param;
    }

    function deleteFile(param) {
        fetch('http://127.0.0.1:5000/delete-document/'+param)
        .then((response) => {
            //return response.json();
        })
        .then((myJson) => {
            //console.log("When I add "+first+" and "+second+" I get: " + myJson.result);
        });
    }


    function uploadFile() {
        location.href="http://localhost/quan-ly-nhan-vien/uc016/uploadDocument";
    }
</script>