<?php
session_start();

$_SESSION['user_id'] = 1;
$_SESSION['name'] = "Admin";
$_SESSION['role'] = "admin";

header("location: index.php?page=dashboard");
exit;
?>