<?php
$filename = $_GET['filename'];
$searchfilename = $_GET['searchfilename'];

// connect to data base
require("connect.php");

// cut file name
if (strlen($filename) > 10) {
    $cutname = substr($filename, 0, 10)."...";
} else {
    $cutname = $filename;
}

// upload file to server
if (unlink("upload/$filename")) {
    //get ext of file
    $type = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    //check if file is image file type and delete it
    if ($type == "jpg" || $type == "jpeg"  || $type == "png") { unlink("image_resize/$filename"); }

    // remove file name from data base
    $sql = "DELETE FROM fileupload WHERE(filename='$filename')";
    mysqli_query($con, $sql);

    // close connection from database
    mysqli_close($con);

    // go to index and report success
    header("Location: index.php?status=success&msg=File \"$cutname\" has been deleted&searchfilename=$searchfilename");
} else {
    header("Location: index.php?status=fail&msg=Can not delete<br>File \"$cutname\" !&searchfilename=$searchfilename");
}
