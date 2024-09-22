<?php
session_start();
include "../config/config.php";

$user_id = $_SESSION['user_id'];


if (empty($user_id)) {
    die("User ID is missing or invalid.");
}

// $user_id = 1;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['submit'])) {
        $name = htmlspecialchars(trim($_POST['name']));
        $title = htmlspecialchars(trim($_POST['Title']));
        $organisation = htmlspecialchars(trim($_POST['organisation']));
        $description = htmlspecialchars(trim($_POST['description']));
        $url = htmlspecialchars(trim($_POST['url']));
        $issuer = htmlspecialchars(trim($_POST['issuer']));
        $target_dir = "uploads/";
        $uploadOk = 1;
        $document_path = null;
        if (!is_dir($target_dir)) {
            if (!mkdir($target_dir, 0755, true)) {
                die("Failed to create upload directory.");
            }
        }
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $file_name = basename($_FILES["image"]["name"]);
            $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $unique_name = uniqid() . "." . $file_type;
            $target_file = $target_dir . $unique_name;
            if (!$_FILES["image"]["size"]) {
                echo "Please upload certificate image/doc!";
            }

            if ($_FILES["image"]["size"] > 5000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            } elseif (!in_array($file_type, ["pdf", "doc", "docx", "jpg", "png"])) {
                echo "Sorry, only PDF, DOC, DOCX, JPG, and PNG files are allowed.";
                $uploadOk = 0;
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $document_path = $target_file;
                } else {
                    echo "Sorry, there was an error uploading your file.";
                    $uploadOk = 0;
                }
            }
        }

        if ($uploadOk) {
            if ($document_path) {
                $sql = "INSERT INTO certifications (name, Title, organisation, description, url, image,issuer,user_id)
                    VALUES ('$name', '$title', '$organisation', '$description','$url', '$document_path', '$issuer', '$user_id')";
            } else {
                $sql = "INSERT INTO certifications (`name`, Title, organisation, description, url, image,issuer,user_id) 
                    VALUES ('$name', '$title', '$organisation', '$description','$url', '$document_path', '$issuer', '$user_id')";
        
            }

            if (mysqli_query($conn, $sql)) {
                echo "Certification details have been saved.";
                header('location:./dashboard.php');
            } else {
                echo "Error: " . mysqli_error($conn);
            }

            mysqli_close($conn);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Certification</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <style>
    .container {
        background-color: rgb(228, 177, 228);
        box-shadow: 0, 4px 10px rgba(0, 1, 2, 0.1);
        border-radius: 15px;

    }

    input[type="text"],
    input[type="date"],
    input[type="file"],
    textarea {
        width: 100%;
        margin: 10px 0;
        border: 3px;
        border-radius: 4px;
    }

    input[type="submit"] {
        width: 25%;
        font-size: small;
        padding: 5px;
        background-color: purple;
        color: white;
        border: none;
        border-radius: 15px;
        cursor: pointer;
        height: 30px;
        float: right;

    }

    input[type="submit"]:hover {
        background-color: rgb(218, 137, 228);
        width: 25%;
    }
    </style>
</head>

<body class="bgpurple">
    <div class="container col-md-6">
        <div class="row">
            <div class="col-md-10 offset-md-1 shadow-md bg-transparent mt-6 p-4">
                <h3 class="text-center mt-5">Add Certification</h3>

                <form action="addcertificate.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" class=" form-control" placeholder="Certificate name "
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="Title" class="form-control"
                            placeholder="Certification Title" required>
                    </div>
                    <div class="mb-3">
                        <label for="organisation">Organisation:</label>
                        <input type="text" id="organisation" name="organisation" class="form-control"
                            placeholder="Issuing Organisation" required>
                    </div>
                    <div class="mb-1">
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" class="form-control" placeholder="description"
                            required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="url">Url:</label>
                        <input type="text" id="url" name="url" class="form-control" placeholder="Certification url"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="document">Certification:</label>
                        <input type="file" id="document" name="image" class="form-control"
                            accept=".pdf,.doc,.docx,.jpg,.png" required>
                    </div>
                    <div class="mb-3">
                        <label for="issuer">Issuer:</label>
                        <input type="text" id="issuer" name="issuer" class="form-control" placeholder="Issuer "
                            required>
                    </div>

                    <input type="submit" name="submit" value=" SAVE">
                </form>
            </div>
        </div>
    </div>
</body>

</html>