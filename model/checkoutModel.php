<?php
require_once __DIR__ . '/db.php';

function getUserCartItems($userId) {
    $con = getConnection();
    $sql = "SELECT c.product_id, c.quantity, p.price, p.name
            FROM cart c
            JOIN products p ON c.product_id = p.id
            WHERE c.user_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}

function placeOrder($userId, $totalAmount) {
    $con = getConnection();
    $sql = "INSERT INTO orders (user_id, total_amount, status, order_date)
            VALUES (?, ?, 'pending', NOW())";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "id", $userId, $totalAmount);
    if (mysqli_stmt_execute($stmt)) {
        return mysqli_insert_id($con);
    }
    return false;
}

function insertOrderItem($orderId, $productId, $quantity, $unitPrice) {
    $con = getConnection();
    $sql = "INSERT INTO order_items (order_id, product_id, quantity, unit_price)
            VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "iiid", $orderId, $productId, $quantity, $unitPrice);
    return mysqli_stmt_execute($stmt);
}

function insertPayment($orderId, $amount, $paymentMethod) {
    $con = getConnection();
    $sql = "INSERT INTO payments (order_id, amount, payment_method, payment_date)
            VALUES (?, ?, ?, NOW())";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ids", $orderId, $amount, $paymentMethod);
    return mysqli_stmt_execute($stmt);
}

function clearCart($userId) {
    $con = getConnection();
    $sql = "DELETE FROM cart WHERE user_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    return mysqli_stmt_execute($stmt);
}
?>
