<?php
require 'connect.php';
session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<title>
		Admin
	</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/admin.css">
</head>

<body>
	<div id="head" align='center'>
		<img src="img/admin.png" alt="" id="photo">
		<h1>Admin Login</h1>
	</div>

	<div align='center' class="button" id="loginText">
		<form action="admin.php" method="POST">
			<input class="input" type="email" name="email" placeholder="abc@example.com" required>
			<input class='input' type="password" name="password" placeholder="Password" required><br>
			<input class="submit" type="submit" name="submit" value='LOGIN'>
		</form>

	</div>

	<div align="center" class='loginfo' style="color: rgb(255, 255, 255);text-align: center;margin-top: 2vh;
			text-shadow: 4px 2px 4px rgb(0, 0, 0);">
		<?php


		if (isset($_POST['submit'])) {
			$password = md5($_POST['password']);
			$email = $_POST['email'];
			$sql = "SELECT email,password,name FROM admin WHERE email='$email' and password='$password'";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
				$row = mysqli_fetch_array($result);
				$_SESSION['loginAdmin'] = $row['name'];
				echo "<h1>Login Successful<h1>";
				header("refresh: 1; url=adminDashboard.php");
			} else {
				echo "<h1>invalid Password Email or Password<h1>";
				header("refresh: 2;url=admin.php");
			}
		}
		?>
	</div>
</body>

</html>