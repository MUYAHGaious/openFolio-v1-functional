<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Skills</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="process.php" method="POST">
    <h1>Add Skills</h1>
               <label for="name">Skills</label><br>
               <input type="name" name="Skill" id="name" placeholder="Add your skill" required><br><br>
               <p>Proficiency</p>
                <select name="Proficiency" >
                    <option value="Novice">Novice</option>
                    <option value="Intermediate"> Intermediate  </option>
                    <option value="Advanced"> Advanced </option>
                    <option value="Superior"> Superior </option>
                    <option value="Expert"> Expert </option>
                </select>
               </p><br>
               <p>Experience Level</p>
                <select name="Experience">
                    <option value="1-6months"> 1-6months</option>
                    <option value="7-11 months"> 7-11 months</option>
                    <option value="1 Year"> 1 Year </option>
                    <option value="2 Years"> 2 years </option>
                    <option value="5 Years"> 5 Years </option>
                    <option value="10 Years"> 10 Years </option>
                    <option value="15 Years"> 15 Years </option>
                    <option value="More than 15 Years"> More than 15 Years</option>
                    </select><br><br><br>
               <label for="name">Description</label><br>
               <textarea name="Description" cols="20" rows="3"></textarea><br><br>
               <input type="submit" value="Save" class="save" name="Save"> 
              <?php 
              
   foreach ($_SESSION['Skill'] as $task):
    ?>
  <tr>
    <td><?php echo $task['Skill']; ?></td>
    <td><?php echo $task['Proficiency']; ?></td>
    <td><?php echo $task['Experience']; ?></td>
    <td><?php echo $task['Description']; ?></td>
    <td>
    </td>
</tr>
<?php endforeach;


?>   

    </form>
</body>
</html>