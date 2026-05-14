<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "online_clothing_brand"; // আপনার ডাটাবেজের নাম এখানে দিন

function getConnection() {
    global $dbhost, $dbuser, $dbpass, $dbname;

    $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    // কানেকশন চেক করা
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $con;
}

?>