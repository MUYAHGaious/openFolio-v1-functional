<?php
session_start();
include "../config/config.php";


// $certificate_id = 10;
$certificate_id = isset($_GET['certificate_id']) ? $_GET['certificate_id']: 0;

if ($certificate_id <= 0) {
    die("Invalid certificate ID.");
}

$query = "SELECT * FROM certifications WHERE certificate_id = $certificate_id";
$certifications = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($certifications);

if (!$row) {
    die("Certificate not found.");
}

$title = $row['title'];
$organization = $row['organization'];
$date_earned = $row['date_earned'];
$description = $row['description'];
$certificate_file = $row['certificate_file'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['submit'])) {
        $title = htmlspecialchars(trim($_POST['title']));
        $organization = htmlspecialchars(trim($_POST['organization']));
        $date_earned = $_POST['date_earned'];
        $description = htmlspecialchars(trim($_POST['description']));
        $target_dir = "uploads/";
        $uploadOk = 1;
        $document_path = $certificate_file; 

        if (!is_dir($target_dir)) {
            if (!mkdir($target_dir, 0755, true)) {
                die("Failed to create upload directory.");
            }
        }

        if (isset($_FILES['certificate_file']) && $_FILES['certificate_file']['error'] == UPLOAD_ERR_OK) {
            $file_name = basename($_FILES["certificate_file"]["name"]);
            $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $unique_name = uniqid() . "." . $file_type;
            $target_file = $target_dir . $unique_name;

            if ($_FILES["certificate_file"]["size"] > 5000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            } elseif (!in_array($file_type, ["pdf", "doc", "docx", "jpg", "jpeg", "png", "gif"])) {
                echo "Sorry, only PDF, DOC, DOCX, JPG, JPEG, PNG, and GIF files are allowed.";
                $uploadOk = 0;
            } else {
                if (move_uploaded_file($_FILES["certificate_file"]["tmp_name"], $target_file)) {
                    $document_path = $unique_name; 
                } else {
                    echo "Sorry, there was an error uploading your file.";
                    $uploadOk = 0;
                }
            }
        }

        if ($uploadOk) {
            $sql = "UPDATE certifications 
                    SET title = '$title', organization='$organization', date_earned='$date_earned', description='$description', certificate_file='$document_path' 
                    WHERE certificate_id = $certificate_id";

            if (mysqli_query($conn, $sql)) {
                echo "Update successful!";
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
    <title>Edit Certification</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <style>
    .container {
        background-color: rgb(228, 177, 228);
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
                <h3 class="text-center mt-5">Edit Certification</h3>
                <form action="editcertificate.php?certificate_id=<?php echo $certificate_id; ?>" method="POST"
                    enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>"
                            class="form-control" placeholder="Certification Title" required>
                    </div>
                    <div class="mb-3">
                        <label for="organization">Organization:</label>
                        <input type="text" id="organization" name="organization"
                            value="<?php echo htmlspecialchars($organization); ?>" class="form-control"
                            placeholder="Issuing Organization" required>
                    </div>
                    <div class="mb-2">
                        <label for="date_earned">Date:</label>
                        <input type="date" id="date" name="date_earned" class="form-control"
                            value="<?php echo htmlspecialchars($date_earned); ?>" required>
                    </div>
                    <div class="mb-1">
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" class="form-control"
                            required><?php echo htmlspecialchars($description); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="certificate_file">Certificate File:</label>
                        <?php if ($certificate_file): ?>
                        <?php
                            $file_path = "uploads/" . $certificate_file;
                            $file_type = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
                            ?>
                        <?php if (in_array($file_type, ['jpg', 'jpeg', 'png', 'gif'])): ?>
                        <img src="<?= htmlspecialchars($file_path); ?>" alt="Certificate Image" width="200"
                            height="200">
                        <?php elseif (in_array($file_type, ['pdf'])): ?>
                        <iframe src="<?= htmlspecialchars($file_path); ?>" width="600" height="800"
                            frameborder="0"></iframe>
                        <?php else: ?>
                        <a href="<?= htmlspecialchars($file_path); ?>" target="_blank">View Certificate</a>
                        <?php endif; ?>
                        <?php endif; ?>
                        <input type="file" id="certificate_file" name="certificate_file" class="form-control"
                            accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif">
                    </div>
                    <input type="submit" name="submit" value="UPDATE">
                </form>
            </div>
        </div>
    </div>