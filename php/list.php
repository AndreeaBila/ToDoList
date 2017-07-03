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

      
      <h6 class="listDescription text-left pull-left">Your list description THis is a list of shit i have to buy cuz I need it soon for stuff that I must dos </h6>

      <div class="clear"></div>

      <hr class="listHr">
      <br>
      
      <div class="listTasks">
        <?php
          //create a new database connection
          $db = new mysqli('localhost', 'root', '', 'tododb');
          //get all the items from that partcullar list and show them
          $userID = $_SESSION['ID'];
          $listID = $_GET['listID'];
          $result = $db->query("SELECT * FROM Items WHERE(UserID = $userID AND ListID = $listID)");
          while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            echo "<div class='listComponent' id='".$row['ItemID']."'>
                    <i class='fa fa-circle-o fa-2x checkCircle' aria-hidden='true'></i>
                    <p class='".$row['Importance']."Importance'>".$row['Content']."</p>
                    <button type='submit' class='addNew btn btn-default btn-danger'><i class='fa fa-times' aria-hidden='true'></i></button>
                    <div class='clear'></div> 
                    </div>";
          }
        ?>
      </div>
    </div>
   


      <form action="addItem.php" method="POST" class="form-inline addNewTaskForm text-center">
        <div class="form-group">
          <input type="text" name="newTask" class="form-control" id="newTask" placeholder="New Task" required>
        </div>
            <select id='importanceSelector' name="importanceSelector">
              <option value="placeholder" id="selectName" disabled selected>Importance</option>
              <option value="low" id="low">Low</option>
              <option value="moderate" id="moderate">Moderate</option>
              <option value="high" id="high">High</option>
            </select>
        <input type="hidden" name="listID" id="listID" value=<?php echo $_GET['listID'] ?>>
        <button type="submit" class="addNew btn btn-default btn-success"><i class="fa fa-plus" aria-hidden="true"></i></button>   
      </form>
    
    <hr>

    <div class="listWrapper listBtns">
    <a class="pull-left btn btn-default backBtn" href="main.php"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back To My Lists</a>

    <button type="button" class="pull-right btn btn-default btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Drop List</button>
    </div>

    <div class="clear"></div>

    <?php
      include 'footer.php';
    ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../Bootstrap/js/bootstrap.min.js"></script> 

    <!-- The js script for this file -->
    <script src="../js/list.js"></script>
  </body>
</html>
