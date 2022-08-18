<html>

<!--<link rel="stylesheet" href="recruitment.css"> -->
<link rel="stylesheet" href="<?= $host_name ?>/public/css/recruitment.css">


</body>
<div style="width:75%; margin-left:30px;">
<div class="title">
	<b>CV Managerment</b>
	<form method="post" action="<?= $host_name ?>/home/main_uc">
		<button type="submit" class="button" style="float:right;">Return</button>
	</form>
</div>

<br>
<div class="flex-container">
	<div>
	<b>Position</b>
	<select>
		<option value="Data Engineer"> Data Engineer </option>
	</select>
	</div>
	
	<div>
	<b> Status </b>
	<select>
		<option value="Pending"> Pending </option>
		<option value="Screening"> Screening </option>
		<option value="Interviewing"> Interviewing </option>
		<option value="Offering"> Offering </option>
		<option value="Approved"> Approved </option>
		<option value="Archived"> Archived </option>
	</select>
	</div>
	
	<div>
	<b> Order by </b>
	<select>
		<option value="Oldest to Newest"> Oldest to Newest </option>
		<option value="Newest to Oldest"> Newest to Oldest </option>
	</select>
	</div>
</div>
<br>
<?php foreach ($data as $item) 
{ 
?>
	<div class="content-list">
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
			</div>
			
			<div style="margin:20px">
				<u><b> Status: </b></u>
				<br>
				<b> <?php echo $item->STATUS ?> </b>
			</div>
			
			<div style="margin:20px">
				<u><b> Comment: </b></u>
				<br>
				<div class="comment-box"> <?php echo $item->COMMENT ?> </div>
			</div>
			<div>
				<!--<button style="display:block;"  v-bind:href="<?= $host_name ?>/home/recruitment_detail + '/<?php $item->CV_ID ?>'"> View detail </button>-->
				<form method="post" action="<?= $host_name ?>/home/recruitment_detail">
					<input type="hidden" name="CV_ID" value=<?= $item->CV_ID ?>>
					<button type="submit">View Detail</button>
				</form>
			</div>

		</div>
	</div>

<?php 
} 
?>
</div>
</body>

