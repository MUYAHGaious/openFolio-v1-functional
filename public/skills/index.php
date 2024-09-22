<?php

use Dotenv\Store\File\Paths;

include_once __DIR__ . "/../../includes/functions.php";
include_once __DIR__ . "/../../oop/classes/Skill.php";

$skilObj = new Skill();

$skills = $skilObj->getSkills();
?>



<div class="container col-md-12 mt-5  card p-5 bg-light">
    <h1>Skills</h1>



    <div class="row">


        <?php

        foreach ($skills as $skill) { ?>
        <div class="col-md-4">
            <div class="card shadow  text-white p-2  bgpurple-lighter">
                <?php echo $skill['name'] ?>
                <hr>
                <?php echo $skill['description'] ?>

                <hr>

                <!-- edit and delete buttons -->
                <div class="row">
                    <div class="col-md-6">
                        <a href="skills/edit.php?skillid=<?php echo $skill['id'] ?> " class="text-white" class="link"
                            style="text-decoration: none;"><i class="fas fa-pencil"></i></a>
                    </div>

                    <div class="col-md-6">
                        <a href="skills/delete.php?deleteid='<?php echo $skill['id'] ?>'" class="text-white"
                            class="link" style="text-decoration: none;"><i class="fas fa-trash text-danger"></i></a>
                    </div>
                </div>

            </div>

        </div>
        <?php } ?>


    </div>

    <!-- button to go to add skills -->



    <div class=" bgpurple text-white p-2 w-25 rounded mt-5 ">
        <a href="../public/skills/add.php" class="text-white" class="link" style="text-decoration: none;">Add Skill</a>
        <!-- added the changed to ../public/skills/add.php from  /skills/add.php -->
    </div>

</div>