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

    </style>
</head>
<body>
    <div style="width:75%; margin-left:20px;">
    <div class="title">
        <b>Reject PA Goal Request</b>
        <form method="post" action="<?= $host_name ?>/home/verify_request_goal">
		    <button type="submit" class="button" style="float:right;">Return</button>
	    </form>
    </div>
    <br>
    <div>
        <form method="post" action="<?= $host_name ?>/home/verify_request_goal_reject">
            <label> Comment Reason for Rejecting Request: </label>
            <br>
            <input type="text" style="border:2px;" id="reject_reason_id" name="reject_reason">
            <input type="hidden" name="request_id" value=<?php $_SESSION['cur_goal_request_id'] ?>>
            <input type="submit" class="button" name="btn_reject" style="margin-left:0px;background:#EB5757B2;color:white;" value="Reject">
        </form>
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