<?php
function getServerTime($format)
{
	$timezone  = +7; //(GMT +7:00)  
	$servertime = time() + 3600*($timezone+date("0"));
	$today = gmdate($format, $servertime);
	return $today;
}
?>