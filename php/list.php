<?php
  //check the session or the cookie
  require "security.php";
  //call the cookie and set the session if it hasn't been set
  checkCookie();
  if(!checkSession()){
    header("Location: index");
  }
  if(!checkAccesPermissions()){
    header("Location: main");
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
    <link href="../Bootstrap2/css/bootstrap.min.css" rel="stylesheet"> 

    <!-- FontAwesome -->
    <script src="https://use.fontawesome.com/8dd7dadaef.js"></script> 

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
    <div class="wrapper">
      <?php
        include 'header.php';
      ?>
      <?php
        //script needed to retrieve list information from the database
        //create a new database connection
        require 'createConnection.php';
        //get the list id from the url
        $listID = strip_tags($_GET['listID']);
        $query = "SELECT Title, Description, DateCreated FROM lists WHERE(ListID = ?);";
        $stmt = $db->prepare($query);
        $stmt->bind_param('s', $listID);
        $stmt->execute();
        $stmt->bind_result($listInfo['Title'], $listInfo['Description'], $listInfo['Deadline']);
        $stmt->fetch();
      ?>
      <div class="listWrapper text-center">
        <h1 class="pull-left"><?php echo ucfirst($listInfo['Title']);?></h1>
        <h3 class="pull-right"><?php echo $listInfo['Deadline'];?></h3>
        <div class="clear"></div>

        
        <h5 class="listDescription text-left pull-left"><?php echo ucfirst($listInfo['Description']);?></h5>

        <div class="clear"></div>

        <hr class="listHr">
        <br>
        
        <div class="listTasks">
          <?php
            //create a new database connection
            require 'createConnection.php';
            //get all the items from that partcullar list and show them
            $userID = $_SESSION['ID'];
            $listID = $_GET['listID'];
            $result = $db->query("SELECT * FROM items WHERE(UserID = $userID AND ListID = $listID)");
            $count = 0;
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
              $count++;
              $className = '';
              $circleClass = 'fa-circle-o';
              if($row['Status'] == true) {
                $className = 'taskAchieved';
                $circleClass = 'fa-check-circle-o';
              }
              echo "<div class='listComponent ".$className."' id='".$row['ItemID']."'>
                      <i class='fa ".$circleClass." fa-2x checkCircle' aria-hidden='true'></i>
                      <p class='".$row['Importance']."Importance'>".ucfirst($row['Content'])."</p>
                      <button type='submit' class='addNew btn btn-default btn-danger'><i class='fa fa-times' aria-hidden='true'></i></button>
                      <div class='clear'></div> 
                      </div>";
            }
          ?>
        </div>

        <?php
          if($count===0){
            echo '<div class="text-center defaultMsg">
                    <h3>Start adding items to this list</h3>
                  </div>';
          }
        ?>
      </div>
    
        

        <form action="addItem.php" method="POST" class="form-inline addNewTaskForm text-center">
          <div class="form-group">
            <input type="text" name="newTask" class="form-control" id="newTask" placeholder="New Task" required>
          
              <select id='importanceSelector' name="importanceSelector" required>
                <option value="placeholder" id="selectName" selected>Importance</option>
                <option value="low" id="low">Low</option>
                <option value="moderate" id="moderate">Moderate</option>
                <option value="high" id="high">High</option>
              </select>
          <input type="hidden" name="listID" id="listID" value=<?php echo $_GET['listID'] ?>>
          <button type="submit" class="addNew btn btn-default btn-success"><i class="fa fa-plus" aria-hidden="true"></i></button> 
          </div>  
        </form>
      
      <hr>

      <div class="listWrapper listBtns">
      <a class="pull-left btn btn-default backBtn" href="main.php"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>

      <button type="button" class="pull-right btn btn-default btn-danger" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-trash" aria-hidden="true"></i> Drop List</button>
      </div>

      <div class="clear"></div>

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

      <?php
        include 'footer.php';
      ?>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../Bootstrap2/js/bootstrap.min.js"></script> 

    <!-- The js script for this file -->
    <script src="../js/list.js"></script>
  </body>
</html>
