<?php include '../includes/header.php' ?>
<?php include_once '../config/config.php' ?>
<?php session_start(); ?>

<body class="bgpurple">

    <?php
    if (isset($_SESSION['unauthorized'])) { ?>
        <div class="alert alert-danger mt-5">
            <?php echo $_SESSION['unauthorized']; ?>
        </div>
        <?php

        unset($_SESSION['unauthorized']);
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 shadow-md bg-transparent mt-5 p-5">
                <h1 class="text-center mt-5">Login</h1>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <button type="submit" class="btn bgpurple-lighter form-control">Login</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $username = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS, 20);
        $password = $_POST['password'];



        if (empty($username) || empty($password)) {
            $_SESSION["empty"] = "All fields are required";
            header("Location: login.php?username_or_password");
        }

        $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$username'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);


            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                $_SESSION['authenticated'] = true;
                $_SESSION['message'] = "Successful Login";
                header("location: dashboard.php");
            }
        } else {
            $_SESSION["user_not_found"] = "User not found";
            header('location: login.php?user_not_found');
        }

        $conn->close();

    } ?>



</body>

</html>