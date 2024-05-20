<?php
session_start();
include "connection.php";
 if(isset($_GET['userid']))
 {
	 session_destroy();
	 header('location:index.php');
	 exit();
 }
?>