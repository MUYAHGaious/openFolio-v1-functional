<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "Skill.php";


$skill = new Skill();

$skills = $skill->getSkills();
$response = [
    "success" => true,
    "data" => $skills
];



echo json_encode($response);


