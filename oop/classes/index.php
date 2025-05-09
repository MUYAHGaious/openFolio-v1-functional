<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "Animal.php";
include "Person.php";
include "Skill.php";

$ashley = new Person();
$andrew = new Person();

$ashley->setName("Ashley");
// $ashley->favcolor = "Purple";

$andrew->setName("Andrew");


// $ashley->move();
// echo $andrew->getName();

$skill = new Skill();

// echo $skill->getName() . "\n";
// echo $skill->getDescription();

$skills = $skill->getSkills();
$response = [
    "success" => true,
    "data" => $skills
];



echo json_encode($response);
