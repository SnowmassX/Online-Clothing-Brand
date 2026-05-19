<?php
$host = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "online_clothing_brand";

function getConnection(){
    global $host, $dbuser, $dbpass, $dbname;

    $con = mysqli_connect($host, $dbuser, $dbpass, $dbname);

    if(!$con){
        die("Database connection failed: " . mysqli_connect_error());
    }

    mysqli_set_charset($con, "utf8mb4");
    return $con;
}
?>