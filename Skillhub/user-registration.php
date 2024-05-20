<?php
include "connection.php";

if (isset($_POST['register'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'];
    $user_role = 'customer';
    $active_user = '1'; //1 for actvie and 0 for blocked customer and 02 for reject customer



    if (mysqli_query($con, "INSERT INTO `users`( `firstname`, `lastname`, `email`, `password`, `u_activate`, `user_role`)
     VALUES ('$firstName','$lastName','$email','$password','$active_user','$user_role')")) {
        echo '<script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
          }
        </script>';
        $user_success = "Your Registration will be confirmed in next 24 hours please wait..!";
    } else {
        echo mysqli_error($con);
    }
} else {
    echo  mysqli_error($con);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once  "header.php";
    ?>
    <title>Home</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SkillConnect</a>
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

                    <li class="nav-item">
                        <a class="nav-link" href="user-registration.php">SignUp </a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>
    <div class="d-flex justify-content-center min-vh-100">
        <div class="container  my-5">

            <div class="col-md-8 mx-auto my-5 rounded-4 shadow-sm border border-warning p-5">
                <h2 class="text-center mb-2">User Registration Form</h2>
                <div>
                    <p class="text-primary m-2 fw-bold"><?php if (isset($user_success)) {
                                                            echo $user_success;
                                                        } ?></p>
                </div>
                <form class="needs-validation" novalidate method="post">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName" class="form-label">First name</label>
                            <input type="text" class="form-control" name="firstName" id="firstName" placeholder="First name" required>
                            <div class="invalid-feedback">
                                Please enter your first name.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName" class="form-label">Last name</label>
                            <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last name" required>
                            <div class="invalid-feedback">
                                Please enter your last name.
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com" required>
                        <div class="invalid-feedback">
                            Please enter a valid email address.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                        <div class="invalid-feedback">
                            Please enter your password.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm password" onkeyup='check_password();' required>
                        <span id='message'></span>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                        <label class="form-check-label" for="invalidCheck">
                            Agree to terms and conditions
                        </label>
                        <div class="invalid-feedback">
                            You must agree to terms and conditions before you can submit.
                        </div>
                    </div>
                    <button class="btn btn-primary float-start" name="register" type="submit">Register</button>
                    <a href="worker-registration.php" class="btn btn-warning float-end">SignUp Worker</a>
                </form>
            </div>


        </div>
    </div>
</body>
<script type="text/javascript">
    function check_password() {
        if (document.getElementById('password').value ==
            document.getElementById('confirmPassword').value) {
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'Correct';
        } else {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'Not Correct';
        }
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>