<?php
  //start connection
  require "createConnection.php";
  //get the item elements from the client
  $itemData = array(
    "itemID" => strip_tags($_POST["changedItemID"]),
    "itemText" => strip_tags($_POST["changeTask"]),
    "itemImportance" => strip_tags($_POST["changeImportanceSelector"])
  );
  $query = "UPDATE items SET Content = ?, Importance = ? WHERE(ItemID = ?);";
  $stmt= $db->prepare($query);
  $stmt->bind_param("sss", $itemData['itemText'], $itemData['itemImportance'], $itemData['itemID']);
  $stmt->execute();
  $stmt->close();
?>