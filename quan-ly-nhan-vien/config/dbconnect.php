<?php

$user = "root";
$pass = "";
$db = "main_service";	

$mysqli = new mysqli("localhost", $user, $pass, $db );
if ($mysqli->connect_errno )
{
    die( "Cannot connect to MySQL" );
}
?>