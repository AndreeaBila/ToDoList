<?php
  //create new database cnnection
  require_once 'createConnection.php';
  //get the list id and its status from the front end
  $listID = (int)(strip_tags($_GET['listID']));
  $listStatus = (boolean)(strip_tags($_GET['status']));

  //create a query to save the given information in the database
  $query = "UPDATE lists SET Status = ? WHERE(ListID = ?)";
  $stmt = $db->prepare($query);
  $stmt->bind_param("ss", $listStatus, $listID);
  $stmt->execute() or die("An unexpected error has occured!");
  $stmt->close();

?>