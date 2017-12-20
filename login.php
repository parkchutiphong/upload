<?php
session_start();

if (isset($_SESSION['username'])) header("Location: showdata.php");
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
			<form method="post" action="checklogin.php">

				<div class="row">
					<div style="text-align: center; padding: 10px;">
					Username:&nbsp;
					<input type="text" name="textusername" class="textUsername">
				</div>
				</div>

				<div class="row">
					<div style="text-align: center; padding: 10px;">
					Password:&nbsp;
					<input type="password" name="textpassword" class="textPassword">
				</div>
				</div>

				<div class="row">
					<div style="text-align: center; padding: 10px;">
					<input type="submit" class="loginSubmit" value="Login">
				</div>
			</div>

				<div class="row">
					<div style="text-align: center; padding: 10px;">
					<p>
						<?php
						if (isset($_GET['msg'])) {
							echo $_GET['msg'];
						}
						?>
					</p>
				</div>
			</div>
			</form>

			<div class="row">
				<div style="text-align: center; padding: 20px;">
					<a href="index.php"><img src="pic/back_icon.png" alt="Back" style="height: auto; width: 80px;"></a>
				</div>
			</div>

		</div>

		<!-- Contact me -->
		<div class="footer">
			<h3>Contact me</h3>
			<p>E-mail parktesla@hotmail.com</p>
		</div>

	</div> <!-- close fadeIn -->
</body>
</html>
