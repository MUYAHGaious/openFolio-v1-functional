<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "User.php";


// $ashley->move();
// echo $andrew->getName();

$user = new User();

// echo $user->getName() . "\n";
// echo $user->getDescription();

$users = $user->getUsers();
$response = [
    "success" => true,
    "data" => $users
];



echo json_encode($response);


