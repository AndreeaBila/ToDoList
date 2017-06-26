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
    $percentage = ($list->getStatus()) ? 100 : calculatePercentage($list, $db);
    array_push($listArray, $list);
    //call the create html item function
    createListBox($list, $percentage, $db);
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

  function createListBox(ToDoList $list, $percentage, $db){
    $addedClass = ($list->getStatus() == 1  || $percentage == 100) ? 'checked' : '';
    echo '<div class="listObject" id="list'.$list->getListID().'">
            <div class="listSquare effect2 '.$addedClass.'">
              <button class="checkBtn pull-left" data-toggle="tooltip" data-placement="top" title="Mark as Completed" type="button"><i class="fa fa-check-square fa-lg" aria-hidden="true"></i></button>

              <button class="deleteBtn pull-right" type="button" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></button>

              <div class="clear"></div>

              <p class="listName">'.$list->getTitle().'</p>

              <button class="editBtn pull-right" type="button"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></button>
            </div>
            <div class="progress">
              <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="'.$percentage.'" aria-valuemin="0" aria-valuemax="100" style="width:'.$percentage.'%">
                '.$percentage.'% Complete
              </div>
            </div>
            <input type="hidden" name="currentProgress" id="list'.$list->getListID().'" value="'.calculatePercentage($list, $db).'">
          </div>';
  }

  function calculatePercentage($list, $db){
    $listCompletition = getListCompletition($list, $db);
    return ($listCompletition == 0) ? 0 : (int)(($listCompletition * 100)/$list->getSize());
  }
?>