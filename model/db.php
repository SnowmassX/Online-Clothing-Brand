<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "online-clothing-brand"; 

function getConnection() {
    global $dbhost, $dbuser, $dbpass, $dbname;

    $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $con;
}

?>