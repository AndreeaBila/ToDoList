<?php
  //check the session or the cookie
  require "security.php";
  //call the cookie and set the session if it hasn't been set
  checkCookie();
  if(!checkSession()){
    header("Location: index.php");
  }
?>

<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>To Do List</title>

    <!--Bootstrap-->
    <link href="../../Bootstrap2/css/bootstrap.min.css" rel="stylesheet"> 

    <!-- FontAwesome -->
    <link rel="stylesheet" href="../../FontAwesome/css/font-awesome.min.css"> 

    <!-- My CSS -->
    <link href="../css/main.css" rel="stylesheet"> 
    <!-- Icon -->
    <!-- <link rel="shortcut icon" href="../img/#"> -->

    <!-- JavaScript -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../js/#"></script> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!-- [if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif] -->        
  </head>
  <body>
    <?php
      include 'header.php';
    ?>
    
    <div class="box effect2">
      <button type="button" class="newListBtn"><i class="fa fa-plus fa-5x" aria-hidden="true"></i><p class="abc">Add new list</p></button>
    </div>
    
    <hr class="main-hr">

    <div class="yourLists">
      <h2>Manage your Lists</h2>  

      <div class="listSquare effect2">
        <div class="pull-left"><button type="button"><i class="fa fa-check-square fa-lg" aria-hidden="true"></i></button></div>

        <div class="pull-right"><button type="button"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></button></div>

        <div class="clear"></div>

        <p class="listName">shopping</p>
      </div>

    </div>

    <?php
      include 'footer.php';
    ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../Bootstrap/js/bootstrap.min.js"></script> 

    <!-- The js script for this file -->
    <script src="../js/login.js"></script>
  </body>
</html>
