<?php
session_start();
include "../../config/config.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $Skill = $_POST['Skill'];
    $Proficiency = $_POST['Proficiency'];
    $Experience = $_POST['Experience'];
    $Description = $_POST['Description'];
//adding into the database

//  $db_server="localhost";
//  $db_user="root";
//  $db_pss="";
//  $db_name="portfolio_db";
//  $conn="";
// try{
//     $conn= mysqli_connect($db_server,$db_user,$db_pss,$db_name);
// }
// catch(mysqli_sql_exception){
//     echo " Database not connected <br>" ;
// }
// if($conn){
//     echo " Database connected";
// } ;
try {
    $sql= "INSERT INTO skills (Skill, Proficiency, Experience, Description)
    VALUES ('$Skill','$Proficiency','$Experience','$Description')";
  if(mysqli_query($conn, $sql)){
    echo "<br> New record created successfully";
}
else{
    echo "Erro:".$sql."<br>". mysqli_error($conn);
    echo "connection error";
}
}
catch (mysqli_sql_exception $e) {
    echo "Error: " . $sql . "<br>" . $e->getMessage();
    echo "Skill already exists";
}
}


 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <button type="add" class=add> <a style="" href="index.php">Add+</a></button>
    <style>
    .add {
        color: white;
        background-color: purple;
        border: 2px solid purple;
        border-radius: 11%;
        margin-left: 65%;
        margin-bottom: -80%;
        text-decoration: none;

    }

    .add:hover {
        color: white;
        font-weight: bolder;
        background-color: rgba(214, 45, 200, 0.349);
        border: 2px solid rgba(214, 45, 200, 0.349);
        border-radius: 11%;
        text-decoration: none;

    }
    </style>
</body>

</html>
<?php
?>