<?php
require 'connect.php';
include('session_s.php');
?>
<!DOCTYPE html>
<html>

<head>
	<title>
		Student Dashboard
	</title>
	<style>
		table,
		td,
		th {
			text-align: center;

		}

		table {
			width: 70%;
			box-shadow: 0px 21px 31px -3px rgba(0,0,0,0.62);
			border-collapse: collapse;


		}

		th,
		td {
			padding: 15px;


		}

		th{
			color: #00FF7B;
			background-color: rgba(0, 0, 0,0.5);
		}
		tr{
			color: white;
			background-color: rgba(0, 0, 0,0.3);
		}

	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/student.css">
</head>

<body>
	<div id="head" align='center'>
		<img src="img/admin.png" id="photo">
		<h1>Welcome, <?php echo $userCheck; ?> !</h1>
		<form method="POST" action="studentDashboard.php">
			<input class="submit logoutbtn" type="submit" name="logout" value="LOGOUT">
		</form>
		<?php
		if (isset($_POST['logout'])) {
			session_unset();
			session_destroy();
			header("location:student.php");
		}
		?>
	</div>
	<br><br>
	<div id="marks" align="center">
		<?php
		$sql = "SELECT email,php,mysql,html,name,total,percentage FROM student WHERE name='$userCheck' and email='$userEmail'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		if ($row['php'] == 0)
			$php = "N.A";
		else
			$php = $row['php'];
		if ($row['mysql'] == 0)
			$sql = "N.A";
		else
			$sql = $row['mysql'];
		if ($row['html'] == 0)
			$html = "N.A";
		else
			$html = $row['html'];
		if ($row['total'] == 0)
			$total = "N.A";
		else
			$total = $row['total'];
		if ($row['percentage'] == 0)
			$percentage = "N.A";
		else
			$percentage = $row['percentage'];

					if (isset($_POST['sendEmail'])) {
						$name = $userCheck;
						$email = $_POST['email'];
						$subjectForUser = $name."'s Marksheet";
							$feedbackForUser = '<!DOCTYPE html>
							<html>
							<head>
								<style>
									table,
									td,
									th {
										text-align: center;
									}

									table {
										width: 70%;
										box-shadow: 0px 21px 31px -3px rgba(0, 0, 0, 0.62);
										border-collapse: collapse;
									}

									th,
									td {
										padding: 15px;
									}

									th {
										color: #00FF7B;
										background-color: rgba(0, 0, 0, 0.5);
									}

									tr {
										color: black;
										background-color: rgba(0, 0, 0, 0.3);
									}

							</style>
							</head>
							<body>
								<table style="width:100%;">
									<tr>
										<th>PHP</th>
										<th>MySql</th>
										<th>Html</th>
										<th>Total</th>
										<th>Percentage</th>
									</tr>
									<tr style="text-align:center">
										<td>'.$php.'</td>
										<td>'.$sql.'</td>
										<td>'.$html.'</td>
										<td>'.$total.'</td>
										<td>'.$percentage.'</td>
									</tr>
								</table>
								<br>
								Congratulations '.$name.'. !!
								</html>
							</body>
										
							
				'; 
				$headers = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				mail($email, $subjectForUser, $feedbackForUser, $headers);

				}

					



		?>


		<div id="table">
			<table>
				<tr>
					<th>PHP</th>
					<th>MySql</th>
					<th>Html</th>
					<th>Total</th>
					<th>Percentage</th>
				</tr><br>
				<tr>
					<td><?php echo $php; ?></td>
					<td><?php echo $sql; ?></td>
					<td><?php echo $html; ?></td>
					<td><?php echo $total; ?></td>
					<td><?php echo $percentage." %"; ?></td>
				</tr>
			</table>
		</div><br><br>

		<div id="congrats">
			<?php
			if ($row['php'] == 0)
				echo "Marks Not Found";
			elseif ($row['percentage'] > 60.0) {
				echo "Congratulations on " . $row['percentage'] . "%";
			}
			?>
		</div><br><br>
		<div id="sendEmail">
			<form action="studentDashboard.php" method="POST">
				<input class="input" type="email" name="email" placeholder="Parent's Email ID">
				<input class="submit" type="submit" name="sendEmail" value="SEND">
			</form>
			
		</div>
		<?php 

			if (isset($_POST['sendEmail'])){
				mail($email, $subjectForUser, $feedbackForUser, $headers);
				echo "<br><br><h3 style='color: white;'>Mail Sent</h3>";
			}

		 ?>
	</div>
</body>

</html>