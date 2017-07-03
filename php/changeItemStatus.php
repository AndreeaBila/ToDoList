<?php
  $db = new mysqli('localhost', 'root', '', 'tododb');
  $item = array('itemID' => strip_tags($_GET['itemID']), 'status' => strip_tags($_GET['status']));
  $query = "UPDATE Items SET Status = $item[status] WHERE ItemID = $item[itemID]";
  $db->query($query) or die('error');
  var_dump($query);
?>