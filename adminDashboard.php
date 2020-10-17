<?php
require 'connect.php';
include('session_a.php');
?>
<!DOCTYPE html>
<html>

<head>
	<title>
		Admin Dashboard
	</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>
		$(document).ready(function() {
			$("#close").hide();
			$(".addS").hide();
			$(".updateS").hide();
			$(".deleteS").hide();
			event.preventDefault();
		});
		$(document).ready(function() {
			$("#addStudent").click(function(event) {
				$("#updateStudent").hide(100);
				$("#deleteStudent").hide(100);
				$("#close").show(100);
				$(".addS").show(100);
				event.preventDefault();
			});
		});
		$(document).ready(function() {
			$("#close").click(function(event) {
				$("#updateStudent").show(100);
				$("#deleteStudent").show(100);
				$("#addStudent").show(100);
				$("#close").hide(100);
				$(".addS").hide(100);
				$(".updateS").hide(100);
				$(".deleteS").hide(100);
				event.preventDefault();
			});
		});
		$(document).ready(function() {
			$("#updateStudent").click(function(event) {
				$("#addStudent").hide(100);
				$("#deleteStudent").hide(100);
				$("#close").show(100);
				$(".updateS").show(100);
				event.preventDefault();
			});
		});
		$(document).ready(function() {
			$("#deleteStudent").click(function(event) {
				$("#addStudent").hide(100);
				$("#updateStudent").hide(100);
				$("#close").show(100);
				$(".deleteS").show(100);
				event.preventDefault();
			});
		});
	</script>
	<link rel="stylesheet" type="text/css" href="css/admin.css">
</head>

<body>
	<div id="head" align='center'>
		<img src="img/admin.png" alt="" id="photo">
		<h1 id="welcomemsg">Welcome, <?php echo $userCheck; ?> !</h1>
		<form method="POST" action="adminDashboard.php">
			<input class="submit logoutbtn" type="submit" name="logout" value="LOGOUT">	
		</form>
		<?php 
			if (isset($_POST['logout'])) {
				session_unset();
				session_destroy();
				header("location:admin.php");
			}
		 ?>
	</div><br><br>
	<div id="dash" align="center">

		<input class="submit" type="submit" name="add" value="ADD STUDENT INFO" id="addStudent">
		<input class="submit" type="submit" name="update" value="UPDATE STUDENT INFO" id="updateStudent">
		<input class="submit" type="submit" name="delete" value="DELETE STUDENT INFO" id="deleteStudent">
		<img src="img/close.png" alt="close" id="close">
		<br><br>
	</div>
	<div class="addS" align="center">
		<form method="POST" action="adminDashboard.php" id="addSub">
			<select id="nameS" class="input" name="name" form="addSub" required>
				<?php
				$sql = "SELECT name,email FROM student";
				$result = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result) > 0) {
					while ($row = mysqli_fetch_assoc($result)) {
						echo '<option value=' . $row["email"] . '>' . $row["name"] . '</option>';
					}
				}
				?>
			</select>
			<input class="input add" type="number" name="php" required min="0" max="100" placeholder="PHP">
			<input class="input add" type="number" name="sql" required min="0" max="100" placeholder="MySql">
			<input class="input add" type="number" name="html" required min="0" max="100" placeholder="Html"><br>
			<input class="submit add" type="submit" name="addSub" value="ADD INFO">
			<?php
			if (isset($_POST['addSub'])) {
				$php = $_POST['php'];
				$email = $_POST['name'];
				$Sql = $_POST['sql'];
				$html = $_POST['html'];
				$total = $php + $Sql + $html;
				$percentage = $total / 3;
				$sql = "UPDATE student SET php=$php, mysql=$Sql, html=$html, total=$total, percentage=$percentage WHERE email='$email'";
				if (mysqli_query($conn, $sql)) {
					echo '<script>alert("Info Added")</script>';
				} else {
					echo '<script>alert("Error adding record: ' . mysqli_error($conn) . '")</script>';
				}
			}

			?>
		</form>
	</div><br>
	<div class="updateS" align="center">
		<form method="POST" action="adminDashboard.php" id="updateSub">
			<select id="student" class="input" name="name" form="updateSub" required>
				<?php
				$sql = "SELECT name,email FROM student";
				$result = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result) > 0) {
					while ($row = mysqli_fetch_assoc($result)) {
						echo '<option value=' . $row["email"] . '>' . $row["name"] . '</option>';
					}
				}
				?>
			</select>
			<select id="subject" class="input" name="subject" form="updateSub" required>
				<option value="php">PHP</option>
				<option value="mysql">MySql</option>
				<option value="html">Html</option>
			</select>
			<input class="input add" type="number" name="mark" required min="0" max="100" placeholder="Marks"> 
			<input class="submit add" type="submit" name="updateSub" value="UPDATE INFO">
			<?php
			if (isset($_POST['updateSub'])) {
				$email = $_POST['name'];
				$subject = $_POST['subject'];
				$mark = $_POST['mark'];
				$sql = "UPDATE student SET $subject=$mark WHERE email='$email'";
				$result = mysqli_query($conn, $sql);
				$sql = "SELECT php,mysql,html FROM student WHERE email='$email'";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
				$total = $row['php'] + $row['mysql'] + $row['html'];
				$php = $row['php'];
				$Sql = $row['mysql'];
				$html = $row['html'];
				$percentage = $total / 3;
				$sql = "UPDATE student SET php=$php, mysql=$Sql, html=$html,total=$total, percentage=$percentage WHERE email='$email'";
				if (mysqli_query($conn, $sql)) {
					echo '<script>alert("Info Updated")</script>';
				} else {
					echo '<script>alert("Error adding record: ' . mysqli_error($conn) . '")</script>';
				}
			}

			?>
		</form>
	</div>
	<div class="deleteS" align="center">
		<form method="POST" action="adminDashboard.php" id="deleteSub">
			<select id="sub" class="input" name="name" form="deleteSub" required>
				<?php
				$sql = "SELECT name,email FROM student";
				$result = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result) > 0) {
					while ($row = mysqli_fetch_assoc($result)) {
						echo '<option value=' . $row["email"] . '>' . $row["name"] . '</option>';
					}
				}
				?>
				<input class="submit add" id="deleteStudent" type="submit" name="deleteSub" value="DELETE INFO">
				<?php
				if (isset($_POST['deleteSub'])) {
					$email = $_POST['name'];
					$sql = "DELETE FROM student WHERE email='$email'";
					if (mysqli_query($conn, $sql)) {
						echo '<script>alert("Info Deleted")</script>';
						header("location:adminDashboard.php");
					} else {
						echo '<script>alert("Error adding record: ' . mysqli_error($conn) . '")</script>';
					}
				}

				?>
		</form>
	</div>
</body>

</html>