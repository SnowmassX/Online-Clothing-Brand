<?php
require_once('db.php');

function placeOrder($userId, $totalAmount, $address, $paymentMethod) {
    $con = getConnection();
    $sql = "INSERT INTO orders (user_id, total_price, status, shipping_address, payment_method, created_at) 
            VALUES (?, ?, 'Pending', ?, ?, NOW())";
    
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "idss", $userId, $totalAmount, $address, $paymentMethod);
    
    if (mysqli_stmt_execute($stmt)) {
        return mysqli_insert_id($con);
    }
    return false;
}

function clearCart($userId) {
    $con = getConnection();
    $sql = "DELETE FROM cart WHERE user_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    return mysqli_stmt_execute($stmt);
}

function getPurchaseHistory($userId) {
    $con = getConnection();
    $sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY id DESC";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}

function getOrderDetails($orderId) {
    $con = getConnection();
    $sql = "SELECT p.name, oi.quantity, oi.unit_price FROM order_items oi 
            JOIN products p ON oi.product_id = p.id 
            WHERE oi.order_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $orderId);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}
?>