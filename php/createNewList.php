<?php
  session_start();
  $userID = $_SESSION['ID'];
  $db = new mysqli('localhost', 'root', '', 'tododb');
  //get the list information from the user and save it into a list object

  require_once 'ToDoList.php';
  $list = new ToDoList(0, strip_tags($_GET['listName']), false, strip_tags($_GET['listDeadline']), 0, $userID);
  var_dump($list);
  //add the listin the database
  $query = "INSERT INTO Lists VALUES(NULL, ?, ?, ?, ?, ?)";
  $stmt = $db->prepare($query);
  $stmt->bind_param("sssss", $list->title, $list->status, $list->dateCreated, $list->size, $list->userID);
  $stmt->execute();
  $stmt->close();
?>