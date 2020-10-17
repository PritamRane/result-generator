<?php

require 'connect.php';
session_start();
$userCheck = $_SESSION['loginAdmin'];

$sql = "SELECT name from admin where name = '$userCheck'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_array($result);
	$login_session = $row['name'];
}


if(!isset($_SESSION['loginAdmin'])){
	
	header("location:admin.php");
	die();
}
