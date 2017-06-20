<?php
  //check the session or the cookie
  require "security.php";
  //call the cookie and set the session if it hasn't been set
  checkCookie();
  if(!checkSession()){
    header("Location: index.php");
  }
?>