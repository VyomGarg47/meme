<?php 
ob_start();//turns on output buffering
session_start();


$timezone = date_default_timezone_set("Asia/Kolkata");

$con = mysqli_connect("localhost","root","","social"); //connection variable
if(mysqli_connect_errno()){
	echo "Damm, Failed to connect: " . mysqli_connect_errno(); //echo--print on screen //it adds a error message
} 
?>