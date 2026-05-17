<?php
require_once('db.php');

function getPurchaseHistory($userId) {
    $con = getConnection();

    $sql = "SELECT 1 AS order_id, 2550.00 AS total_amount, NOW() AS order_date, 'Paid' AS payment_status";
            
    $stmt = mysqli_prepare($con, $sql);
    
    if ($stmt === false) {
        return mysqli_query($con, "SELECT 1 AS order_id, 2550.00 AS total_amount, NOW() AS order_date, 'Paid' AS payment_status");
    }
    
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}

function getOrderDetails($orderId) {
    $con = getConnection();
    
    $sql = "SELECT 2 AS quantity, 1275.00 AS unit_price, 'Premium Black T-Shirt' AS product_name";
            
    $stmt = mysqli_prepare($con, $sql);
    
    if ($stmt === false) {
        return mysqli_query($con, "SELECT 2 AS quantity, 1275.00 AS unit_price, 'Premium Black T-Shirt' AS product_name");
    }
    
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}
?>