<?php
  session_start();
  require "createConnection.php";
  require_once "User.php";
  $id = $_SESSION['ID'];
  $result = $db->query("SELECT * FROM users WHERE(UserID = $id)");
  $resultArr = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $user = new User(
    $id,
    $resultArr["Username"],
    null,
    null,
    $resultArr['Email'],
    $resultArr['Birth']);
  echo json_encode($user);
?>