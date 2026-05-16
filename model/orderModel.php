<?php
<<<<<<< HEAD
require_once __DIR__ . '/db.php';

function getPurchaseHistory($userId) {
    $con = getConnection();
    $sql = "SELECT o.id AS order_id, o.total_amount, o.status, o.order_date,
                   p.payment_method
            FROM orders o
            LEFT JOIN payments p ON o.id = p.order_id
            WHERE o.user_id = ?
            ORDER BY o.order_date DESC";
=======
require_once('db.php');

function getPurchaseHistory($userId) {
    $con = getConnection();
    $sql = "SELECT o.id AS order_id, o.total_amount, o.order_date, p.status AS payment_status 
            FROM orders o 
            LEFT JOIN payments p ON o.id = p.order_id 
            WHERE o.user_id = ? 
            ORDER BY o.id DESC";
            
>>>>>>> 1b4c921 (backup my checkout and payment work)
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param("i", $userId);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}

function getOrderDetails($orderId) {
    $con = getConnection();
<<<<<<< HEAD
<<<<<<< HEAD
    $sql = "SELECT oi.quantity, oi.unit_price, pr.name AS product_name
            FROM order_items oi
            JOIN products pr ON oi.product_id = pr.id
=======
    $sql = "SELECT p.name, oi.quantity, oi.unit_price FROM order_items oi 
=======
    $sql = "SELECT oi.quantity, oi.unit_price, p.name AS product_name 
            FROM order_items oi 
>>>>>>> 1b4c921 (backup my checkout and payment work)
            JOIN products p ON oi.product_id = p.id 
>>>>>>> 004b1b1 (Updated checkout and added order management & payment views)
            WHERE oi.order_id = ?";
            
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param("i", $orderId);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}
<<<<<<< HEAD
?>
=======
?>
>>>>>>> 004b1b1 (Updated checkout and added order management & payment views)
