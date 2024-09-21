<?php
session_start();
include_once __DIR__ . "/../../oop/classes/Skill.php";

$skilObj = new Skill();
include_once "../../includes/functions.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if(isset($_POST['submit'])) {
        $skilObj->setName($_POST['name']);
        $skilObj->setLevel($_POST['profficiency']);
        $skilObj->setDescription($_POST['description']);


        try {
        
            $results = $skilObj->save();
            if(!$results){
                $_SESSION['message'] =  "Erro:".$sql."<br>". mysqli_error($conn);
                header("location: add.php");
            }
        
            $_SESSION['message'] = "Skill added";

            echo json_encode([
                "success" => true,
                "message" => "Skills Added"
            ]);
            exit;
            header("location: ../dashboard.php");
        
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    elseif(isset($_POST['edit-skill'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $profficiency = $_POST['profficiency'];
        $description = $_POST['description'];

        $results = editSkill($name, $profficiency, $description, $id);
        if(!$results){
            $_SESSION['message'] =  "Erro:".$sql."<br>". mysqli_error($conn);
            header("location: edit.php?id=$id");
        }

        $_SESSION['message'] = "Skill edited";
        header("location: ../dashboard.php");
    }
    
}

