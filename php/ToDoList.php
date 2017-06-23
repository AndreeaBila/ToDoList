<?php
  class ToDoList{
    private $listID;
    private $title;
    private $status;
    private $dateCreated;
    private $size;
    private $userID;

    function __construct($listID, $title, $status, $dateCreated, $size, $userID){
      $this->listID=$listID;
      $this->title=$title;
      $this->status=$status;
      $this->dateCreated=$dateCreated;
      $this->size = $size;
      $this->userID=$userID;
    }

    //getters
    public function getListID(){
      return $this->listID;
    }
    public function getTitle(){
      return $this->title;
    }
    public function getStatus(){
      return $this->status;
    }
    public function getDateCreated(){
      return $this->dateCreated;
    }
    public function getSize(){
      return $this->size;
    }
    public function getUserID(){
      return $this->userID;
    }

    //setters
    public function setListID($listID){
      $this->listID = $listID;
    }
    public function setTitle($title){
      $this->title = $title;
    }
    public function setStatus($status){
      $this->status = $status;
    }
    public function setDateCreated($dateCreated){
      $this->dateCreated = $dateCreated;
    }
    public function setSize($size){
      $this->size = $size;
    }
    public function setUserID($userID){
      $this->userID = $userID;
    }
  }
?>