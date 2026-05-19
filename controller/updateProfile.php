<?php

session_start();

require_once('../model/userModel.php');

if (!isset($_SESSION['id'])) {
    exit();
}

$id = $_SESSION['id'];

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$address = trim($_POST['address']);

$imageName = null;

if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['name'] != "") {
    $type = $_FILES['profile_picture']['type'];

    if (strpos($type, 'image/') !== 0) {
        echo json_encode([
            "status"  => "error",
            "message" => "Only images are allowed"
        ]);
        exit();
    }

    $imageName = time() . "_" . $_FILES['profile_picture']['name'];

    move_uploaded_file($_FILES['profile_picture']['tmp_name'], "../asset/upload/user/" . $imageName);
}

$result = updateUser($id, $name, $email, $phone, $address, $imageName);

if ($result) {

    echo json_encode([
        "status" => "success",
        "message" => "Profile updated successfully",
        "image_path" => $imageName
    ]);
} else {

    echo json_encode([
        "status" => "error",
        "message" => "Profile update failed"
    ]);
}
