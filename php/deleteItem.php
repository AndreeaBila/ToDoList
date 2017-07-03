<?php
  //create a new database connection
  $db = new mysqli('localhost', 'root', '', 'tododb');
  $itemID = $_POST['itemID'];

  $stmt = $db->prepare("UPDATE Lists SET Size = Size - 1 WHERE(ListID = (SELECT ListID FROM Items WHERE(ItemID = ?)))");
  $stmt->bind_param('s', $itemID);
  $stmt->execute();
  $stmt->close();

  $stmt = $db->prepare("DELETE FROM Items WHERE ItemID = ?");
  $stmt->bind_param('s', $itemID);
  $stmt->execute();
  $stmt->close();
?>