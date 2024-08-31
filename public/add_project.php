
<?php
include "../config/config.php";
session_start();
if(isset($_SESSION['message'])){?>
    <script>alert("<?php echo $_SESSION['message']; ?>");</script>
    <?php 
    unset($_SESSION['message']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <!-- <link rel="stylesheet" href="projectUploads/css/bootstrap.min.css"> -->
</head>
<body>
    <div class="container my-5 bg-lightpurple justify-content-center col-md-6 offset-md-3 shadow-md mt-5 p-5 rounded-5">
        <div class="container">
        <h1 class="text-center mb-5 text-white my-">Add Project</h1>
        <form action="add_project.php" method="post" enctype="multipart/form-data">
            <div class="form-floating mb-3">
                <input type="text" name="project_title" class="form-control" id="floatingName" placeholder="project title" required>
                <label for="floatingName">Project title</label>
            </div>
            <div class="form-floating mb-3">
                <textarea type="text" name="description" class="form-control" id="floatingName" placeholder="description" required></textarea>
                <label for="floatingName">description</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="tech_used" class="form-control" id="floatingName" placeholder="description" required>
                <label for="floatingName">technologies used</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="link" class="form-control" id="floatingName" placeholder="description" required>
                <label for="floatingName">link to the project</label>
            </div>
            <div class="form-floating mb-3">
                <input type="file" name="image_upload" src="" alt="Submit" class="form-control" id="floatingName">
                <label for="floatingName">image upload</label>
            </div>
            <button name="submit" type="submit" class="projbutton justify-center text-white my-2">Add Project</button>
        </form>
    </div>
    <div class="form-floating mb-3">
    </div>
<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['submit'])){
        $title=htmlspecialchars(trim($_POST['project_title']));
        $description=htmlspecialchars(trim($_POST['description'])) ;
        $tech=htmlspecialchars(trim( $_POST['tech_used']));
        $link=htmlspecialchars(trim($_POST['link']));
        $img= $_FILES['image_upload']['name'];
        if(!$img){
            $_SESSION['message']='file is empty please add project image';
            header("Location:add_project.php");
        }
        else{
            $tmp= explode(".", $img);
            $newfile=round(microtime(true)).'.'.end($tmp);
            $uploadpath="projectUploads/".$newfile;
            move_uploaded_file($_FILES['image_upload']['tmp_name'], $uploadpath);
            $all_projects=array($title, $description,$tech,$link,$img);
        $sql = "INSERT INTO `projects` (`id`, `title`, `description`, `tech`, `image`, `url`, `user_id`) 
        VALUES (NULL,'$title', '$description', '$tech', '$newfile', '$link','$id');";
        try {
            if (mysqli_query($conn, $sql)) {
            ?>
            <script>alert("New project created successfully");</script>
            <?php 
            header("location:viewing_projects.php");
            } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            }
            catch (mysqli_sql_exception){
                ?>
                <script>alert("project already exist");</script>
                <?php 
            }
        }
}
}
?>
</div>
</body>
</html>
