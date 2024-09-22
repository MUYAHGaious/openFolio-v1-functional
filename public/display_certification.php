<?php
include '../config/config.php';
// session_start();

$sql = "SELECT * FROM certifications WHERE user_id=0";
$result =mysqli_query($conn, $sql);

?>

<div class="container col-md-12 mt-5  card p-5 bg-light">
    <h1>Certifications</h1>
    <?php 
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){?>

    <div class="certificates">
        <div class="card shadow  text-white p-2  bgpurple-lighter">
            <div class="img">
                <img src="./image/ER DIAGRAM (2).jpeg" alt="">
            </div>
            <div class="text">
                <p><?php echo $row['Title']?></p>
                <p><?php echo $row['date']?></p>
                <p><?php echo $row['organisation']?></p>
                <div class="details">
                    <p class="explain">explain what the certificates entails..</p>
                    <p><?php echo $row['description']?></p>

                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <a href="skills/editcertificate.php?certificateid=<?php echo $certificate_id ?> " class="text-white"
                        class="link" style="text-decoration: none;"><i class="fas fa-pencil"></i></a>
                </div>

                <div class="col-md-6">
                    <a href="skills/deletecertificate.php?deleteid='<?php echo  $certificate_id ?>'" class="text-white"
                        class="link" style="text-decoration: none;"><i class="fas fa-trash text-danger"></i></a>
                </div>
            </div>
        </div>

    </div>

    <?php
        }
        }?>
    <div class=" bgpurple text-white p-2 w-25 rounded mt-5 ">
        <a href="./addcertificate.php" class="text-white" class="link" style="text-decoration: none;">Add
            certificate</a>
    </div>
</div>