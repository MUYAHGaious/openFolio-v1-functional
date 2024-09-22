<?php
include "../config/config.php";
// $sql = "SELECT id, title, description, tech, image, url, user_id FROM projects where user_id=1";
$sql= "SELECT * FROM projects where user_id=0";
$result= mysqli_query($conn, $sql);

?>

<div class="container my-5 bg-light  col-md-12  mt-5 p-5 rounded-2">
    <h1 class="text-black">My Projects</h1>
    <?php
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $img=$row['image'];
            $upimg= glob("projectUploads/".$img);
    ?>
    <div class="row">
        <h2 class="text-center mb-"><?php echo $row['title']?></h2>
        <hr>
        <div class="col">

            <img class="img rounded-5 img-fluid" src="<?php echo $upimg[0] ?>" alt="">

        </div>
        <div class="col">

            <div class="row">
                <span>Description:
                    <p class="text-muted"><?php echo $row['description']?></p>
                </span>
            </div>
            <div class="row">
                <span>Technologies used:
                    <p class="text-muted"><?php echo $row['tech_used']?></p>
                </span>
            </div>

            <div class="row text-white my-5">
                <div class="col">
                    <button> <a class="text-white" href="<?php echo $row['link']?>">view Project</a></button>
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
<div class=" bgpurple text-white p-2 w-25 rounded mt-5 ">
    <a href="./addproject.php" class="text-white" class="link" style="text-decoration: none;">Add
        certificate</a>
</div>
</div>