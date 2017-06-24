<?php
  //create new database cnnection
  $db = new mysqli('localhost', 'root', '', 'tododb');
  //get the list id and its status from the front end
  $listID = (int)(strip_tags($_GET['listID']));
  $listStatus = (boolean)(strip_tags($_GET['status']));
  var_dump($listID);

  //create a query to save the given information in the database
  $query = "UPDATE Lists SET Status = ? WHERE(ListID = ?)";
  $stmt = $db->prepare($query);
  $stmt->bind_param("ss", $listStatus, $listID);
  $stmt->execute() or die("An unexpected error has occured!");
  $stmt->close();

?>