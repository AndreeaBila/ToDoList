<?php
  $db = new mysqli('localhost', 'root', '', 'tododb');
  $result = $db->query("SELECT * FROM Lists");
  require_once 'ToDoList.php';
  $listArr
?>