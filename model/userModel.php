<?php

    require_once('db.php');

    function addUser($user) {

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

    function getAllUsers(){

        $con = getConnection();

        $users = [];

        if(!$con){
            return $users;
        }

        $sql = "
            select *
            from users
            order by id desc
        ";

        $result = mysqli_query($con, $sql);

        if($result){

            while($row = mysqli_fetch_assoc($result)){

                array_push($users, $row);
            }
        }

        mysqli_close($con);

        return $users;
    }

    function getUserById($id){

        $con = getConnection();

        $user = [];

        if(!$con){
            return $user;
        }

        $sql = "
            select *
            from users
            where id={$id}
        ";

        $result = mysqli_query($con, $sql);

        if(
            $result &&
            mysqli_num_rows($result) == 1
        ){

            $user = mysqli_fetch_assoc($result);
        }

        mysqli_close($con);

        return $user;
    }

    function getUserByEmail($email){

        $con = getConnection();

        $user = [];

        if(!$con){
            return $user;
        }

        $sql = "
            select *
            from users
            where email='{$email}'
        ";

        $result = mysqli_query($con, $sql);

        if(
            $result &&
            mysqli_num_rows($result) == 1
        ){

            $user = mysqli_fetch_assoc($result);
        }

        mysqli_close($con);

        return $user;
    }

    function updateUser($user){

        $con = getConnection();

        if(!$con){
            return false;
        }

        $sql = "
            update users
            set
                name='{$user['name']}',
                email='{$user['email']}',
                password_hash='{$user['password']}',
                role='{$user['role']}',
                address='{$user['address']}',
                phone='{$user['phone']}'
            where id={$user['id']}
        ";

        $result = mysqli_query($con, $sql);

        mysqli_close($con);

        return $result;
    }

    function deleteUser($id){

        $con = getConnection();

        if(!$con){
            return false;
        }

        $sql = "
            delete from users
            where id={$id}
        ";

        $result = mysqli_query($con, $sql);

        mysqli_close($con);

        return $result;
    }

?>