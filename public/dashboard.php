<?php 

include "middleware.php" ; 
include "../includes/header.php";
?>

<link rel="stylesheet" href="./css/dashboard.css">
<link rel="stylesheet" href="./css/style.css">

<body class="bgpurple">
    <div class="navbar">
        <div class="navlinks">
            <ul class="active">
                <li><a href="profile/">profile</a></li>
                <li><a href="skills/">skills</a></li>
                <li><a href="display_certification.php">certificatins</a></li>
                <li><a href="viewing_projects.php">project</a></li>
                <li><a href="">logout</a></li>

            </ul>
        </div>
    </div>


    <?php 

    include "profile.php";
    // include "display_certification.php";
    include "skills/index.php";
    include "viewing_projects.php";
    
    // include "../includes/list_projects.php";

    ?>
</body>

</html>