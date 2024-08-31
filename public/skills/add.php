<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Skills</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="" method="POST">
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


    </form>
</body>

</html><?php
session_start();
include_once '../../config/config.php'; // Include your database configuration

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $skill = mysqli_real_escape_string($conn, $_POST['Skill']);
    $proficiency = mysqli_real_escape_string($conn, $_POST['Proficiency']);
    $experience = mysqli_real_escape_string($conn, $_POST['Experience']);
    $description = mysqli_real_escape_string($conn, $_POST['Description']);

    // Validate input
    if (empty($skill) || empty($proficiency) || empty($experience)) {
        $_SESSION['error'] = "Please fill out all required fields.";
        header('Location: index.php');
        exit();
    }

    // Insert skill into the database
    $sql = "INSERT INTO skills (skill, proficiency, experience, description) VALUES ('$skill', '$proficiency', '$experience', '$description')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['success'] = "Skill added successfully!";
    } else {
        $_SESSION['error'] = "Failed to add skill: " . mysqli_error($conn);
    }

    // Redirect to form page with success or error message
    header('Location: index.php');
    exit();
}

mysqli_close($conn);
?>