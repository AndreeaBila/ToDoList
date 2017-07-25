<?php
  session_start();
  //create database connection
  require "createConnection.php";
  //get the data from the user in a safe format
  $listTitle = strip_tags($_POST['listTitle']);
  $listDetails = strip_tags($_POST['listDetails']);
  $listDeadline = strip_tags($_POST['listDeadline']);
  $listID = strip_tags($_POST['listID']);
  $userID = $_SESSION["ID"];
  //check if the given name already exists
  $query = "SELECT count(*) AS Count FROM lists WHERE(Title = ? AND ListID != ? AND UserID = ?);";
  $stmt = $db->prepare($query);
  $stmt->bind_param("sss", $listTitle, $listID, $userID);
  $stmt->execute();
  $stmt->bind_result($count);
  $stmt->fetch();
  $stmt->close();
  if($count > 0){
    die("error");
  }else{
    //update the list
    $query = "UPDATE lists SET Title = ?, Description=?, DateCreated=? WHERE(ListID = ?);";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ssss", $listTitle, $listDetails, $listDeadline, $listID);
    $stmt->execute();
    exit("success");
  }
?>