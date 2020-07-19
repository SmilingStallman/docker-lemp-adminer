<?php
  require_once 'login.php';

  //args passed in from login.php
  $conn = new mysqli($host, $user, $pass, $db);
  $conn->connect_error && die('Fatal DB connection error');
?>
