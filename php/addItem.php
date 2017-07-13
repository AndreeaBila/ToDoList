<?php
  session_start();
  //create a new database connection
  require_once 'createConnection.php';

  //get the item info from the user
  $item = array('content' => strip_tags($_POST['newTask']), 'importance' => strip_tags($_POST['importanceSelector']), 'listID' => strip_tags($_POST['listID']));

  //insert the information in the database
  $date = date("Y/m/d");
  $query = "INSERT INTO items VALUES(NULL, ?, false, ?, ?, ?, ?)";
  $stmt = $db->prepare($query);
  $stmt->bind_param('sssss', $item['content'], $item['importance'], $date,$_SESSION['ID'], $item['listID']);
  $stmt->execute() or die('error');
  $stmt->close();
  $db->query("UPDATE lists SET Size = Size + 1 WHERE(ListID = $item[listID])");
  header('Location: list.php?listID='.$item['listID']);
?>