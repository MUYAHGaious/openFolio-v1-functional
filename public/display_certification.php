<?php
include '../config/config.php';
// session_start();

$sql = "SELECT * FROM certifications WHERE user_id=0";
$result =mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>certifications</title>
    <link rel="stylesheet" href="./css/display_certificate.css">
</head>

<body>
    <h1>Certifications</h1>
    <?php 
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){?> <div class="container">
        <div class="certificates">
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
        </div>
        <?php
        }
        }?>
        <?php //endforeach?>


        <!-- <div class="certificate">
            <div class="img">
                <img src="./image/ER DIAGRAM (2).jpeg" alt="">
             </div>
             <div class="text">
                <p>title</p>
                <p>organisation</p>
                <p>Date</p>
                <div class="details">
                    <p class="explain">explain what the certificates entails..</p>
                </div>
             </div>
        </div>
    </div> -->
</body>

</html>