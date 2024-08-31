<?php
// include "changes.php";
// include "../config/config.php";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "update";
// Create connection
$conn = new mysqli($servername,  $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " 
        . $conn->connect_error);
}
$query = "SELECT id, title, Profiency, level, description FROM editskills where id=2";
$res = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($res);
if($row) {
    $id= $row['id'];
    $title = $row['title'];
    $Proficiency  = $row['Profiency'];
    $level= $row['level'];
    $description = $row['description'];
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
    <form action="editskills.php"  method= "POST">
<label>Tilte</label><br>
<input type="text" placeholder="<?php echo $title ?>" name="title"></input><br>
<label>Profiency</label><br>
<input type="text" placeholder="<?php echo $Proficiency ?>" name="proficiency"></input><br>
<label>Level</label><br>
<input type="text" placeholder="<?php echo $level ?>" name="level"></input><br>
<label>Description</label><br>
<input type="text" placeholder="<?php echo $description?>" name="description"></input><br>
<input type="hidden" name="id" value="<?php echo $id ?>">
<input type="submit" name="save_changes" value="save changes"></input>
</form>
</body>
</html>
<?php
if(isset($_POST['save_changes'])){
    $id= $_POST['id'];
    $uptitle= $_POST['title'];
    $upproficiency= $_POST['proficiency'];
    $uplevel= $_POST['level'];
    $updescription= $_POST['description'];

    $query = "UPDATE editskills SET title='$uptitle', Profiency='$upproficiency', level='$uplevel', description='$updescription' WHERE id='$id' ";
    if(mysqli_query($conn, $query)){
        echo 'update successful';
    header("location: editskills.php");

    }
  else{
    echo 'try again';
    header("location: editskills.php");
  }
}
// print_r($row);
?>