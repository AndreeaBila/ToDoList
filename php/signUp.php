<?php
  session_start();
  //script needed to create a user instance on the server
  //create a new database connection
  require_once 'createConnection.php';

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
  $query = "INSERT INTO users VALUES(NULL, ?, ?, ?, ?, ?);";
  $stmt = $db->prepare($query);
  $userArray = array('username' => $user->getUserName(),
                    'password' => $user->getPassword(),
                    'salt' => $user->getSalt(),
                    'email' => $user->getEmail(),
                    'birth' => $user->getBirth());
  $stmt->bind_param("sssss", $userArray["username"], $userArray["password"], $userArray["salt"], $userArray["email"], $userArray["birth"]);
  $stmt->execute() or die("An error has occured!");
  $stmt->close();

  //obtain the user's id to set its session id
  $query = "SELECT UserID FROM users WHERE(Username = ?)";
  $stmt  = $db->prepare($query); 
  $stmt->bind_param('s', $userArray["username"]);
  $stmt->execute() or die('An error has occured!');
  $stmt->bind_result($_SESSION['ID']);
  $stmt->fetch();
  $stmt->close();
  //redirect the user to the main page
  header("Location: main");
?>