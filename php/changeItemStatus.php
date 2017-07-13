<?php
  require_once 'createConnection.php';
  $item = array('itemID' => strip_tags($_GET['itemID']), 'status' => strip_tags($_GET['status']));
  $query = "UPDATE items SET Status = $item[status] WHERE ItemID = $item[itemID]";
  $db->query($query) or die('error');
  var_dump($query);
?>