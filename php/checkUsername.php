<?php
  //create a database connection
  require_once 'createConnection.php';
  //get the username form the front end
  $username = strip_tags($_GET['username']);
  //check the username agains the database and return
  $query = "SELECT count(*) AS Count FROM users WHERE(Username = ?)";
  $stmt = $db->prepare($query);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $stmt->bind_result($count);
  $stmt->fetch();
  $stmt->close();

  if($count != 0){
    echo "error";
  }else{
    echo "success";
  }
?>