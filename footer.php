<?php
function show_footer($page) {
  echo '
    <div class="footer">
    <p>
      <span class="head_footer">
        <span class="glyphicon">&#xe101;</span>&nbsp;Contact me
      </span>
    </p>
    <p><i class="fas fa-envelope"></i>&nbsp;parktesla@hotmail.com</p>
    <p><a href="https://www.facebook.com/parktesla" target="_blank"><i class="fab fa-facebook" style="color: #dc143c;"></i></a>
    <a href="https://twitter.com/parktesla" target="_blank"><i class="fab fa-twitter" style="color: #dc143c;"></i></a>
    <a href="https://www.instagram.com/parktesla" target="_blank"><i class="fab fa-instagram" style="color: #dc143c;"></i></a>
    <a href="https://www.youtube.com/channel/UC3Js-GfmTIClfq7OiqFtSWg?view_as=subscriber" target="_blank"><i class="fab fa-youtube" style="color: #dc143c;"></i></a></p>
    ';
    if (
      $page != "login.php" &&
      $page != "showdata.php"
    ) {
      echo '<p><a href="login.php" class="showDataLink">Show data</a></p>';
    }
  echo '</div>';
}
