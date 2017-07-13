<?php
  //create a new database connection
  require 'createConnection.php';
  $itemID = $_POST['itemID'];

  $stmt = $db->prepare("UPDATE lists SET Size = Size - 1 WHERE(ListID = (SELECT ListID FROM items WHERE(ItemID = ?)))");
  $stmt->bind_param('s', $itemID);
  $stmt->execute();
  $stmt->close();

  $stmt = $db->prepare("DELETE FROM items WHERE ItemID = ?");
  $stmt->bind_param('s', $itemID);
  $stmt->execute();
  $stmt->close();
?>