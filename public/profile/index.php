<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


/*
Using user login informatioon data stored within the session is applied using the link to this page.
*/
session_start();
include "../../config/config.php"; // Include your database connection

$id = $_SESSION['user']['id'];
// Fetching user_id based on the provided username and password
$query = "SELECT * FROM profile WHERE user_id='$id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    $profile = mysqli_fetch_assoc($result);

} else {
    $profile = [];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <style>
    body {
        background-color: whitesmoke;
        font-family: Arial, sans-serif;
    }

    .container {
        display: flex;
        width: 70%;
        margin: 100px auto;
        background-color: #2c003e;
        /* Very dark shade of purple */
        padding: 20px;
    }

    .profile-picture {
        flex: 1;
        text-align: center;
        margin-top: 50px;
    }

    /* .profile-picture img {
            width: 250px;
            height: 150px; 
            border-radius: 30%;
            border: 5px solid #fff;
            box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.5);
            transition: box-shadow 0.3s;
        } */

    .profile-picture img:hover {
        box-shadow: 0px 0px 15px rgba(255, 255, 255, 1);
    }

    .profile-picture button {
        display: block;
        margin: 20px auto;
        padding: 10px 20px;
        background-color: #7d00d9;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        box-shadow: inset 3px -3px 10px black;
        transition: 3ms ease-in;
    }

    .profile-picture button:active {
        box-shadow: none;
    }

    .profile-form {
        flex: 2;
        background-color: #e0e0e0;
        /* Light shade of gray */
        padding: 20px;
        border-radius: 20px;
        margin-left: 40px;
    }

    .profile-form input,
    .profile-form textarea {
        width: 95%;
        padding: 10px;
        margin-bottom: 15px;
        border: none;
        border-radius: 5px;
    }

    .profile-form button {
        padding: 10px 20px;
        background-color: #7d00d9;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn {
        margin-left: 20px;
    }

    .btn button[type="submit"] {
        margin-left: 45%;

    }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container">

        <div class="profile-picture">
            <form action="update-profile-image.php" method="post" enctype="multipart/form-data">

                <img class="img rounded-circle img-fluid " style="color:white"
                    src="<?php echo "".$profile['image'] ?? ""; ?>" alt="Profile Picture"
                    style="height: 200px; width: 200px">
                <input type="file" name="image">
                <button type="submit" name="submit">Upload</button>

            </form>

        </div>

        <div class="profile-form">

            <form action="validate_user_input.php" method="post">

                <input type="text" name="first_name" value="<?php echo $profile['first_name'] ?? ""; ?>"
                    placeholder="First Name">
                <input type="text" name="last_name" value="<?php echo $profile['last_name'] ?? ""; ?>"
                    placeholder="Last Name">
                <input type="text" name="phone" value="<?php echo $profile['phone'] ?? ""; ?>" placeholder="Contact">
                <textarea name="bio" placeholder="Bio"><?php echo $profile['bio'] ?? ""; ?></textarea>
                <div class="btn">
                    <button type="reset" class="me-4">Undo Changes</button>
                    <button type=" submit" name="update-profile" class="d-flex ms-4" style="float:right">Save</button>
                </div>


            </form>
        </div>
    </div>


</body>

</html>