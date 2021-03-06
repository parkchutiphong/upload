<?php
$filename = $_GET['filename'];
if (isset($_GET['searchfilename'])) $searchfilename = $_GET['searchfilename']; else $searchfilename = "";
$cutname = $_GET['cutname'];

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

</head>
<body>
<!-- fadeIn -->
<div class="elementToFadeIn">
  <div class="container">

    <div class="row">
      <div class="col">
        <div style="text-align: center; padding: 40px;">
          <?php
          echo "<img src='pic/infomation_icon.png' style='width:100px; height:auto'>
          <h2>Delete \"$cutname\" ?</h2>
          <p>
          <a href='delete.php?filename=$filename&searchfilename=$searchfilename' class='confirm'>Yes</a>
          &nbsp;<b>or</b>&nbsp;
          <a href='index.php' class='confirm'>No</a>
          </p>";
          ?>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <?php
        //get ext of file
        $type = strtolower(pathinfo($_GET["filename"], PATHINFO_EXTENSION));
        //check if file is image file type
        if ($type == "jpg" || $type == "jpeg" || $type == "png" || $type == "gif" || $type == "bmp") {
          echo "<div class='polaroid'><img src='upload/".$_GET["filename"]."' style='height: auto; width: 100%;' alt='".$_GET["filename"]."' class='img-responsive'></div>";
        } else {
          echo "<br><div style=\"text-align: center; widht: 100%;\"><img src='pic/new_page_icon.jpg' style='height: auto; width: 100px' alt='$filename'>&nbsp;<font color='black' size='3'><b>$type&nbsp;File</b></font></div>";
        }
        ?>
      </div>
    </div>

  </div>

  <!-- Contact me -->
	<?php show_footer(strtolower(basename(__FILE__))); ?>

<!-- ------------------------------------------------------------------------------- -->
		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- load main javascript -->
    <script src="js/main.js"></script>
<!-- ------------------------------------------------------------------------------- -->
</div> <!-- close fadeIn -->
</body>
</html>
