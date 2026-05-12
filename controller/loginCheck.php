<?php
session_start();
require_once('../model/userModel.php');

if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $userData = getUserByEmail($email);

    if ($userData && password_verify($password, $userData['password_hash'])) {
        
        $_SESSION['id'] = $userData['id'];
        $_SESSION['name'] = $userData['name'];
        $_SESSION['role'] = $userData['role'];

        if (isset($_POST['remember'])) {
            setcookie('email', $email, time() + (86400 * 30), "/");
            setcookie('password', $password, time() + (86400 * 30), "/"); 
        } else {
            setcookie('email', '', time() - 3600, "/");
            setcookie('password', '', time() - 3600, "/");
        }

        if ($userData['role'] == "Admin") {
            header('location: ../view/admin/dashboard.php');
        } else {
            header('location: ../view/home.php');
        }
        exit();
    } else {
        echo "Invalid email or password.";
    }
}
?>