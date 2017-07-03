<?php
  session_start();
  $userID = $_SESSION['ID'];
  $db = new mysqli('localhost', 'root', '', 'tododb');
  //get the list information from the user and save it into a list object

  require_once 'ToDoList.php';
  $list = new ToDoList(0, strip_tags($_GET['listName']), false, strip_tags($_GET['listDeadline']), 0, $userID);
  $description = strip_tags($_GET['listDetails']);
  //add the listin the database
  $query = "INSERT INTO Lists VALUES(NULL, ?, ?, ?, ?, ?, ?)";
  $stmt = $db->prepare($query);
  $stmt->bind_param("ssssss", $list->title, $description, $list->status, $list->dateCreated, $list->size, $list->userID);
  $stmt->execute();
  $stmt->close();

  //get the id of the list that has just been inserted
  $result = $db->query("SELECT ListID FROM Lists ORDER BY ListID DESC LIMIT 1");
  $resultArr = mysqli_fetch_array($result, MYSQLI_ASSOC);
  echo $resultArr['ListID'];
?>