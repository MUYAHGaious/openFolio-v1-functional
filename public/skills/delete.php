<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include_once __DIR__ .  "/../../includes/functions.php";

$id = $_GET['deleteid'];

if(isset($_GET['deleteid'])){

   $result = deleteSkill($id);

   if(!$result){
        $_SESSION['error'] = "Could not delete skill";
        header('location: ../dashboard.php');
   }

   $_SESSION['message'] = "Skill deleted";
   header('location: ../dashboard.php');

    
}
?>