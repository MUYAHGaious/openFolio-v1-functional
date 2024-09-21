<?php 

include "middleware.php" ; 
include "../includes/header.php";
include "../includes/functions.php";
?>

<link rel="stylesheet" href="./css/dashboard.css">
<link rel="stylesheet" href="./css/style.css">
<body class="bgpurple">

<?php 

if(isset($_SESSION['message'])){
    echo $_SESSION['message'];
    unset($_SESSION['message']);
    
}

if(isset($_SESSION['error'])){
    echo $_SESSION['error'];
    unset($_SESSION['error']);
    
}

?>
    <div class="navbar">
        <div class="navlinks">
            <ul class="active">
                <li><a href="profile/">profile</a></li>
                <li><a href="">skills</a></li>
                <li><a href="">certificatins</a></li>
                <li><a href="">project</a></li>
                <li><a href="">logout</a></li>

            </ul>
        </div>
    </div>
    

    <?php 



    include "profile.php";

    $skills = getSkills();
    include "skills/index.php";
    // include "../includes/list_projects.php";

    ?>
</body>
</html>