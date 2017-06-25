<?php
  session_start();
  $db = new mysqli('localhost', 'root', '', 'tododb');
  $userID = $_SESSION['ID'];
  $result = $db->query("SELECT Title FROM Lists WHERE(UserID = $userID)");
  $listNames = array();
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    array_push($listNames, $row['Title']);
  }

  echo json_encode($listNames);
?>