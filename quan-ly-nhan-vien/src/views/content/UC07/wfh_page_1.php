<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= $host_name ?>/public/css/verify_request.css">
    <!--<link rel="stylesheet" href="verify_request.css">-->
    <style>
    table, td, th {
    border: 1px solid;
    text-align: center;
    }
    table {
    width: 90%;
    border-collapse: collapse;
    }
    </style>
</head>
<body>
    <div style="width:75%; margin-left:20px;">
    <div class="title">
        <b>Manage WFH Request</b>
        <form method="post" action="<?= $host_name ?>/home/request_management">
		    <button type="submit" class="button" style="float:right;">Return</button>
	    </form>
    </div>
    <br>
    <div>
    <table>
        <tr>
            <th style="color:green;">Request ID</th>
            <th style="color:green;">Employee ID</th>
            <th style="color:green;">Date Request</th>
            <th style="color:green;">Reason</th>
            <th style="color:green;">From</th>
            <th style="color:green;">To</th>
            <th style="color:green;">Status</th>
            <th style="color:green;">Action</th>
        </tr>
        <tr>
            <?php foreach ($data as $item)
            {
            ?>
        <tr>
            <td><?php echo $item->RWFH_ID ?></td>
            <td><?php echo $item->EMPLOYEE_ID ?></td>
            <td><?php echo $item->CREATE_DATE ?></td>
            <td><?php echo $item->REASON ?></td>
            <td><?php echo $item->FROM_DATE ?></td>
            <td><?php echo $item->TO_DATE ?></td>
            <td><?php echo $item->STATUS ?></td>
            <td>
                
                <form action="<?= $host_name ?>/home/verify_request_wfh_accept" method="post">
                    <input type="hidden" id="request_id_id" name="request_id" value="<?php echo $item->RWFH_ID  ?>">
                    <input type="submit" class="button" style="margin-left:0px;" id="accept_request_button" value="Accept" style="color:white; background:green;"/>
                </form>
                
                <form action="<?= $host_name ?>/home/verify_request_wfh_reject_page" method="post">
                    <input type="hidden" id="request_id_id" name="request_id" value="<?php echo $item->RWFH_ID ?>">
                    <input type="submit" class="button" style="margin-left:0px;background:#EB5757B2;color:white;" id="reject_request_button" value="Reject" style="color:white; background:red;"/>
                </form>
                &nbsp;
                
            </td>
        </tr>
            <?php 
            }
            ?>
        </tr>
    </table>
    </div>

</div>
<script>
    /*/Get the modal
    var modal = document.getElementById("myModal1");

    // Get the button that opens the modal
    var btn = document.getElementById("reject_request_button");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    //$("#reject_request_button").submit = function() {
    //    modal.style.display = "block";
    //}

    $("#reject_request_button").submit(function(e){
        modal.style.display = "block";
    });

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
    modal.style.display = "none";
    }


    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    }*/
</script>
</body>
</html>