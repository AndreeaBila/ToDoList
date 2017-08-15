<?php
  class User{
    public $userID;
    public $userName;
    public $password;
    public $salt;
    public $email;
    public $birth;

    function __construct($userID, $userName, $password, $salt, $email , $birth){
      $this->userID = $userID;
      $this->userName = $userName;
      $this->password = $password;
      $this->salt = $salt;
      $this->email = $email;
      $this->birth = $birth;
    }

    //getters
    public function getUserID(){
      return $this->userID;
    }
    public function getUserName(){
      return $this->userName;
    }
    public function getPassword(){
      return $this->password;
    }
    public function getSalt(){
      return $this->salt;
    }
    public function getEmail(){
      return $this->email;
    }
    public function getBirth(){
      return $this->birth;
    }

    //setters
    public function setUserID($userID){
      $this->userID = $userID;
    }
    public function setUserName($userName){
      $this->userName = $userName;
    }
    public function setPassword($password){
      $this->password = $password;
    }
    public function setSalt($salt){
      $this->salt = $salt;
    }
    public function setEmail($email){
      $this->email = $email;
    }
    public function setBirth($birth){
      $this->birth = $birth;
    }
  }
?>