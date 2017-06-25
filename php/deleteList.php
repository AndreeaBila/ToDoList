<?php
  $db = new mysqli('localhost', 'root', '', 'tododb');
  $listID = strip_tags($_GET['listID']);
  //first delete every item with the given list id
  $stmt = $db->prepare("DELETE FROM Items WHERE(ListID = ?)");
  $stmt->bind_param('s', $listID);
  $stmt->execute();
  $stmt->close();
  //then delete the list itself
  $stmt = $db->prepare("DELETE FROM Lists WHERE(ListID = ?)");
  $stmt->bind_param('s', $listID);
  $stmt->execute();
  $stmt->close();
?>