<?php

require_once('db.php');

function addUser($user)
{

    $con = getConnection();

    if (!$con) {
        return false;
    }

    //Escape User Input: If prepared statements cannot be used, use mysqli_real_escape_string() to escape input, although this is less secure.
    //searched on google for sql injection
    $name = mysqli_real_escape_string($con, $user['name']);
    $email = mysqli_real_escape_string($con, $user['email']);
    $password = mysqli_real_escape_string($con, $user['password']);
    $role = mysqli_real_escape_string($con, $user['role']);
    $address = mysqli_real_escape_string($con, $user['address']);
    $phone = mysqli_real_escape_string($con, $user['phone']);
    $imageName = mysqli_real_escape_string($con, $user['profile_picture']);


    $sql = "
        INSERT INTO users 
        (id, name, email, password_hash, role, profile_picture, address, phone, created_at)
        VALUES 
        ('', '$name', '$email', '$password', '$role', '$imageName', '$address', '$phone', CURRENT_TIMESTAMP)
    ";

    $result = mysqli_query($con, $sql);

    mysqli_close($con);

    return $result;
}

function login($user)
{
    $con = getConnection();
    $sql = "select * from users where email='{$user['email']}' and password_hash='{$user['password']}'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) == 1) {
        return true && mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

function getUserByEmail($email) {
    $con = getConnection();
    
    $email = mysqli_real_escape_string($con, $email);

    $sql = "SELECT * FROM users WHERE email='{$email}'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        return $user;
    }

    mysqli_close($con);
    return false;
}