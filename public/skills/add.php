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
        <select name="Proficiency">
            <option value="Novice">Novice</option>
            <option value="Intermediate"> Intermediate </option>
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

include  __DIR__ . "/../../includes/header.php";
session_start();


?>

        <link rel="stylesheet" href="../css/style.css">

        <body class="container">

            <?php 

if(isset($_SESSION['message'])){
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

            <form action="process.php" method="POST" class="form bgpurple p-5 mt-5 rounded">
                <h1 class="">Add Skills</h1>
                <div class="mt-3">
                    <label for="name">Skills</label><br>
                    <input type="text" name="name" id="name" placeholder="Add your skill" required class="form-control">
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
                    <textarea name="description" id="description" cols="20" rows="3" class="form-control"></textarea>
                </div>

                <div class="mt-3">
                    <input type="submit" name="submit" class="form-control bg-lightpurple text-white">
                </div>



            </form>



        </body>

</html>


</html>