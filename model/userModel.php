<?php

require_once('db.php');

function addUser($user)
{
    $con = getConnection();

    $sql = "insert into users(name,email,password_hash,role,profile_picture,address,phone,remember_token,created_at)values('{$user['name']}','{$user['email']}','{$user['password']}','{$user['role']}','{$user['profile_picture']}','{$user['address']}','{$user['phone']}','',CURRENT_TIMESTAMP)";

    $result = mysqli_query($con, $sql);

    mysqli_close($con);

    return $result;
}

function login($user)
{
    $con = getConnection();

    $email = $user['email'];

    $sql = "select * from users
            where email='$email'";

    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {

        $data = mysqli_fetch_assoc($result);

        if (password_verify($user['password'],$data['password_hash'])) 
        {
            return $data;
        }
    }

    return false;
}

function getUserByEmail($email)
{
    $con = getConnection();

    $email = mysqli_real_escape_string($con, $email);

    $sql = "select * from users WHERE email='{$email}'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        return $user;
    }

    mysqli_close($con);
    return false;
}

function getUserById($id)
{

    $con = getConnection();

    $sql = "select * from users where id='$id'";

    $result = mysqli_query($con, $sql);

    $user = mysqli_fetch_assoc($result);

    return $user;
}

function updateUser($id, $name, $email, $phone, $address, $imageName = null)
{

    $con = getConnection();

    if ($imageName != null) {
        $sql = "update users set name='$name', email='$email', phone='$phone', address='$address', profile_picture='$imageName' where id='$id'";
    } else {
        $sql = "update users set name='$name', email='$email', phone='$phone', address='$address' where id='$id'";
    }

    return mysqli_query($con, $sql);
}

function updatePassword($id, $current_password, $new_password, $confirm_password)
{

    if ($new_password != $confirm_password) {
        return ["status" => "error", "message" => "Passwords do not match"];
    }

    $con = getConnection();

    $sql = "select * from users where id='$id'";
    $result = mysqli_query($con, $sql);
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        return ["status" => "error", "message" => "User not found"];
    }

    if (password_verify($current_password, $user['password_hash'])) {

        $newHash = password_hash($new_password, PASSWORD_DEFAULT);

        $sql = "update users set password_hash='$newHash' where id='$id'";
        mysqli_query($con, $sql);

        mysqli_close($con);

        return ["status" => "success", "message" => "Password changed successfully"];
    } else {
        mysqli_close($con);
        return ["status" => "error", "message" => "Current password incorrect"];
    }
}
