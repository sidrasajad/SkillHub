<?php
session_start();
include "connection.php";
if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
}
if (empty($_SESSION['admin_id'])) {
    header('location:index.php');
}
// worker status update
if (isset($_POST['Update'])) {
    $status_update = $_POST['status_update'];
    $service_id = $_POST['Update'];
    if (mysqli_query($con, "UPDATE `services` SET `service_status`='$status_update' WHERE `svc_id`='$service_id'")) {
        echo  '<script>
        alert("Status Updated Successfully!");
        window.location="services.php";
         </script>';
    } else {
        echo mysqli_error($con);
    }
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
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav  ms-auto">
                    <li class="nav-item">
                        <a class="nav-link " href="dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="services.php">Manage Services</a>
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

    <div class="container-fluid">
        <h1 class="text-center my-3 ">Services Hired</h1>
        <div class="table-responsive">
            <table class="table my-4">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Email</th>
                        <th scope="col">Service</th>
                        <th scope="col">Worker</th>
                        <th scope="col">Email</th>
                        <th scope="col">Hourly Charges</th>
                        <th scope="col">Status</th>
                        <th scope="col">Manage Service</th>
                        <th scope="col">Confirm</th>

                    </tr>
                </thead>
                <tbody class="">
                    <?php
                    $m = 1;
                    $service_query = mysqli_query($con, "SELECT * FROM `services` JOIN users ON services.u_id=users.u_id JOIN workers ON services.w_id=workers.w_id");
                    if (mysqli_num_rows($service_query) > 0) {
                        while ($service_row = mysqli_fetch_array($service_query)) {
                            $svc_id = $service_row['svc_id'];
                            $firstname = $service_row['firstname'];
                            $email1 = $service_row['email'];
                            $profession = $service_row['profession'];
                            $name = $service_row['name'];
                            $chargers = $service_row['chargers'];
                            $email2 = $service_row['email'];
                            $service_status = $service_row['service_status'];
                    ?>
                            <tr>
                                <th><?php if (isset($m)) {
                                        echo $m;
                                    } ?></th>
                                <td><?php if (isset($firstname)) {
                                        echo $firstname;
                                    } ?></td>

                                <td><?php if (isset($email1)) {
                                        echo $email1;
                                    } ?></td>
                                <td><?php if (isset($profession)) {
                                        echo $profession;
                                    } ?></td>
                                <td><?php if (isset($name)) {
                                        echo $name;
                                    } ?></td>
                                <td><?php if (isset($email2)) {
                                        echo $email2;
                                    } ?></td>
                                <td><?php if (isset($chargers)) {
                                        echo $chargers;
                                    } ?></td>
                                <td><?php if ($service_status == '1') {
                                        echo "Active";
                                    }
                                    if ($service_status == '0') {
                                        echo "Cancel / Pending ";
                                    } ?></td>
                                <td>
                                    <form action="" method="post">
                                        <select class="form-select" name="status_update">
                                            <option>Update Status</option>
                                            <option value="1">Active</option>
                                            <option value="0">Canceled</option>
                                        </select>

                                </td>
                                <td>
                                    <button class="btn btn-outline-primary" type="submit" name="Update" value="<?php echo $svc_id; ?>">Confirm</button>
                                </td>
                                </form>
                            </tr>
                        <?php
                            $m++;
                        }
                    } else {
                        ?>
                        <tr class="table-danger">
                            <td class="text-center" colspan="8">No Customer!</td>
                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>