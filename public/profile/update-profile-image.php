<?php 

include_once "../../config/config.php";
session_start();

if(isset($_POST['submit']) && isset($_FILES['image'])){
    // upload profile iamge here
    $image_file = $_FILES['image'];
    
    // Check image size (2MB = 2,097,152 bytes)
    if ($image_file['size'] > 2097152) {
        die("Image size must not exceed 2MB.");
    }
    
    // Move the uploadd file to a directory

    // generate image name
    $image = time() . '_' . $image_file['name'];
    // remove spaces from iamge
    $image = str_replace(' ', '_', $image);

    // move image

    $image_path = "../uploads/$image";

    move_uploaded_file($image_file['tmp_name'], $image_path);

    
    // get path


    $id = $_SESSION['user']['id'];
    $query = "SELECT * FROM profile WHERE user_id = $id";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) < 1){
        // Insert new profile
        $profileQuery = "INSERT INTO profile (image, user_id) VALUES ('$image_path', '$id' )";
        $profileResults = mysqli_query($conn, $profileQuery);

        if(!$profileResults) {
            die("Failed to insert profile: " . mysqli_error($conn));
        }

        header("location: index.php?results=profile-created");


    }


    // update image path in the database
    $query = "UPDATE profile SET image = '$image_path' WHERE user_id = $id";
    $result = mysqli_query($conn, $query);

    if(!$result) {
        die("Something went wrong" . mysqli_error($conn));
    }

    header('location: index.php?message=image-updated');


}

else {
    die("Error");
}