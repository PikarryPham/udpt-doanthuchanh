<?php
session_start();

if(@$_REQUEST['code'] && @strtolower($_REQUEST['code']) == strtolower($_SESSION['random_number']))
{
	echo 1;// submitted 
}
else
{
	echo 0; // invalid code
}
?>
