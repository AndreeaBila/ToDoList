<?php
  //check the session or the cookie
  require "security.php";
  //call the cookie and set the session if it hasn't been set
  checkCookie();
  if(!checkSession()){
    header("Location: index.php");
  }
  if(!checkAccesPermissions()){
    header("Location: main.php");
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

    <div class="listWrapper text-center">
      <h1 class="pull-left">Your List Title</h1>
      <h3 class="pull-right">Your Deadline</h3>
      <div class="clear"></div>

      <hr>
      
      <h6 class="listDescription">Your list description Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore esse voluptates eius, corporis obcaecati molestias modi quasi 
        repellat eaque odio temporibus quisquam, similique velit, magni consequuntur architecto! Et, quia, distinctio. </h6>
      
      <br>
      
      <div class="listTasks">
        <div class="listComponent">
          <i class="fa fa-circle-thin fa-2x checkCircle" aria-hidden="true"></i>
          <p>Wash Dishes</p>
          <button type="submit" class="addNew btn btn-default btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button> 
          <div class="clear"></div>  
        </div>

        <div class="listComponent">
          <i class="fa fa-circle-thin fa-2x checkCircle" aria-hidden="true"></i>
          <p>Clean Room</p>
          <button type="submit" class="addNew btn btn-default btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button> 
          <div class="clear"></div>  
        </div>

        <div class="listComponent">
          <i class="fa fa-circle-thin fa-2x checkCircle" aria-hidden="true"></i>
          <p>Cook Dinner</p>
          <button type="submit" class="addNew btn btn-default btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button> 
          <div class="clear"></div>  
        </div>
      </div>

      <form class="form-inline addNewTaskForm">
        <div class="form-group">
          <input type="text" class="form-control" id="newTask" placeholder="New Task" required>
        </div>
        <div class="form-group">
          <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              Importance  
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
              <li><a href="#" class="low">Low</a></li>
              <li><a href="#" class="moderate">Moderate</a></li>
              <li><a href="#" class="high">High</a></li>
            </ul>
          </div>
        </div> 
    
        <button type="submit" class="addNew btn btn-default btn-success"><i class="fa fa-plus" aria-hidden="true"></i></button>   
      </form>
    </div>

    <?php
      include 'footer.php';
    ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../Bootstrap/js/bootstrap.min.js"></script> 

    <!-- The js script for this file -->
    <!--<script src="../js/main.js"></script>-->
  </body>
</html>
