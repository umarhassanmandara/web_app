<?php

//all mechanism started from here

class database{
    private $hostdb = "localhost";
    private $userdb = "root";
    private $passdb = "";
    private $namedb = "php";
    public $pdo;

    public function __construct(){
        if(!isset($this->pdo)){
            try{
                $link = new PDO("mysql:host=".$this->hostdb.";dbname=".$this->namedb, $this->userdb, $this->passdb);
                $this->pdo = $link;
            }catch(PDOException $e){
                die("Failed to connect with database".$e->getMessage());
            }
        }
    }
}