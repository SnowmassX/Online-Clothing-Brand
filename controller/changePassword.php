<?php

session_start();

require_once('../model/userModel.php');

if(!isset($_SESSION['id'])){
    exit();
}

$data = json_decode(file_get_contents("php://input"));

$current_password = $data->current_password;
$new_password = $data->new_password;
$confirm_password = $data->confirm_password;

$result = updatePassword($_SESSION['id'],$current_password,$new_password,$confirm_password);

echo json_encode($result);