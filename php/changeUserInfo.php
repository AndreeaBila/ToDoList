<?php
  session_start();
  require 'User.php';
  require 'createConnection.php';
  //get the data from the clinet
  $user = new User(
    $_SESSION['ID'],
    strip_tags($_POST["settingsName"]),
    strip_tags($_POST["settingsPassword"]),
    null,
    strip_tags($_POST["settingsEmail"]),
    strip_tags($_POST["settingsDob"])
  );

  if($user->password == "" || $user->password == null){
    $result = $db->query("SELECT Password, Salt FROM users WHERE(UserID = $user->userID)");
    $resultArr = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $user->password = $resultArr['Password'];
    $user->salt = $resultArr['Salt'];
  }else{
    $salt = sha1(time());
    $user->password = sha1($salt."--".$user->password);
    $user->salt = $salt;
  }

  $query = "UPDATE users SET Username = ?,  Password = ?, Salt = ?, Email = ?, Birth = ? WHERE(UserID = $user->userID)";
  $stmt = $db->prepare($query);
  $stmt->bind_param("sssss", $user->userName, $user->password, $user->salt, $user->email, $user->dob);
  $stmt->execute();
  $stmt->close();
?>