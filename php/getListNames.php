<?php
  session_start();
  require_once 'createConnection.php';
  $userID = $_SESSION['ID'];
  $result = $db->query("SELECT Title FROM lists WHERE(UserID = $userID)");
  $listNames = array();
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    array_push($listNames, $row['Title']);
  }

  echo json_encode($listNames);
?>