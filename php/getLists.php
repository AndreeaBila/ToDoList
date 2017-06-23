<?php
  //create a database connection
  $db = new mysqli('localhost', 'root', '', 'tododb') or die("An unexpected error has occured");
  require_once "ToDoList.php";
  //create query to extract all the lists from the database associated with a user
  $userID = $_SESSION['ID'];
  $query = "SELECT * FROM Lists WHERE(UserID = $userID)";
  $result = $db->query($query);
  //iterate through the results and fetch eatch list as an object
  $listArray = array();
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $list = new ToDoList($row['ListID'], $row['Title'], $row['Status'], $row['DateCreated'], $row['Size'], $row['UserID']);
    $listCompletition = getListCompletition($list, $db);
    $percentage = (int)(($listCompletition * 100)/$list->getSize());
    array_push($listArray, $list);
    //call the create html item function
    createListBox($list, $percentage);
  }


  function getListCompletition(ToDoList $list, $db){
    //find the number of completed items from that todo list to establish a p0ercentage
    $listID = $list->getListID();
    $listUserID = $list->getUserID();
    $query = "SELECT count(*) AS Completed FROM Items WHERE(ListID = $listID AND UserID = $listUserID AND Status = 1)";
    $result = $db->query($query);
    $resultArr = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = $resultArr['Completed'];
    return $count;
  }

  function createListBox(ToDoList $list, $percentage){
    echo '<div class="listObject" id="'.$list->getListID().'">
            <div class="listSquare effect2">
              <button class="checkBtn pull-left" data-toggle="tooltip" data-placement="top" title="Mark as Completed" type="button"><i class="fa fa-check-square fa-lg" aria-hidden="true"></i></button>

              <button class="deleteBtn pull-right" type="button" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></button>

              <div class="clear"></div>

              <p class="listName">'.$list->getTitle().'</p>
            </div>
            <div id="'.$list->getListID().'" class="progress">
              <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="'.$percentage.'" aria-valuemin="0" aria-valuemax="100" style="width:'.$percentage.'%">
                '.$percentage.'% Complete
              </div>
            </div>
          </div>';
  }
?>