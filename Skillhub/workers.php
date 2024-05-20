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
    $worker_id = $_POST['Update'];
    if (mysqli_query($con, "UPDATE `workers` SET `worker_activity`='$status_update' WHERE `w_id`='$worker_id'")) {
        echo  '<script>
        alert("Status Updated Successfully!");
        window.location="workers.php";
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
    <title>Worker's Profile</title>
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
                        <a class="nav-link" href="dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="services.php">Manage Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="workers.php">Workers</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-secondary" href="customer_logout.php?userid">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table my-4">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">NIC</th>
                        <th scope="col">Email</th>
                        <th scope="col">Profession</th>
                        <th scope="col">Experience</th>
                        <th scope="col">Hourly Charges</th>
                        <th scope="col">Available Slot</th>
                        <th scope="col">Image</th>
                        <th scope="col">Status</th>
                        <th scope="col">Update Status</th>
                        <th scope="col">Confirm</th>

                    </tr>
                </thead>
                <tbody class="">
                    <?php
                    $m = 1;
                    $worker_query = mysqli_query($con, "SELECT * FROM `workers` WHERE worker_activity !='2' ");
                    if (mysqli_num_rows($worker_query) > 0) {
                        while ($worker_row = mysqli_fetch_array($worker_query)) {
                            $w_id = $worker_row['w_id'];
                            $name = $worker_row['name'];
                            $email = $worker_row['email'];
                            $profession = $worker_row['profession'];
                            $experience = $worker_row['experience'];
                            $chargers = $worker_row['chargers'];
                            $available_time = $worker_row['available_time'];
                            $profile_image = $worker_row['profile_image'];
                            $worker_activity = $worker_row['worker_activity'];
                            $nic = $worker_row['nic'];
                    ?>
                            <tr>
                                <th><?php if (isset($m)) {
                                        echo $m;
                                    } ?></th>
                                <td><?php if (isset($name)) {
                                        echo $name;
                                    } ?></td>
                                <td><?php if (isset($nic)) {
                                        echo $nic;
                                    } ?></td>
                                <td><?php if (isset($email)) {
                                        echo $email;
                                    } ?></td>
                                <td><?php if (isset($profession)) {
                                        echo $profession;
                                    } ?></td>
                                <td><?php if (isset($experience)) {
                                        echo $experience;
                                    } ?></td>
                                <td><?php if (isset($chargers)) {
                                        echo $chargers;
                                    } ?></td>
                                <td><?php if (isset($available_time)) {
                                        echo $available_time;
                                    } ?></td>
                                <td>
                                    <img src="<?php if (isset($profile_image)) {
                                                    echo $profile_image;
                                                } ?>" alt="" height="90" width="100">
                                </td>

                                <td><?php if ($worker_activity == '1') {
                                        echo "Active";
                                    }
                                    if ($worker_activity == '0') {
                                        echo "Block / Pending ";
                                    } ?></td>
                                <td>
                                    <form action="" method="post">
                                        <select class="form-select" name="status_update">
                                            <option>Update Status</option>
                                            <option value="1">Approve</option>
                                            <option value="0">Block / Pending</option>
                                            <option value="2">Reject / Delete</option>
                                        </select>

                                </td>
                                <td>
                                    <button class="btn btn-outline-primary" type="submit" name="Update" value="<?php echo $w_id; ?>">Confirm</button>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>