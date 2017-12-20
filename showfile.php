<?php
require("connect.php");
function showFile($rs) {

  // check data is not empty
  if (mysqli_num_rows($rs) == 0) {
    echo "<center><h1>Folder is empty!</h1></center>";
  } else {

    echo "<div class='row'>";
    // show files
    $i = 0;
    while ($row = mysqli_fetch_array($rs)) {
      if ($i == 3) {
        echo "</div><div class='row'>";
        $i = 0;
      }
      $i++;
      // cut file name
      if (strlen($row[0]) > 20) {
        $cutname = substr($row[0], 0, 20)."...";
      } else {
        $cutname = $row[0];
      }
      //get ext of file
      $type = strtolower(pathinfo($row[0], PATHINFO_EXTENSION));
      //check if file is image file type style='padding: 4px; border: 4px solid white; border-radius: 5px;'
      if ($type == "jpg" || $type == "jpeg" || $type == "png" || $type == "gif" || $type == "bmp") {
        echo "<div class='col-sm-4'>
        <div class='redBorder polaroid'>
        <a href='upload/$row[0]'><img src='image_resize/$row[0]' style='height: auto; width: 200px' alt='$row[0]'></a><br>
        $cutname<br>
        <a href='confirm.php?filename=$row[0]&cutname=$cutname'><img src='pic/delete_icon.png' style='height: auto; width: 20px' alt='Delete'></a>
        </div>
        </div>";
      } else {
        echo "<div class='col-sm-4'>
        <div class='redBorder polaroid'>
        <a href='upload/$row[0]' style='text-decoration: none;'><img src='pic/new_page_icon.jpg' style='height: auto; width: 100px' alt='$row[0]'>&nbsp;<font color='black' size='3'><b>$type&nbsp;File</b></font></a><br>
        $cutname<br>
        <a href='confirm.php?filename=$row[0]&cutname=$cutname'><img src='pic/delete_icon.png' style='height: auto; width: 20px' alt='Delete'></a>
        </div>
        </div>";
      }
    }
    echo "</div>";
  }
}

?>
