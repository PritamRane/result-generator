<?php
require 'connect.php';
session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<title>
		Student Login
	</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/student.css">
	<script>
		$(document).ready(function() {
			$(".reg").hide();
			$("#registerText").hide();
			event.preventDefault();
		});
		$(document).ready(function() {
			$("#loginDirect").click(function(event) {
				$(".log").hide();
				$("#loginText").hide();
				$(".reg").show();
				$("#registerText").show();
				event.preventDefault();
			});
		});
		$(document).ready(function() {
			$("#registerDirect").click(function(event) {
				$(".log").show();
				$("#loginText").show();
				$(".reg").hide();
				$("#registerText").hide();
				event.preventDefault();
			});
		});


	</script>
</head>

<body>
	<div id="head" class="log" align='center'>
		<img src="img/admin.png" alt="" id="photo">
		<h1>Student Login</h1>
	</div>

	<div align='center' class="button" id="loginText">
		<form action="student.php" method="POST">
			<input class="input" type="email" name="email" placeholder="abc@example.com" required>
			<input class='input' type="password" name="password" placeholder="Password" required><br>
			<input class="submit" type="submit" name="login" value='LOGIN'>

		</form><br>
		<h2>Dont have an account? <span id='loginDirect' class="logRegStyle">Register</span></h2>

	</div>

	<div align="center" class='loginfo' style="color: rgb(255, 255, 255);text-align: center;margin-top: 2vh;
			text-shadow: 4px 2px 4px rgb(0, 0, 0);">
		<?php


		if (isset($_POST['login'])) {
			$password = md5($_POST['password']);
			$email = $_POST['email'];
			$sql = "SELECT email,password,name FROM student WHERE email='$email' and password='$password'";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
				$row = mysqli_fetch_array($result);
				$_SESSION['loginStudent'] = $row['name'];
				$_SESSION['loginMail'] = $row['email'];
				echo "<h1>Login Successful<h1>";
				header("refresh: 1; url=studentDashboard.php");
			} else {
				echo "<h1>invalid Password Email or Password<h1>";
				header("refresh: 2;url=student.php");
			}
		}
		?>
	</div>
	<div id="head" class="reg" align='center'>
		<img src="img/admin.png" alt="" id="photo">
		<h1>Student Register</h1>
	</div>

	<div align='center' class="button" id="registerText">
		<form action="student.php" method="POST">
			<input class="input" type="text" name="name" placeholder="Name" required>
			<input class="input" type="email" name="email" placeholder="abc@example.com" required>
			<input class='input' type="password" name="password" placeholder="Password" required><br>
			<input class="submit" type="submit" name="register" value='REGISTER'>
		</form><br>
		<h2>ALready Registered? <span id='registerDirect' class="logRegStyle">Login</span></h2>

	</div>

	<div align="center" class='loginfo' style="color: rgb(255, 255, 255);text-align: center;margin-top: 2vh;
			text-shadow: 4px 2px 4px rgb(0, 0, 0);">
		<?php


		if (isset($_POST['register'])) {
			$name = $_POST['name'];
			$password = md5($_POST['password']);
			$email = $_POST['email'];
			$sql = "SELECT email FROM student WHERE email='$email'";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
				$row = mysqli_fetch_array($result);
				echo "<h1>ALready Registered<h1>";
				header("refresh: 1; url=student.php");
			} 
			else {
					$sql = "INSERT INTO student (name, email, password) VALUES ('$name','$email','$password')";
				if (mysqli_query($conn, $sql)) {
					echo "<h1>Registered<h1>";
					header("refresh: 1; url=student.php");
				} else {
					echo "<h1>invalid Password Email or Password<h1>";
					header("refresh: 2;url=student.php");
				}
			}

			
		}
		?>
	</div>
</body>

</html>