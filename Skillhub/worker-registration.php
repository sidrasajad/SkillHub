<?php
include "connection.php";

if (isset($_POST['register_worker'])) {
    $name = $_POST['name'];
    $nic = $_POST['nic'];
    $profession = $_POST['profession'];
    $experience = $_POST['experience'];
    $availableTime = $_POST['availableTime'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hourlyRate = $_POST['hourlyRate'];
    $active_status = "1"; //1 for actvie and 0 for delete product


    if (!file_exists("content/" . $profession)) {
        mkdir("content/$profession", null, true);
    }
    $image = $_FILES['profileImage']['name'];

    $tmp_name = $_FILES['profileImage']['tmp_name'];
    $target = "content/$profession/" . $image;
    move_uploaded_file($tmp_name, $target);

    if (mysqli_query($con, "INSERT INTO `workers` (`name`, `nic`, `profession`, `experience`, `chargers`, `available_time`, `email`, `password`, `profile_image`, `worker_activity`)
         VALUES ('$name','$nic','$profession','$experience','$hourlyRate','$availableTime','$email','$password','$target','$active_status')")) {
        echo '<script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
              }
            </script>';
        $success = "Your registration will be confirmed in 24 hours...!";
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Worker Registration Form</title>
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
                        <a class="nav-link" href="index.php">SignUp </a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <div class="container mt-5 my-5 rounded-4 shadow-sm border border-warning p-5 ">

        <h2 class="text-center">Worker Registration Form</h2>
        <footer>
            <p class="text-primary my-2 fs-6 fw-semibold"><?php if (isset($success)) {
                                                                echo $success;
                                                            } ?></p>
        </footer>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Full Name" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="idCard" class="form-label">ID Card</label>
                        <input type="text" class="form-control" name="nic" id="idCard" pattern="\d{5}-\d{7}-\d{1}" placeholder="Enter ID Card (e.g., 33103-4876299-1)" required>
                        <div class="invalid-feedback">
                            Please enter a valid ID card number in the format XXXXX-XXXXXXX-X.
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="profession" class="form-label">Profession</label>
                        <select class="form-select" name="profession" id="profession" aria-label="Default select example">
                            <option>Open this select menu</option>
                            <option value="Electrician">Electrician </option>
                            <option value="Plumber">Plumber </option>
                            <option value="Welder">Welder</option>
                            <option value="Carpenter">Carpenter </option>
                            <option value="Mechanic">Mechanic </option>
                            <option value="Appliance technician">Appliance technician</option>
                        </select>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="experience" class="form-label">Experience (years)</label>
                        <input type="number" class="form-control" name="experience" id="experience" min="1" max="30" placeholder="Experience maximu 30 years" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="availableTime" class="form-label">Available Time</label>
                        <input type="text" class="form-control" name="availableTime" id="availableTime" placeholder="Available Time e.g 06 Pm - 06 AM" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="hourlyRate" class="form-label">Hourly Charges</label>
                        <input type="text" class="form-control" name="hourlyRate" id="hourlyRate" min="1" placeholder="Hourly Rate" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                    </div>
                </div>
            </div>
            <div class="row  mb-3">
                <div class="col-md-6">
                    <div class=" mb-3">
                        <label for="profileImage" class="form-label text-light">Profile Image</label>
                        <input type="file" class="form-control " name="profileImage" id="profileImage" name="profileImage" placeholder="Workers's Image" accept="image/*">
                    </div>
                </div>
            </div>

            <button type="submit" name="register_worker" class="btn btn-primary">Register</button>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>

</html>