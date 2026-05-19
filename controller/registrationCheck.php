<?php

require_once('../model/userModel.php');

if (isset($_REQUEST['submit'])) {

    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $address  = trim($_POST['address']);
    $phone    = trim($_POST['phone']);
    $role     = $_POST['role'];

    $imageName = $_FILES['image']['name'];
    $tmpName   = $_FILES['image']['tmp_name'];
    $imageType = $_FILES['image']['type'];

    $isValid = true;

    if ($name == "" || $email == "" || $password == "" || $address == "" || $phone == "" || $imageName == "" || $role == "") {
        echo "All fields are required. ";
        $isValid = false;
        exit();
    }

    $existing = getUserByEmail($email);
    if ($existing) {
        echo "This email is already registered. Please use a different email.";
        $isValid = false;
        exit();
    }

    if (strlen($password) < 8) {
        echo "Password must be at least 8 characters. ";
        $isValid = false;
    }

    if (strlen($phone) != 11) {
        echo "Phone must be 11 digits. ";
        $isValid = false;
    }

    for ($i = 0; $i < strlen($phone); $i++) {
        if ($phone[$i] < '0' || $phone[$i] > '9') {
            echo "Phone must contain only numbers. ";
            $isValid = false;
            break;
        }
    }

    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
    $isImageValid = false;
    foreach ($allowedTypes as $type) {
        if ($imageType === $type) {
            $isImageValid = true;
            break;
        }
    }

    if (!$isImageValid) {
        echo "Invalid image format. ";
        $isValid = false;
    }

    if ($isValid) {
        move_uploaded_file($tmpName, "../asset/upload/" . $imageName);

        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $user = [
            "name"            => $name,
            "email"           => $email,
            "password"        => $password_hash,
            "profile_picture" => $imageName,
            "address"         => $address,
            "phone"           => $phone,
            "role"            => $role
        ];

        $status = addUser($user);

        if ($status) {
            header('Location: ../view/login.php');
            exit();
        } else {
            echo "Database Error";
        }
    }
}
?>