<?php
session_start();
// connect to database
require("connect.php");

// include to show file item
include("showfile.php");

$keyword = $_POST['keyword'];


$sql = "SELECT *
	FROM fileupload
	WHERE (filename LIKE '%$keyword%')
	ORDER BY file_id DESC";

$rs = mysqli_query($con, $sql);
// check data is not empty
if (mysqli_num_rows($rs) == 0) {
	echo "<br><div style=\"text-align: center; widht: 100%;\"><h1>No files found!</h1></div>";
} else {
	showFile($rs);
}
// close connection from database
mysqli_close($con);
?>
