<?php
session_start();

if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}

// connect to database
require("connect.php");
?>

<html>
<head>
	<meta charset="utf-8">

	<title>Upload</title>

	<link rel="icon" href="pic/upload.png" type="image/x-icon">
	<link rel="shortcut icon" href="pic/upload.png" type="image/x-icon">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- animate css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

	<!-- my css -->
	<link href="css/style.css" rel="stylesheet">

</head>
<body>
	<!-- fadeIn -->
	<div class="elementToFadeIn">

		<div class="container">

			<div class="row">
				<div class="col">
				<div style="text-align: center; padding: 10px;">
					<div class="table-responsive">
					<?php
					// load data to table
					$sql = "SELECT * FROM fileupload";
					$rs = mysqli_query($con, $sql);
					// check data is not empty
					if (mysqli_num_rows($rs) == 0) {
						echo "<h1>Data is empty!</h1>";
					} else {
						echo "<table class='table_Ip'>
						<tr>
						<th class='th_Ip'>File ID</th>
						<th class='th_Ip'>IP</th>
						<th class='th_Ip'>Date</th>
						<th class='th_Ip'>Time</th>
						<th class='th_Ip'>File name</th>
						</tr>";
						while ($row = mysqli_fetch_array($rs)){
							// cut file name
							if (strlen($row[4]) > 50) {
								$cutname = substr($row[4], 0, 50)."...";
							} else {
								$cutname = $row[4];
							}
							echo "<tr>
							<td class='td_Ip'>$row[0]</td>
							<td class='td_Ip'>$row[1]</td>
							<td class='td_Ip'>$row[2]</td>
							<td class='td_Ip'>$row[3]</td>
							<td class='td_Ip'>$cutname</td>
							</tr>";
						}
						echo "</table>";
					}
					// close connection from database
					mysqli_close($con);
					?>
				</div>
				</div>
			</div>

				<div class="row">
					<div class="col">
					<div style="text-align: center; padding: 20px;">
						<a href="logout.php"><img src="pic/back_icon.png" alt="Back" style="height: auto; width: 80px;"></a>
					</div>
				</div>
				</div>

			</div> <!-- close main container -->

			<!-- Contact me -->
			<div class="footer">
				<h3>Contact me</h3>
				<p>E-mail parktesla@hotmail.com</p>
			</div>

		</div> <!-- close fadeIn -->
</body>
</html>
