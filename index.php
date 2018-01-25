<?php
// connect to database
require("connect.php");

// include to show file item
include("showfile.php");

?>

<html>
<head>
	<meta charset="utf-8">

	<title>Upload</title>

	<link rel="icon" href="pic/upload.png" type="image/x-icon">
	<link rel="shortcut icon" href="pic/upload.png" type="image/x-icon">

	<!-- my java script -->
	<script src="js/image_script.js"></script>

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



	<!-- animate css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

	<!-- my css -->
	<link href="css/style.css" rel="stylesheet">
	<link href="css/image_style.css" rel="stylesheet">

	<script>
				// for upload event
				function funevenupload() {
					document.getElementById("divupload").style.pointerEvents = "none";
					document.getElementById("uppic").style.display = "none";
					document.getElementById("picloader").style.display = "block";
					document.getElementById("msgToUser").innerHTML = "Uploading...<br>Please wait";
					document.getElementById("uploadbutton").click();
				}

					$(document).ready(function(){
						// animate mouser over upload button
						$("#uppic").mouseover(function(){
							$("#uppic").addClass("animated rubberBand");
						});
						$("#uppic").mouseout(function(){
							$("#uppic").removeClass("animated rubberBand");
						});

						// search function
						$("#searchfilename").keyup(function(){
							$.ajax({
								url: "search.php",
								type: "post",
								data: {"keyword": $(this).val()},
								success: function (response) {
									$("#data_table").html(response);
								}
							});
						});

					}); // close jquery

	</script>


</head>
<body>
	<!-- fadeIn -->
	<div class="elementToFadeIn">

		<div class="container">

		<!-- upload form -->
		<form method="post" action="upload.php" enctype="multipart/form-data">

			<div class="row">
				<!-- massage to user -->
				<div id="msgToUser" style="text-align: center; padding: 10px;">
					<?php
					if (isset($_GET["status"])) {
						if ($_GET["status"] == "success") {
							echo $_GET["msg"];
						} else {
							echo $_GET["msg"];
						}
					} else {
						echo "Upload picture here!!!";
					}
					?>
				</div>
			</div>

			<div class="row">
				<!-- browse file button -->
				<div id="divupload" style="text-align: center; padding: 10px;">
					<label style="cursor: pointer;">
						<input type="file" name="file1[]" multiple style="display: none;" onchange="funevenupload();" accept="image/*">
						<img src="pic/upload.png" style="height: auto; width: 200px;" id="uppic">
						<center><div id="picloader" class="loader"></div></center>
					</label>
				</div>
				<!-- upload button -->
				<input type="submit" id="uploadbutton" style="display: none;">
			</div>

			<div class="row">
				<!-- search -->
				<div style="text-align: center; padding: 10px;">
						<img src="pic/search_icon.png" alt="Search" style="height: 55; width: auto;">
						<input type="text" id="searchfilename" name="searchfilename" class="textSearch" width="300">
				</div>
			</div>
		</form> <!-- close upload form -->

		<div class="row">
			<!-- show files -->
			<div style="text-align: center;">
				<span id="data_table">
					<?php
					$sql = "SELECT *
					FROM fileupload
					ORDER BY file_id DESC";
					$rs = mysqli_query($con, $sql);
					showFile($rs);
					?>
				</span>
			</div>
		</div>

	</div> <!-- close main container -->

	<!-- Contact me -->
	<div class="footer">
		<h3>Contact me</h3>
		<p>E-mail parktesla@hotmail.com</p>
		<p><a href="login.php" class="showDataLink">Show data</a></p>
	</div>

</div> <!-- close fadeIn -->

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- The Close Button -->
  <span class="close">&times;</span>

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img_content">

  <!-- Modal Caption (Image Text) -->
  <div id="caption" class="caption"></div>
</div>

</body>
</html>
<?php
// close connection from database
mysqli_close($con);
?>
