<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header('location: ../view/login.php');
    }
    else{
        session_destroy();
        setcookie('email', '', time() - 3600, "/");
        setcookie('password', '', time() - 3600, "/");
        header('location: ../view/home.php');
    }
    
?>