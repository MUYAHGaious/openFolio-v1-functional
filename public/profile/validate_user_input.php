<?php
include_once "../../config/config.php";
include "index.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize input
    $first_name = htmlspecialchars(trim($_POST['first_name']));
    $last_name = htmlspecialchars(trim($_POST['last_name']));
    $bio = htmlspecialchars(trim($_POST['bio']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    
    // Validate phone number length
    // if (strlen($phone) > 13) {
    //     die("Phone number must not exceed 13 characters.");
    // }


    // check if profile exists in the profiles table
    $query = "SELECT * FROM profile WHERE user_id = $id";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) < 1){
        // Insert new profile
        $profileQuery = "INSERT INTO profile (first_name, last_name, bio, phone, user_id) VALUES ('$first_name', '$last_name', '$bio', '$phone', '$id' )";
        $profileResults = mysqli_query($conn, $profileQuery);

        if(!$profileResults) {
            die("Failed to insert profile: " . mysqli_error($conn));
        }

        header("location: index.php?results=profile-created");


    }
    // Update user data in the database
    $query = "UPDATE profile SET first_name ='$first_name', last_name = '$last_name', bio = '$bio', phone = '$phone' WHERE user_id = '$id'";
    $result = mysqli_query($conn, $query);
    if(!$result) {
        die("Failed to update profile: " . mysqli_error($conn));
    }

    // Redirect back to the profile page
   $_SESSION['message'] = "Profile updated successfully!";

   header('location: index.php');
}
