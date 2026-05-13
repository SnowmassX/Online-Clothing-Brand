<?php
require('db.php');
function getAllProducts()
{
    $con = getConnection();

    $sql = "SELECT * FROM products";

    $result = mysqli_query($con, $sql);

    return $result;
}
function getProudctByGender($gender)
{
    $con = getConnection();
    $sql = "SELECT * FROM products WHERE gender='{$gender}'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        return mysqli_fetch_assoc($result);
    } else {
        echo "nothing found";
    }
}
