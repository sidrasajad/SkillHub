<?php
session_start();
include "connection.php";

if (isset($_SESSION['cust_id'])) {
    $cust_id = $_SESSION['cust_id'];
}
if (isset($_POST['hire_svc'])) {

    if (!empty($_SESSION['cust_id'])) {

        $worker_id = $_POST['hire_svc'];
        $status = "1"; //1 for active service and 0 for cancel 

        if (mysqli_query($con, "INSERT INTO `services`(`u_id`, `w_id`,`service_status`) 
            VALUES ('$cust_id','$worker_id','$status')")) {
            echo '<script>
                    alert("Hired succesfully...!");
                    window.location="customer-dashboard.php"
                </script>';
        } else {
            echo mysqli_error($con);
        }
    } else {
        header("location:customer-login.php?login_first");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "header.php"; ?>
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
                <?php
                if (!empty($cust_id)) {
                ?>
                    <form class="d-flex ms-auto" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form><?php } ?>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <?php
                    if (empty($cust_id)) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="customer-login.php">Login</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="user-registration.php">SignUp </a>
                        </li>
                    <?php
                    } else {  ?>
                        <li class="nav-item" role="presentation">
                            <a class="btn btn-outline-danger" href="customer_logout.php?userid">Logout</a>
                        </li>

                    <?php } ?>
                </ul>

            </div>
        </div>
    </nav>

    <h1 class="text-center my-5">Home Page</h1>
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 justify-content-center    g-4 ">

            <?php

            $workers_query = mysqli_query($con, "SELECT * FROM `workers` WHERE worker_activity ='1' ");
            if (mysqli_num_rows($workers_query) > 0) {

                while ($worker_result = mysqli_fetch_array($workers_query)) {
                    $w_id = $worker_result['w_id'];
                    $profile_image = $worker_result['profile_image'];
                    $profession = $worker_result['profession'];
                    $name = $worker_result['name'];
                    $chargers = $worker_result['chargers'];
                    $available_time = $worker_result['available_time'];
                    $experience = $worker_result['experience'];

            ?>

                    <div class="col dispaly-col ">
                        <div class="card  dispaly-card ">
                            <img src="<?php echo  $profile_image; ?>" class="card-img-top " alt="..." height="150px" width="150px">
                            <div class="card-body product_card">

                                <div class="row mb-1">
                                    <div class="col  text-center" style="text-transform:capitalize;white-space: nowrap;overflow:hidden;">
                                        <h5 class="card-title"><?php echo $name; ?></h5>
                                    </div>
                                </div>

                                <div class="row mb-1">
                                    <div class="col" style="text-transform:capitalize; white-space: nowrap;"><?php echo $profession; ?></div>
                                    <div class="col ">Rs:<?php echo $chargers; ?> <small>(hourly)</small></div>
                                </div>

                                <div class="row mb-1">
                                    <div class="col" style="text-transform:capitalize;">Time :<?php echo $available_time; ?></div>
                                    <div class="col" style="text-transform:capitalize;">Exp : <?php echo $experience; ?> <small>yrs</small></div>
                                </div>
                                <div class="row ">
                                    <form action="" method="post">
                                        <div class="col">
                                            <div class="d-grid">
                                                <button class="btn btn-outline-success" type="submit" name="hire_svc" value="<?php echo $w_id; ?>">Hire</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>