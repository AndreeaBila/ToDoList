<?php
  require 'createConnection.php';
  $listID = strip_tags($_GET['listID']);
  //first delete every item with the given list id
  $stmt = $db->prepare("DELETE FROM items WHERE(ListID = ?)");
  $stmt->bind_param('s', $listID);
  $stmt->execute();
  $stmt->close();
  //then delete the list itself
  $stmt = $db->prepare("DELETE FROM lists WHERE(ListID = ?)");
  $stmt->bind_param('s', $listID);
  $stmt->execute();
  $stmt->close();
?>