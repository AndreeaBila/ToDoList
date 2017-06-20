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
?>