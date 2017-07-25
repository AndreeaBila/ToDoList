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

    <title>List Manager</title>

    <!--Bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- FontAwesome -->
    <script src="https://use.fontawesome.com/8dd7dadaef.js"></script> 

    <!-- My CSS -->
    <link href="../css/main.css" rel="stylesheet"> 
    <!-- Icon -->
     <link rel="shortcut icon" href="../img/small.png"> 

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

        <div class="pull-left leftHead">
          <h2><?php echo ucfirst($listInfo['Title']);?><button class="btn editListBtn" data-toggle='modal' data-target='.bs-example-modal-lg'><i class="fa fa-pencil-square-o fa-lg" data-toggle="tooltip" data-placement='bottom' title='Edit This List' aria-hidden="true"></i></button></h2>
          
          <h4 class="listDescription text-left"><?php echo ucfirst($listInfo['Description']);?></h4>
        </div>
        
        <div class="pull-right rightHead">
          <h2>Deadline</h2>

          <h4 id="deadline"><?php echo $listInfo['Deadline'];?></h4>
        </div>       

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
              $btnClass = 'btnUnchecked';
              $circleClass = 'fa-check';
              if($row['Status'] == true) {
                $className = 'taskAchieved';
                $btnClass = 'btn-success';
                $circleClass = 'fa-check';
              }
              echo "<div class='listComponent ".$className."' id='".$row['ItemID']."'>
                      <button class=' btn btn-default ".$btnClass." checkItemBtn'><i class='fa ".$circleClass." fa-2x' aria-hidden='true'></i></button>
                      <p class='".$row['Importance']."Importance'>".ucfirst($row['Content'])."</p>
                      <button class='btn btn-default btn-primary' data-toggle='modal' data-target='.changeItemModal'><i class='fa fa-pencil fa-2x' aria-hidden='true'></i></button>
                      <button type='submit' class='addNew btn btn-default btn-danger'><i class='fa fa-times fa-lg' aria-hidden='true'></i></button>
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
          <button type="submit" class="addNew btn btn-default btn-success"><i class="fa fa-plus fa-lg" aria-hidden="true"></i></button> 
          </div>  
        </form>
      
      <hr>

      <div class="listWrapper listBtns">
      <a class="pull-left btn btn-default backBtn" href="main"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>

      <button type="button" class="pull-right btn btn-default btn-danger" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-trash" aria-hidden="true"></i> Drop List</button>
      </div>

      <div class="clear"></div>

      <!-- Delete List modal -->
      <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header modal-delete">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="gridSystemModalLabel">Remove List</h4>
            </div>
            <div class="modal-body text-center">
              <p>Are you sure you want to delete this list?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn dismissBtn" id="btnCancelDelete" data-dismiss="modal">Dismiss</button>
              <button type="button" class="btn btn-danger" id="btnConfirmDelete" data-dismiss="modal">Delete</button> 
            </div>
          </div>
        </div>
      </div>

      <!-- Large modal -->
      <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header modal-edit">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="gridSystemModalLabel"><i class="fa fa-wrench" aria-hidden="true"></i> Edit List</h4>
            </div>
            <div class="modal-body">
              <form id='changeListForm'>
                <div class="form-group form-inline">
                  <label for="listName"><i class="fa fa-list-alt fa-lg" aria-hidden="true"></i></label>
                  <input type="text" class="form-control newListInput" name="listName" id="listName" placeholder="List Name" maxlength="25" required>
                </div>

                <div class="alert alert-info alert-dismissable alert-custom" id="createListAlert">
                  <a class="close" aria-label="close">&times;</a>
                  <strong>Sorry!</strong>You have to fill in all the details and a unique list name!
                </div>

                <div class="form-group form-inline">
                  <label for="listName"><i class="fa fa-info-circle fa-lg" aria-hidden="true"></i></label>
                  <input type="text" class="form-control newListInput" name="listDetails" id="listDetails" placeholder="Description" required>
                </div>
                
                <div class="form-group form-inline">
                  <label for="listName"><i class="fa fa-calendar-o fa-lg" aria-hidden="true"></i></label>
                  <input class="form-control newListInput" type="date" name="listDeadline" id="listDeadline" min="<?php echo date("Y-m-d") ?>" data-toggle="tooltip" data-placement="bottom" title="Pick a deadline" required>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn dismissBtn" data-dismiss="modal">Dismiss</button>
              <button type="button" class="btn btn-success" id="btnChangeList">Apply Changes</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Change Item modal -->
      <div class="modal fade changeItemModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header modal-edit">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="gridSystemModalLabel"><i class="fa fa-wrench" aria-hidden="true"></i> Edit Item</h4>
            </div>
            <div class="modal-body">
              <form class="addNewTaskForm text-center" id="changeItemForm">
                <div class="form-group">
                  <label for="taskChange"><i class="fa fa-list-ul fa-lg" aria-hidden="true"></i> </label>
                  <input type="text" name="changeTask" class="form-control" id="changeTask" placeholder="New Task" required>
                </div>
                <div class="form-group">
                  <label for="importanceChange"><i class="fa fa-bell fa-lg" aria-hidden="true"></i></label>
                  <select class="form-control" id='changeImportanceSelector' name="changeImportanceSelector" required>
                    <option value="placeholder" id="selectName" selected>Importance</option>
                    <option value="low" id="low">Low</option>
                    <option value="moderate" id="moderate">Moderate</option>
                    <option value="high" id="high">High</option>
                  </select>
                </div>
                <input type="hidden" name="changedItemID" id="changedItemID">
                
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn dismissBtn" data-dismiss="modal">Dismiss</button>
              <button type="button" class="btn btn-success" id="btnChangeItem">Apply Changes</button>
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- The js script for this file -->
    <script src="../js/list.js"></script>
  </body>
</html>
