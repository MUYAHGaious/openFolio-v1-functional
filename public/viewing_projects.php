
<?php
include "../config/config.php";
// $sql = "SELECT id, title, description, tech, image, url, user_id FROM projects where user_id=1";
$sql= "SELECT * FROM projects where user_id=0";
$result= mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="projectUploads/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container my-5 bg-lightpurple justify-content-center col-md-6 offset-md-3 shadow-md mt-5 p-5 rounded-5">
<div class="container">
<h1 class="text-center mb-5 text-white my-">My Projects</h1>
    <?php
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $img=$row['image'];
            $upimg= glob("projectUploads/".$img);
    ?>
        <div class="row">
            <h2 class="text-center mb-"><?php echo $row['title']?></h2><hr>
            <div class="col">
                <div class="col">
                    <img class="img rounded-5 img-fluid"
                    src="<?php echo $upimg[0] ?>" alt="">
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="row">
                     <span>Description:
                        <p class="text-muted"><?php echo $row['description']?></p></span>
                    </div>
                    <div class="row">
                        <span>Technologies used:
                        <p class="text-muted"><?php echo $row['tech']?></p></span>
                    </div>
                    <div class="row text-white my-5">
                        <div class="col">
                            <button> <a class="text-white" href="<?php echo $row['url']?>">view Project</a></button>
                        </div>
                        <div class="col">
                            <button> <a class="text-white" href="">edit Projects</a></button>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
    <?php                
            }
        }?>
    <div>
    <button class="projbutton justify-center text-white my-2"><a class="text-white" href="./add_project.php">Add New Project</a></button>
    </div>
    </div>
    </div>

</body>
</html>