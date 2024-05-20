<?php
session_start();
include "connection.php";

if (isset($_SESSION['cust_id'])) {
    $cust_id = $_SESSION['cust_id'];
    $user_query = mysqli_query($con, "SELECT * FROM `users` WHERE u_id ='$cust_id' ");
    $query_result = mysqli_fetch_assoc($user_query);
    $name = $query_result['firstname'];
    $lastname = $query_result['lastname'];
    $email = $query_result['email'];
    $password = $query_result['password'];
}
// update user account
if (isset($_POST['Update'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'];
    $phonenumber = $_POST['phonenumber'];



    if (mysqli_query($con, "UPDATE `users` SET `firstname`='$firstname',`lastname`='$lastname',`email`='$email',
    `password`='$password' WHERE u_id='$cust_id'")) {
        echo '<script>
        alert("Account Updated Successfully!");
       window.location="customer-dashboard.php";
        </script>';
    } else {
        echo mysqli_error($con);
    }
}
if (empty($_SESSION['cust_id'])) {
    header('location:index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "header.php"; ?>
    <title>Home</title>
</head>

<body>
    <div class="container mt-5">
        <p class="text-center text-info display-4 my-3 fw-semibold">Customer Profile</p>
        <ul class="nav nav-tabs justify-content-between" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a href="index.php" class="text-decoration-none">
                    <p><span class="text-dark fs-4 fw-bold">SkillConnect</span></p>
                    <p>Welcome <?php echo  $name; ?></p>
                </a>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link  " id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Services</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Account</button>
            </li>

            <li class="nav-item" role="presentation">
                <a class="btn btn-outline-danger" href="customer_logout.php?userid">Logout</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade " id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                <div class="container my-5 text-center">
                    <span class="text-center text-primary fs-6">No service borrowed</span>
                </div>
            </div>
            <div class="tab-pane fade  show active" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <div class="container p-3 my-5 bg-secondary-subtle">

                    <div class="row">
                        <span class="text-center">
                            <h2>Update Account</h2>
                        </span>
                        <div class="col-md-8 mx-auto  p-2">
                            <div>
                                <p class="text-Success m-2"><?php if (isset($user_success)) {
                                                                echo $user_success;
                                                            } ?></p>
                            </div>
                            <form action="" method="Post">
                                <div class="row p-3">
                                    <div class="col-sm-4">
                                        <label for="firstname" class="form-label">Name</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" id="firstname" name="firstname" value="<?php if (isset($name)) {
                                                                                                        echo $name;
                                                                                                    } ?>" class="form-control" placeholder="First Name" required>
                                    </div>
                                </div>
                                <div class="row p-3">
                                    <div class="col-sm-4">
                                        <label for="lastname" class="form-label">Last Name</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" id="lastname" name="lastname" value="<?php if (isset($lastname)) {
                                                                                                    echo $lastname;
                                                                                                } ?>" class="form-control" placeholder="Last Name" required>
                                    </div>
                                </div>
                                <div class="row p-3">
                                    <div class="col-sm-4">
                                        <label for="email" class="form-label">Email</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="email" id="email" name="email" class="form-control " value="<?php if (isset($email)) {
                                                                                                                        echo $email;
                                                                                                                    } ?>" placeholder="Email">
                                    </div>
                                </div>
                                <div class="row p-3">
                                    <div class="col-sm-4">
                                        <label for="password" class="form-label">Password</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="password" id="password" name="password" class="form-control" value="<?php if (isset($password)) {
                                                                                                                                echo $password;
                                                                                                                            } ?>" placeholder="Password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,16}$" title="Must contain at least one number ,special character and one uppercase and lowercase letter, and at least 8 or maximum 16 characters" required>
                                    </div>
                                </div>
                                <div class="row p-3">
                                    <div class="col-sm-4">
                                        <label for="confrimpassword" class="form-label">Confirm Password</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="password" id="confrimpassword" name="confirmpassword" class="form-control" onkeyup='check_password();' placeholder="Confirm Password" required>
                                        <span id='message'></span>
                                    </div>
                                </div>

                                <div class="row p-3  justify-content-between">
                                    <div class="col-sm-4 ">
                                        <div class="d-grid">
                                            <button type="submit" name="Update" class="btn btn-primary ">Update</button>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 ">

                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</body>
<script type="text/javascript">
    function check_password() {
        if (document.getElementById('password').value ==
            document.getElementById('confrimpassword').value) {
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