<?php
// connect to database
require("connect.php");

// include to show file item
include("showfile.php");

// include footer
include("footer.php");

?>

<html>
<head>
	<meta charset="utf-8">

	<title>Upload</title>

	<link rel="icon" href="pic/upload.png" type="image/x-icon">
	<link rel="shortcut icon" href="pic/upload.png" type="image/x-icon">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- animate css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

	<!-- my css -->
	<link href="css/style.css" rel="stylesheet">
	<link href="css/image_style.css" rel="stylesheet">

</head>
<body>
	<!-- for blur background picture -->
	<div class="bg-img"></div>

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
						<br><div style="text-align: center; widht: 100%;"><div id="picloader" class="loader"></div></div>
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
	<?php show_footer(strtolower(basename(__FILE__))); ?>

</div> <!-- close fadeIn -->

<!-- The Modal -->
<div id="imgModal" class="modal">

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img_content">

  <!-- Modal Caption (Image Text) -->
  <div id="caption" class="caption"></div>

	<!-- The Close Button -->
	<!-- <span class="close">&times;</span> -->

</div>

<!-- ------------------------------------------------------------------------------- -->


<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- awesome font -->
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
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

<!-- load main javascript -->
<script src="js/main.js"></script>

<!-- show box script -->
<script src="js/image_script.js"></script>

<!-- copy link to clipboard script -->
<script src="js/copy_text_to_clipboard.js"></script>

<!-- ------------------------------------------------------------------------------- -->

</body>
</html>
<?php
// close connection from database
mysqli_close($con);
?>
