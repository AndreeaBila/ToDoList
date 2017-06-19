<?php
  //script needed to create a user instance on the server
  //create a new database connection
  $db = new mysqli('localhost', 'root', '', 'tododb');

  //im[port the user file
  require_once "User.php";
  //get the information from the user  
  $user = new User(1, strip_tags($_POST['username']), strip_tags($_POST['password']), NULL, strip_tags($_POST['email']), strip_tags($_POST['signupDoB']));
  //create a random salt and hash the password
  $salt = sha1(time());
  $hash = sha1($salt."--".$user->getPassword());
  $user->setPassword($hash);
  $user->setSalt($salt);

  //add the user information to the database
  $query = "INSERT INTO Users VALUES(NULL, ?, ?, ?, ?, ?);";
  $stmt = $db->prepare($query);
  $stmt->bind_param("sssss", $user->getUserName(), $user->getPassword(), $user->getSalt(), $user->getEmail(), $user->getBirth());
  $stmt->execute() or die("An error has occured!");
  $stmt->close();

  //redirect the user to the main page
  header("Location: main.php");
?>