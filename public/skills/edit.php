<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include_once __DIR__.'/../../includes/functions.php';

if(!isset($_GET['skillid'])){
  header('location: ../dashboard.php?error=an-error-occured');
}

$skill = getSkillById($_GET['skillid']);

include_once __DIR__.'/../../includes/header.php';


?>

<link rel="stylesheet" href="../css/style.css">


<body class="container bgpurple">
  <form action="process.php" method="POST" class="form bgpurple p-5 mt-5 rounded" >
          <h1 class="">Edit Skill <?php echo $skill['id']; ?></h1>
          <input type="hidden" name="id" value="<?php echo $skill['id'] ?>">
          <div class="mt-3">
              <label for="name">skill</label><br>
              <input type="text" name="name" value="<?php echo $skill['name'] ?>"  required class="form-control">
          </div>

          <div class="mt-3">
              <select name="profficiency" name="" class="form-control">
                  <option value="">Select Profficient Level</option>
                  <option value="Novice">Novice</option>
                  <option value="Intermediate">Intermediate</option>
                  <option value="Advanced">Advanced</option>
                  <option value="Superior">Superior</option>
                  <option value="Expert">Expert</option>
              </select>
          </div>     



          <div class="mt-3">
              <label for="description">Description</label><br>
              <textarea name="description" id="description" cols="20" rows="3" class="form-control">
                <?php echo $skill['description']; ?>
              </textarea>
          </div>

          <div class="mt-3">
          <input type="submit" name="edit-skill" class="form-control bg-lightpurple text-white">
          </div>

       
  </form>
    

</body>
</html>