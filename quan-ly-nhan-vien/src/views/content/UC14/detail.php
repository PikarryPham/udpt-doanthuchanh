<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="<?= $host_name ?>/public/css/recruitment.css">
    <title>CV Detail</title>

</head>
<body>
<div style="width:80%">
    <div class="title">
        <b>CV Managerment</b>
        <form method="post" action="<?= $host_name ?>/home/recruitment">
            <button type="submit" class="button" style="float:right;">Return</button>
        </form>
    </div>
    <br>
    <?php foreach ($data as $item) 
    { 
    ?>
    <div style="width: 90%; height: 844px; background: #E5F4F0; border: 2px solid #000000;">
        <div class="flex-container">
			<div class="flex-container-col">
				<div style="margin:20px">
					<u><b> Name: </b></u>
					<b> <?php echo $item->NAME ?> </b>
				</div>
				<div style="margin:20px">
					<u><b> Position: </b></u>
					<b> <?php echo $item->JOB_TITLE ?> </b>
				</div>
				<div style="margin:20px">
					<u><b> Date: </b></u>
					<b> <?php echo $item->DATE_OF_APPLICATION ?> </b>
				</div>
                <div style="margin:20px">
                    <u><b> Content: </b></u>
                    <select id="url_select">
                        <option value="<?php echo $item->URL . ".pdf" ?>"> CV </option>
                        <option value="<?php echo $item->ACADEMIC_TRANSCRIPT_URL .".pdf" ?>"> Academic Transcript </option>
                    </select>
                </div>
			</div>
			
            <div class="flex-container-col">
                <div style="margin:20px">
                    <u><b> Email: </b></u>
                    <b> <?php echo $item->EMAIL ?> </b>
                </div>
                
                <div style="margin:20px">
                    <u><b> Comment: </b></u>
                    <br>
                    <div class="comment-box"> <?php echo $item->COMMENT ?> </div>
			    </div>
            </div>
            <div style="margin:20px">
                <u><b> Status: </b></u>
                <br>
                <div style="height: 30px; width: 100px ;background: rgba(0, 0, 0, 0.3);"> <?php echo $item->STATUS ?> </div>
            </div>
            <div>
                <form method="post" action="<?= $host_name ?>/home/recruitment_update_status">
					<input type="hidden" name="CV_ID" value=<?= $item->CV_ID ?>>
                    <input type="hidden" name="STATUS" value=<?= $item->STATUS ?>>
                    <input type="hidden" name="COMMENT" value=<?= $item->COMMENT ?>>
					<input type="submit" id="Next" class="button" style="margin-left:250px;margin-top:20px" value="Next">
				</form>
                
                <form method="post" action="<?= $host_name ?>/home/recruitment_update_status_archived">
					<input type="hidden" name="CV_ID" value=<?= $item->CV_ID ?>>
                    <input type="hidden" name="STATUS" value=<?= $item->STATUS ?>>
                    <input type="hidden" name="COMMENT" value=<?= $item->COMMENT ?>>
					<input type="submit" id="Archived" class="button" style="background:#EB5757B2;color:white;margin-left:250px; margin-top:20px" value="Archived">
				</form>
                
            </div>
        <br>
        </div>
        <div style="align-items: center; margin:20px;">
            <img id="cv_image" src="<?= $host_name ?>/public/img/image/fake_cv.jpg" width="90%" height="500px" >
        </div>
    </div>
    <?php } ?>

</div>
        <script>
            var chosen=document.getElementById("url_select");
            var image_cv=document.getElementById("cv_image");
            $("#ComboBox").change(function(){ 
                var url = $(this).val();

                image_cv.attr("src",url); 

            });
        </script>

</body>
</html>