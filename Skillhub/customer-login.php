<?php
session_start();
include "connection.php";

//login into site
if (isset($_POST['customer-login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $User_login = mysqli_query($con, "SELECT * FROM `users` WHERE `email`='$username' and  `password`='$password' and `u_role`='customer' and `u_activate`='1'");
    if (mysqli_num_rows($User_login) > 0) {
        $row = mysqli_fetch_array($User_login);
        $user_id = $row['u_id'];
        $_SESSION['cust_id'] = $user_id;
        header("location:customer-dashboard.php");
    } else {
        echo mysqli_error($con);
        $error_message = "Invalid details";
    }
}
//without login structure
if (isset($_GET['login_first'])) {
    $login_first = $_GET['login_first'];
    $login_message = "Please Login first to Enjoy our services--!";
} else {
    $login_first = "";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "header.php"; ?>
    <title>Login</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">SkillConnect</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="customer-login.php">Login</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>
    <div class="container my-5 ">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="footer p-2" style="color:red;"><?php if (isset($login_message)) {
                                                                echo $login_message;
                                                            } ?></div>
                <div class="card border border-warning">
                    <h5 class="card-header text-center bg-warning">Customer Login</h5>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username or Email</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Enter username or email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
                            </div>

                            <button type="submit" class="btn btn-primary float-start" name="customer-login">Log In</button>
                            <a href="user-registration.php" class="btn btn-warning float-end">SignUp</a>

                        </form>

                    </div>
                    <div class="footer p-2 text-center" style="color:red;"><?php if (isset($error_message)) {
                                                                                echo $error_message;
                                                                            } ?></div>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</html>