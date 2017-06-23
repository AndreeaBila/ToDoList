<?php
  class List{
    private $listID;
    private $title;
    private $status;
    private $dateCreated;
    private $userID;

    function __construct($listID, $title, $status, $dateCreated, $userID){
      $this->listID=$listID;
      $this->title=$title;
      $this->status=$status;
      $this->dateCreated=$dateCreated;
      $this->userID=$userID;
    }

    //getters
    public getListID(){
      return $this->listID;
    }
    public getTitle(){
      return $this->title;
    }
    public getStatus(){
      return $this->status;
    }
    public getDateCreated(){
      return $this->dateCreated;
    }
    public getUserID(){
      return $this->userID;
    }

    //setters
    public setListID($listID){
      $this->listID = $listID;
    }
    public setTitle($title){
      $this->title = $title;
    }
    public setStatus($status){
      $this->status = $status;
    }
    public setDateCreated($dateCreated){
      $this->dateCreated = $dateCreated;
    }
    public setUserID($userID){
      $this->userID = $userID;
    }
  }
?>