<?php
session_start();

// connect to data base
require("connect.php");

// for protect SQL Injection!!!
$username = mysqli_real_escape_string($con, $_POST['textusername']);
$password = mysqli_real_escape_string($con, $_POST['textpassword']);

// check username and password
$sql = "SELECT * FROM user WHERE (username = '$username' AND password = '$password')";
$rs = mysqli_query($con, $sql);

if (mysqli_num_rows($rs) == 1) {
  while ($row = mysqli_fetch_array($rs)) {
    $_SESSION['username'] = $row[0];
    header("Location: showdata.php");
  }
} else {
  header("Location: login.php?msg=Invalid Username or Password!");
}

// close connection from database
mysqli_close($con);
