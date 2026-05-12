<?php

require_once('../model/userModel.php');

if (isset($_REQUEST['submit'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $address = trim($_POST['address']);
    $phone = trim($_POST['phone']);
    $imageName = $_FILES['image']['name'];
    $tmpName = $_FILES['image']['tmp_name'];
    $role = $_POST['role'];
    move_uploaded_file($tmpName, "../asset/upload/" . $imageName);

    if ($name == "" || $email == "" || $password == "" || $address == "" || $phone == "" || $imageName == "") {
        die("All fields are required");
    }

    if (strlen($password) < 8) {
        die("Password must be at least 8 characters");
    }

    if (strlen($phone) != 11) {
        die("Phone must be 11 digits");
    }

    for ($i = 0; $i < strlen($phone); $i++) {
        if ($phone[$i] < '0' || $phone[$i] > '9') {
            die("Phone must contain only numbers");
        }
    }


    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    


    $user = [
        "name" => $name,
        "email" => $email,
        "password" => $password_hash,
        "profile_picture" => $imageName,
        "address" => $address,
        "phone" => $phone,
        "role" => $role
    ];

    $status = addUser($user);

    if ($status) {
        echo "Registration Successful";
    } 
    else {
        echo "Database Error";
    }
}
?>