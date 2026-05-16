<?php
require_once('db.php');

function getPurchaseHistory($userId) {
    $con = getConnection();
    $sql = "SELECT o.id AS order_id, o.total_amount, o.order_date, p.status AS payment_status 
            FROM orders o 
            LEFT JOIN payments p ON o.id = p.order_id 
            WHERE o.user_id = ? 
            ORDER BY o.id DESC";
            
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param("i", $userId);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}

function getOrderDetails($orderId) {
    $con = getConnection();
    $sql = "SELECT oi.quantity, oi.unit_price, p.name AS product_name 
            FROM order_items oi 
            JOIN products p ON oi.product_id = p.id 
            WHERE oi.order_id = ?";
            
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param("i", $orderId);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}
?>