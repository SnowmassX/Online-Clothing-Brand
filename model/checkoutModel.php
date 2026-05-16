<?php
<<<<<<< HEAD
require_once __DIR__ . '/db.php';

function getUserCartItems($userId) {
    $con = getConnection();
    $sql = "SELECT c.product_id, c.quantity, p.price, p.name
            FROM cart c
            JOIN products p ON c.product_id = p.id
=======
require_once('db.php');

function getUserCartItems($userId) {
    $con = getConnection();
    $sql = "SELECT c.product_id, c.quantity, p.price FROM cart c 
            JOIN products p ON c.product_id = p.id 
>>>>>>> 1b4c921 (backup my checkout and payment work)
            WHERE c.user_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}

<<<<<<< HEAD
function placeOrder($userId, $totalAmount) {
    $con = getConnection();
    $sql = "INSERT INTO orders (user_id, total_amount, status, order_date)
            VALUES (?, ?, 'pending', NOW())";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "id", $userId, $totalAmount);
=======
function placeOrder($userId, $totalAmount, $address, $paymentMethod) {
    $con = getConnection();
    $sql = "INSERT INTO orders (user_id, total_amount, address, payment_method, order_date) 
            VALUES (?, ?, ?, ?, NOW())";
    
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "idss", $userId, $totalAmount, $address, $paymentMethod);
    
>>>>>>> 1b4c921 (backup my checkout and payment work)
    if (mysqli_stmt_execute($stmt)) {
        return mysqli_insert_id($con);
    }
    return false;
}

function insertOrderItem($orderId, $productId, $quantity, $unitPrice) {
    $con = getConnection();
<<<<<<< HEAD
    $sql = "INSERT INTO order_items (order_id, product_id, quantity, unit_price)
=======
    $sql = "INSERT INTO order_items (order_id, product_id, quantity, unit_price) 
>>>>>>> 1b4c921 (backup my checkout and payment work)
            VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "iiid", $orderId, $productId, $quantity, $unitPrice);
    return mysqli_stmt_execute($stmt);
}

<<<<<<< HEAD
function insertPayment($orderId, $amount, $paymentMethod) {
    $con = getConnection();
    $sql = "INSERT INTO payments (order_id, amount, payment_method, payment_date)
            VALUES (?, ?, ?, NOW())";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ids", $orderId, $amount, $paymentMethod);
    return mysqli_stmt_execute($stmt);
}

=======
>>>>>>> 1b4c921 (backup my checkout and payment work)
function clearCart($userId) {
    $con = getConnection();
    $sql = "DELETE FROM cart WHERE user_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    return mysqli_stmt_execute($stmt);
}
<<<<<<< HEAD
?>
=======
?>
>>>>>>> 1b4c921 (backup my checkout and payment work)
