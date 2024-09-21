<?php 

class Connection {

    private $host;
    private $username;
    private $password;
    private $database;


    public function __construct(){

        $this->host = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->database = "openfolio";
    }

    public function connect(){
        $conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        return $conn;
    }



}