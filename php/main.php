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
      <button type="button" class="newListBtn" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-plus fa-5x" aria-hidden="true"></i><p class="abc">Add new list</p></button>
    </div>
    
    <hr class="hrDefault">

    <div class="yourLists">
      <h2>Manage your Lists</h2>

      <!-- call the create lists file -->
      <?php
        include 'getLists.php';
      ?>     
    </div>

    <!-- Delete List modal -->
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="gridSystemModalLabel">Remove List</h4>
          </div>
          <div class="modal-body text-center">
            <p>Are you sure you want to delete this list?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" id="btnCancelDelete" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="btnConfirmDelete" data-dismiss="modal">Delete</button> 
          </div>
        </div>
      </div>
    </div>

    <!-- Large modal -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="gridSystemModalLabel">Create New List</h4>
          </div>
          <div class="modal-body">
            <form id='createListForm'>
              <div class="form-group form-inline">
                <label for="listName"><i class="fa fa-list-alt fa-lg" aria-hidden="true"></i></label>
                <input type="text" class="form-control newListInput" name="listName" id="newListName" placeholder="List Name" required>
              </div>

              <div class="alert alert-info alert-dismissable alert-custom" id="createListAlert">
                <a class="close" aria-label="close">&times;</a>
                <strong>Sorry!</strong>You have to fill in all the details and a unique list name!
              </div>

              <div class="form-group form-inline">
                <label for="listName"><i class="fa fa-info-circle fa-lg" aria-hidden="true"></i></label>
                <input type="text" class="form-control newListInput" name="details" id="listDetails" placeholder="Description" required>
              </div>
              
              <div class="form-group form-inline">
                <label for="listName"><i class="fa fa-calendar-o fa-lg" aria-hidden="true"></i></label>
                <input class="form-control newListInput" type="text" name="deadline" id="listDeadline" onfocus="(this.type='date')" placeholder="Deadline" min="2017-06-22" required>
              </div> 
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Dismiss</button>
            <button type="button" class="btn btn-success" id='btnCreateList'>Create List</button>
          </div>
        </div>
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
    <script src="../js/main.js"></script>
  </body>
</html>
