<?php
include 'config.php';

if(isset($_GET['deleteid'])){

    $id=$_GET['deleteid'];
    $sql="DELETE FROM skills WHERE id=$id";
    if(mysqli_query($conn,$sql)){
        header('location:display.php');
    }
    else{
        die(mysqli_error($conn));
    }
}
?>