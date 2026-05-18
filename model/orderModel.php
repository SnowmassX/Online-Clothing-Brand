<?php
<<<<<<< HEAD
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

    $sql = "SELECT 1 AS order_id, 2550.00 AS total_amount, NOW() AS order_date, 'Paid' AS payment_status";
            
>>>>>>> 1b4c921 (backup my checkout and payment work)
=======
require_once __DIR__ . '/db.php';

function getPurchaseHistory($userId) {
    $con = getConnection();
    $sql = "SELECT o.id AS order_id, o.total_amount, o.status, o.order_date,
                   p.payment_method
            FROM orders o
            LEFT JOIN payments p ON o.id = p.order_id
            WHERE o.user_id = ?
            ORDER BY o.order_date DESC";
>>>>>>> e0ea6a1 (Fixed task 4 checkout and order system integration issues)
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}

function getOrderDetails($orderId) {
    $con = getConnection();
<<<<<<< HEAD
<<<<<<< HEAD
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
=======
    
    $sql = "SELECT 2 AS quantity, 1275.00 AS unit_price, 'Premium Black T-Shirt' AS product_name";
>>>>>>> 028d60b (Task 4 added completely)
            
=======
    $sql = "SELECT oi.quantity, oi.unit_price, pr.name AS product_name
            FROM order_items oi
            JOIN products pr ON oi.product_id = pr.id
            WHERE oi.order_id = ?";
>>>>>>> e0ea6a1 (Fixed task 4 checkout and order system integration issues)
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $orderId);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}
<<<<<<< HEAD
<<<<<<< HEAD
?>
=======
?>
>>>>>>> 004b1b1 (Updated checkout and added order management & payment views)
=======
?>
>>>>>>> e0ea6a1 (Fixed task 4 checkout and order system integration issues)
