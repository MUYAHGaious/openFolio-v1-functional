<?php 

include_once "Config.php";

class User extends Connection{
    private $name;
    private $level;
    private $description;

    private $conn;

    public function __construct(){
        parent::__construct();
       
        $this->conn = $this->connect();
    }
    // getters and seeters

    public function getName(){
        return $this->name;
    }

    public function getLevel(){
        return $this->level;
    }

    public function getDescription(){
        return $this->description;
    }


    public function setName($name){
        $this->name = $name;
    }

    public function setLevel($level){
        $this->level = $level;
    }

    public function setDescription($description){
        $this->description = $description;
    }
    

    public function getUsers(){

        $sql = "SELECT * FROM users";

        $result = $this->conn->query($sql);

        $users = $result->fetch_all(MYSQLI_ASSOC);

        return $users;
    }

    public function getUserById($Id){
        $sql = "SELECT * FROM users WHERE id=$Id";

        $result = $this->conn->query($sql);

        $Users = $result->fetch_all(MYSQLI_ASSOC);

        return $Users;
    }

}