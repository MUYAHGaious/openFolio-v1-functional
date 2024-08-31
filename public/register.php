<?php 
session_start();
include '../includes/header.php';
include_once '../config/config.php';

function handleExistingUsernameOrEmailL($username, $email) {
    $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    global $conn;
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        header("location: register.php?username__or_email_exist");
    }
}
?>

<body class="bgpurple">
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 shadow-md bg-transparent mt-5 p-5">
            <h1 class="text-center mt-5">Register</h1>

            <?php 

            if(isset($_SESSION['mysqli_error'])){ ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['mysqli_error']; ?>
            </div>
            <?php
            unset($_SESSION['mysqli_error']);
            }   

            if(isset($_SESSION['success'])){ ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['success']; ?>
            </div>
            <?php
            unset($_SESSION['success']);
            }
            ?>
            <form action="register.php" method="post" enctype="multipart/form-data">
    
                <div class="mb-3">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" class="form-control" required>
                 </div>
                <div class="mb-3">
                    <label for="password">Password:</label>
                    <input type="password" id="password" class="form-control" name="password"  required>
                    
                    <?php 
                        if(isset($_SESSION['passwordLower'])){
                            echo $_SESSION['passwordLower'];
                        }
                        if(isset($_SESSION['passwordUpper'])){
                            echo $_SESSION['passwordUpper'];
                        }
                        if(isset($_SESSION['passwordNumber'])){
                            echo $_SESSION['passwordNumber'];
                        }
                ?>   
                 </div>
       
                 <div class="mb-3">
                    <label for="confirmpassword">Confirm Password:</label>
                    <input type="password" id="confirmpassword" class="form-control" name="confirmpassword"  required>
                 </div>

                 <div class="mb-3">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" class="form-control" required>
                </div>

        <button type="submit" class="form-control bgpurple-lighter">Register</button>
    </form>
    <?php
 
//validation of the inputs and filteration of the input
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS,20);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $address = $_POST['address'];
    $password = $_POST['password']; 
    $confirmPassword = $_POST['confirmpassword'];

    $username = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS, 20);
    
  
    if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
        $_SESSION["empty"] = "All fields are required";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["email"] = "Invalid email format";
    }
    if (strlen($password) < 8) {
        $_SESSION["length"] == " Password can not be less than 8 characters";
    }
    $hasLowerCase = false;
    $hasNumber = false;
    $hasUpperCase = false;

    for($count=0; $count < strlen($password); $count++){
        if(ctype_lower($password[$count])){
            $hasLowerCase = true;
        }
        if(ctype_upper($password[$count])){
            $hasUpperCase = true;
        }
        if(ctype_digit($password[$count])){
            $hasNumber = true;
        }
    }
        
    if(!$hasLowerCase){
        $_SESSION["passwordLower"] = "Password must have at least 3 lowercase";
    }

    if(!$hasNumber){
        $_SESSION["passwordNumber"] = "Password must have at least 1 number";
    }

    if(!$hasUpperCase){
        $_SESSION["passwordUpper"] = "Password must have at least 2 uppercase";
    }

    if ($password !== $confirmPassword) {
        echo "Invalid password,Password must be equal to confirm password";
        echo " Confirm password";
    }

    //implementing the hashed password function
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

handleExistingUsernameOrEmailL($username, $email);
$sql = "INSERT INTO users (`username`, `email`, `password`, `address`) VALUES ('$username', '$email', '$hashedPassword', '$address')";
$result = mysqli_query($conn, $sql);

if(!$result){
    $_SESSION['mysqli_error'] = "Failed to execute query" . mysqli_error($conn);
    header('location:register.php');
}

$_SESSION['success'] = "User created";
header('locaton:register.php');

$conn->close();

}
   


?>
    <script src="script.js"></script>
</body>
</html>