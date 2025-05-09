<?php 

include_once "Config.php";

class Skill extends Connection{
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
    

    public function getSkills(){

        $sql = "SELECT * FROM skills";

        $result = $this->conn->query($sql);

        $skills = $result->fetch_all(MYSQLI_ASSOC);

        return $skills;
    }

    public function getSkillById($Id){
        $sql = "SELECT * FROM skills WHERE id=$Id";

        $result = $this->conn->query($sql);

        $skills = $result->fetch_all(MYSQLI_ASSOC);

        return $skills;
    }

    public function save(){
        $name = $this->getName();
        $level = $this->getLevel();
        $description = $this->getDescription();
        $user_id = $_SESSION['user']['id'];
        $sql = "INSERT INTO skills (name, profficiency_level, description, user_id) 
        VALUES 
        ('$name', '$level', '$description', '$user_id')";

         return $this->conn->query($sql);

    }


}