<?php
session_start();
include "connection.php";

//login into site
if (isset($_POST['admin-login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $User_login = mysqli_query($con, "SELECT * FROM `users` WHERE `email`='$username' and  `password`='$password' and `u_role`='admin' and `u_activate`='1'");
    if (mysqli_num_rows($User_login) > 0) {
        $row = mysqli_fetch_array($User_login);
        $user_id = $row['u_id'];
        $_SESSION['admin_id'] = $user_id;
        header("location:dashboard.php");
    } else {
        echo mysqli_error($con);
        $error_message = "Invalid details";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "header.php"; ?>
    <title>Admin Login</title>
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


    <main class="container  mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border border-info">
                    <h5 class="card-header text-center bg-secondary text-info">Admin Login</h5>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Enter username">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
                            </div>
                            <button type="submit" name="admin-login" class="btn btn-primary">Log In</button>
                        </form>
                    </div>
                    <div class="footer p-2 text-center" style="color:red;"><?php if (isset($error_message)) {
                                                                                echo $error_message;
                                                                            } ?></div>
                </div>
            </div>
        </div>
    </main>


</body>

</html>