<?php

session_start();

require_once('../model/userModel.php');

if (!isset($_SESSION['id'])) {
    exit();
}

$id = $_SESSION['id'];

$user = getUserById($id);

echo json_encode($user);
?>
