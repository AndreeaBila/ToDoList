<?php
  //create a database connection
  $db = new mysqli('localhost', 'root', '', 'tododb') or die("An unexpected error has occured");
  require "List.php";
  //create query to extract all the lists from the database associated with a user
  $userID = $_SESSION['ID'];
  $query = "SELECT * FROM Lists WHERE(UserID = $userID)";
  $result = $db->query($query);
  //iterate through the results and fetch eatch list as an object
  $listArray = array();
  // while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
  //   $list = new List($row['ListID'], $row['Title'], $row['Status'], $row['DateCreated'], $row['UserID']);
  //   $listArray->push($list);
  // }

  $listArray = json_encode($listArray);
  echo $listArray;
?>