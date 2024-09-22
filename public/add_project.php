<?php
include "../config/config.php";
session_start();

// Check if there's a session message to display
if(isset($_SESSION['message'])){
?>
<script>
alert("<?php echo $_SESSION['message']; ?>");
</script>
<?php 
    unset($_SESSION['message']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container my-5 bg-lightpurple justify-content-center col-md-6 offset-md-3 shadow-md mt-5 p-5 rounded-5">
        <div class="container">
            <h1 class="text-center mb-5 text-white">Add Project</h1>
            <form action="add_project.php" method="post" enctype="multipart/form-data">
                <div class="form-floating mb-3">
                    <input type="text" name="project_title" class="form-control" id="floatingName"
                        placeholder="Project title" required>
                    <label for="floatingName">Project title</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea name="description" class="form-control" id="floatingDescription" placeholder="Description"
                        required></textarea>
                    <label for="floatingDescription">Description</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="tech_used" class="form-control" id="floatingTech"
                        placeholder="Technologies used" required>
                    <label for="floatingTech">Technologies used</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="link" class="form-control" id="floatingLink"
                        placeholder="Link to the project" required>
                    <label for="floatingLink">Link to the project</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="file" name="image_upload" class="form-control" id="floatingImage">
                    <label for="floatingImage">Image upload</label>
                </div>
                <button name="submit" type="submit" class="btn btn-primary">Add Project</button>
            </form>
        </div>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['submit'])) {
                $title = htmlspecialchars(trim($_POST['project_title']));
                $description = htmlspecialchars(trim($_POST['description']));
                $tech = htmlspecialchars(trim($_POST['tech_used']));
                $link = htmlspecialchars(trim($_POST['link']));
                $img = $_FILES['image_upload']['name'];
                
                if (empty($img)) {
                    $_SESSION['message'] = 'File is empty. Please add a project image.';
                    header("Location: add_project.php");
                    exit();
                } else {
                    $tmp = explode(".", $img);
                    $newfile = round(microtime(true)) . '.' . end($tmp);
                    $uploadpath = "projectUploads/" . $newfile;
                    
                    if (move_uploaded_file($_FILES['image_upload']['tmp_name'], $uploadpath)) {
                        // Assuming user ID is retrieved from the session
                        $id = $_SESSION['user_id']; // Ensure this is set somewhere in your session
                        $sql = "INSERT INTO `projects` (`title`, `description`, `tech`, `image`, `url`, `user_id`) 
                                VALUES ('$title', '$description', '$tech', '$newfile', '$link', '$id')";

                        try {
                            if (mysqli_query($conn, $sql)) {
                                $_SESSION['message'] = "New project created successfully";
                                header("Location: viewing_projects.php");
                                exit();
                            } else {
                                echo "Error: " . mysqli_error($conn);
                            }
                        } catch (Exception $e) {
                            $_SESSION['message'] = "An error occurred: " . $e->getMessage();
                            header("Location: add_project.php");
                            exit();
                        }
                    } else {
                        $_SESSION['message'] = 'Failed to upload image. Please try again.';
                        header("Location: add_project.php");
                        exit();
                    }
                }
            }
        }
        ?>
    </div>
</body>

</html>