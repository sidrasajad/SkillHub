<?php
$hostname = "localhost";
$user = "root";
$password = "";
$database = "skill_hub";

$con = mysqli_connect($hostname, $user, $password, $database);

if ($con === false) {
    die("not connected:" . mysqli_connect_error());
}
