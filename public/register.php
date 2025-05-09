<?php 
session_start();
include '../includes/header.php';
include_once '../config/config.php';

function handleExistingUsernameOrEmail($username, $email) {
    global $conn;
    $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        header("location: register.php?username_or_email_exist=true");
        exit();
    }
}
?>

<body class="bgpurple">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 shadow-md bg-transparent mt-5 p-5">
                <h1 class="text-center mt-5">Register</h1>

                <?php 
                if(isset($_SESSION['mysqli_error'])) { ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['mysqli_error']; ?>
                </div>
                <?php
                    unset($_SESSION['mysqli_error']);
                }   

                if(isset($_SESSION['success'])) { ?>
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
                        <?php 
                        if (isset($_SESSION['username_or_email_exist'])) {
                            echo '<div class="alert alert-danger">Username or email already exists.</div>';
                            unset($_SESSION['username_or_email_exist']);
                        }
                        ?>
                    </div>
                    <div class="mb-3">
                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email" class="form-control" required>
                        <?php 
                        if (isset($_SESSION['email'])) {
                            echo '<div class="alert alert-danger">'.$_SESSION['email'].'</div>';
                            unset($_SESSION['email']);
                        }
                        ?>
                    </div>
                    <div class="mb-3">
                        <label for="password">Password:</label>
                        <input type="password" id="password" class="form-control" name="password" required>
                        <?php 
                        if(isset($_SESSION['passwordLower'])){
                            echo '<div class="alert alert-danger">'.$_SESSION['passwordLower'].'</div>';
                            unset($_SESSION['passwordLower']);
                        }
                        if(isset($_SESSION['passwordUpper'])){
                            echo '<div class="alert alert-danger">'.$_SESSION['passwordUpper'].'</div>';
                            unset($_SESSION['passwordUpper']);
                        }
                        if(isset($_SESSION['passwordNumber'])){
                            echo '<div class="alert alert-danger">'.$_SESSION['passwordNumber'].'</div>';
                            unset($_SESSION['passwordNumber']);
                        }
                        ?>
                    </div>
                    <div class="mb-3">
                        <label for="confirmpassword">Confirm Password:</label>
                        <input type="password" id="confirmpassword" class="form-control" name="confirmpassword"
                            required>
                        <?php 
                        if (isset($_SESSION['password_mismatch'])) {
                            echo '<div class="alert alert-danger">'.$_SESSION['password_mismatch'].'</div>';
                            unset($_SESSION['password_mismatch']);
                        }
                        ?>
                    </div>
                    <div class="mb-3">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" class="form-control" required>
                    </div>

                    <button type="submit" class="form-control bgpurple-lighter">Register</button>
                </form>

                <?php
                // Validation and filtration of the input
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $username = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS);
                    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                    $address = filter_var($_POST['address'], FILTER_SANITIZE_SPECIAL_CHARS);
                    $password = $_POST['password']; 
                    $confirmPassword = $_POST['confirmpassword'];

                    $isValid = true;

                    if (empty($username) || empty($email) || empty($password) || empty($confirmPassword) || empty($address)) {
                        $_SESSION["empty"] = "All fields are required";
                        $isValid = false;
                    }

                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $_SESSION["email"] = "Invalid email format";
                        $isValid = false;
                    }

                    if (strlen($password) < 8) {
                        $_SESSION["length"] = "Password cannot be less than 8 characters";
                        $isValid = false;
                    }

                    $hasLowerCase = preg_match('/[a-z]/', $password);
                    $hasUpperCase = preg_match('/[A-Z]/', $password);
                    $hasNumber = preg_match('/[0-9]/', $password);

                    if (!$hasLowerCase) {
                        $_SESSION["passwordLower"] = "Password must have at least 1 lowercase letter";
                        $isValid = false;
                    }

                    if (!$hasUpperCase) {
                        $_SESSION["passwordUpper"] = "Password must have at least 1 uppercase letter";
                        $isValid = false;
                    }

                    if (!$hasNumber) {
                        $_SESSION["passwordNumber"] = "Password must have at least 1 number";
                        $isValid = false;
                    }

                    if ($password !== $confirmPassword) {
                        $_SESSION["password_mismatch"] = "Password and confirm password do not match";
                        $isValid = false;
                    }

                    if (!$isValid) {
                        header('location: register.php');
                        exit();
                    }

                    // Handle existing username or email
                    handleExistingUsernameOrEmail($username, $email);

                    // Hash the password
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    // Insert user data into the database
                    $sql = "INSERT INTO users (`username`, `email`, `password`, `address`) VALUES ('$username', '$email', '$hashedPassword', '$address')";
                    $result = mysqli_query($conn, $sql);

                    if (!$result) {
                        $_SESSION['mysqli_error'] = "Failed to execute query: " . mysqli_error($conn);
                        header('location: register.php');
                        exit();
                    }

                    $_SESSION['success'] = "User created successfully!";
                    header('location: login.php');
                    exit();
                }

                $conn->close();
                ?>
                <script src="script.js"></script>
            </div>
        </div>
    </div>
</body>

</html>