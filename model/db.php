<?php
    $host = "127.0.0.1";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "online-clothing-brand";

    function getConnection(){
        global $host, $dbuser;

        $con = mysqli_connect($host, $dbuser, $GLOBALS['dbpass'], $GLOBALS['dbname']);

        return $con;
    }
?>