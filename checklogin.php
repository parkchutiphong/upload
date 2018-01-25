<?php
session_start();

// connect to data base
require("connect.php");

// reCAPTCHA secret key
define('SecretKey', '6LdLEUIUAAAAADxeUY3TrtB-uTzX0uSTVDMXw9zQ');

// allowed only POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $query_params = [
    'secret' => SecretKey,
    'response' => filter_input(INPUT_POST, 'g-recaptcha-response'),
    'remoteip' => $_SERVER['REMOTE_ADDR']
  ];
  $url = 'https://www.google.com/recaptcha/api/siteverify?'.http_build_query($query_params);
  $result = json_decode(file_get_contents($url), true);

  if ($result['success']) {

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

  } else {
    header("Location: login.php?msg=You need to enter reCAPTCHA first!");
  }
}


// close connection from database
mysqli_close($con);
