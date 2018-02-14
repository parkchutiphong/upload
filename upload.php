<?php
// connect to data base
require("connect.php");

// find IP address
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

//****************************************************************
//foreach ($_FILES["file1"]["tmp_name"] as $key=>$tmp_name) {
for ($key = 0; $key < count($_FILES["file1"]["name"]); $key++) {

  $userfile = $_FILES["file1"]["name"][$key];
  //print_r($_FILES["file1"]); echo "<br>";


  //get ext of file
  $type = strtolower(pathinfo($userfile, PATHINFO_EXTENSION));

  // Allow certain file formats;
  if(
    $type != "jpg" &&
    $type != "jpeg" &&
    $type != "png" &&
    $type != "bmp" &&
    $type != "gif"
  ) {
    // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    continue;
  }

  // Check file size
  if ($_FILES["file1"]["size"][$key] > 5000000) {
    continue;
    // header("Location: index.php?status=fail&msg=Sorry, your file is too large!");
  }

  // change file name if fond it on server
  for (;;) {
    $sql = "SELECT * FROM fileupload WHERE filename='$userfile'";
    $rs = mysqli_query($con, $sql);
    if (mysqli_num_rows($rs) != 0) {
      $userfile = rand(0, 9).$userfile;
    } else {
      break;
    }
  }

  // cut file name
  if (strlen($userfile) > 10) {
    $cutname = substr($userfile, 0, 10)."...";
  } else {
    $cutname = $userfile;
  }

  if (move_uploaded_file($_FILES["file1"]["tmp_name"][$key], "upload/$userfile")) {
    // add data to data base
    $sql = "INSERT INTO fileupload VALUES(null, '$ip', '".date('Y-m-d')."', '".date('H:i')."', '$userfile')";
    mysqli_query($con, $sql);

    //check if file is image file type
    if ($type == "jpg" || $type == "jpeg") {
      // resize image *.jpeg and *.jpg
      $images = "upload/$userfile";
      $new_images = "image_resize/$userfile";
      $width = 200; //*** Fix Width & Heigh (Autu caculate) ***//
      $size = getimagesize($images);
      $height = round($width*$size[1]/$size[0]);
      $images_orig = imagecreatefromjpeg($images);
      $photoX = imagesx($images_orig);
      $photoY = imagesy($images_orig);
      $images_fin = imagecreatetruecolor($width, $height);
      imagecopyresampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
      imagejpeg($images_fin, $new_images);
      imagedestroy($images_orig);
      imagedestroy($images_fin);
    } elseif ($type == "png") {
      // resize image *.png
      $images = "upload/$userfile";
      $new_images = "image_resize/$userfile";
      $width = 200; //*** Fix Width & Heigh (Autu caculate) ***//
      $size = getimagesize($images);
      $height = round($width*$size[1]/$size[0]);
      $images_orig = imagecreatefrompng($images);
      $photoX = imagesx($images_orig);
      $photoY = imagesy($images_orig);
      $images_fin = imagecreatetruecolor($width, $height);
      imagecopyresampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
      imagepng($images_fin, $new_images);
      imagedestroy($images_orig);
      imagedestroy($images_fin);
    }
    // go to index.php and report success
    header("Location: index.php?status=success&msg=Upload successfuly");
  } else {
    // go to index.php and report error
    header("Location: index.php?status=fail&msg=Please try again");
  }

} // end for ****************************************************************

// close connection from database
mysqli_close($con);
