<?php
  session_start();
  //file neede to chekc the security of the web page
  
  //function need to check if the session has been set
  function checkSession(){
    return isset($_SESSION['ID']);
  }

  function checkCookie(){
    if(isset($_COOKIE['LoggedIn'])){
      $_SESSION['ID'] = $_COOKIE['LoggedIn'];
    }
  }

  function checkAccesPermissions(){
    $userID = $_SESSION['ID'];
    $listID = $_GET['listID'];
    //get all the lists from the database and iterate thorugh hem to check if the current list id is there
    //create a new database connection
    $db = new mysqli('localhost', 'root', '', 'tododb') or die("Couldn't establish connection with the database");
    $result = $db->query("SELECT * FROM Lists WHERE(UserID = $userID)");
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
      if($row['ListID'] == $listID) return true;
    }
    return false;
  }
?>