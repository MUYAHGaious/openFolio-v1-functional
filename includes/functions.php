<?php 
include_once  __DIR__ .'/../config/config.php';

/**
 * @return array skills
 */
function getSkills(){
    global $conn;

    $sql = "SELECT * FROM skills";

    $result = mysqli_query($conn, $sql);

    $skills = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $skills;
}


/**
 * 
 * @param mixed $name
 * @param mixed $level
 * @param mixed $description
 * @param int $user_id
 * @return bool|mysqli_result
 */
function addSkill($name, $level, $description, $user_id){
    global $conn;

    $sql = "INSERT INTO skills (name, profficiency_level, description, user_id) VALUES ('$name', '$level', '$description', '$user_id')";
    $results = mysqli_query($conn, $sql);

    return $results;

}

/**
 * deletes a skill by a give id
 * @param  int $id The id of the skill
 * @return  bool|mysqli_result
 */

function deleteSkill($id){
    global $conn;

    $sql = "DELETE FROM skills WHERE id = $id";

    $results = mysqli_query($conn, $sql);

    return $results;
}

function getSkillById($id){
    
    global $conn;

    $sql = "SELECT * FROM skills WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $skill = mysqli_fetch_assoc($result);

    return $skill;
}

function editSkill($name, $level, $description, $id){

    global $conn;

    $sql = "UPDATE skills SET name = '$name', profficiency_level = '$level', description = '$description' WHERE id = $id";

    $results = mysqli_query($conn, $sql);

    return $results;
}