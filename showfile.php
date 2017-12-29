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
      if (strlen($row["filename"]) > 20) {
        $cutname = substr($row["filename"], 0, 20)."...";
      } else {
        $cutname = $row["filename"];
      }
      //get ext of file
      $type = strtolower(pathinfo($row["filename"], PATHINFO_EXTENSION));
      //check if file is image file type style='padding: 4px; border: 4px solid white; border-radius: 5px;'
      if ($type == "jpg" || $type == "jpeg" || $type == "png" || $type == "gif" || $type == "bmp") {
        echo "<div class='col-sm-4'>
        <div class='redBorder polaroid'>
        <img src='image_resize/{$row["filename"]}' style='height: auto; width: 200px' alt='{$row["filename"]}' id='img{$row["file_id"]}' class='myImg' onclick='show_image( \"img".$row["file_id"]."\", \"upload/".$row["filename"]."\" )'><br>
        $cutname<br>
        <a href='confirm.php?filename={$row["filename"]}&cutname=$cutname'><img src='pic/delete_icon.png' style='height: auto; width: 20px' alt='Delete'></a>
        </div>
        </div>";
      } else {
        echo "<div class='col-sm-4'>
        <div class='redBorder polaroid'>
        <a href='upload/{$row["filename"]}' style='text-decoration: none;'><img src='pic/new_page_icon.jpg' style='height: auto; width: 100px' alt='{$row["filename"]}'>&nbsp;<font color='black' size='3'><b>$type&nbsp;File</b></font></a><br>
        $cutname<br>
        <a href='confirm.php?filename={$row["filename"]}&cutname=$cutname'><img src='pic/delete_icon.png' style='height: auto; width: 20px' alt='Delete'></a>
        </div>
        </div>";
      }
    }
    echo "</div>";
  }
}

?>
