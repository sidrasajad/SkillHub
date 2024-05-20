<?php
session_start();
include "connection.php";
if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
}
if (empty($_SESSION['admin_id'])) {
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "header.php"; ?>
    <title>Admin Dashboard</title>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav  ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="services.php">Manage Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="workers.php">Workers</a>
                    </li>

                    <li class="nav-item">
                        <a class="btn btn-outline-secondary" href="customer_logout.php?userid">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row  my-4">
            <div class="col-md-4 ">
                <div class="card bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <p class="card-text">150</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-secondary">
                    <div class="card-body">
                        <h5 class="card-title">Total Orders</h5>
                        <p class="card-text">75</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title">Revenue</h5>
                        <p class="card-text">$10,000</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row  my-4">
            <div class="col-md-4">
                <div class="card bg-info">
                    <div class="card-body">
                        <h5 class="card-title">Total Workers</h5>
                        <p class="card-text">150</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-danger">
                    <div class="card-body">
                        <h5 class="card-title">Service Provided</h5>
                        <p class="card-text">75</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Ratings</h5>
                        <p class="card-text">8</p>
                    </div>
                </div>
            </div>
        </div>


    </div>


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>