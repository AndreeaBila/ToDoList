<?php
  session_start();
  //create a new database connection
  $db = new mysqli('localhost', 'root', '', 'tododb') or die("Couldn't establish the connection");
  //import the user file
  require_once "User.php";
  $userName = strip_tags($_POST['username']);
  $password = strip_tags($_POST['password']);
  $keep = (isset($_POST['logInCheckbox'])) ? true : false;
  //get the salt and the password from the database
  $query = "SELECT UserID, Salt, Password FROM Users WHERE(Username = ?)";
  $stmt = $db->prepare($query);
  $stmt->bind_param("s", $userName);
  $stmt->execute();
  $stmt->bind_result($userID, $salt, $dbPassword);
  $stmt->fetch();
  $stmt->close();
  //hash the given pasword
  if(isset($salt)){
    $password = sha1($salt."--".$password);
    if($dbPassword === $password){
      //set the user's session
      $_SESSION['ID'] = $userID;
      if($keep == true){
        //create a cookie with the current sesion id
        setcookie("LoggedIn", $userID, time()+3600);
      }
      echo "success";
    }else{
      echo "error";
    }
  }else{
    echo "error";
  }
?>