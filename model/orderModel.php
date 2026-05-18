<?php
require_once __DIR__ . '/db.php';

function getPurchaseHistory($userId) {
    $con = getConnection();
    $sql = "SELECT o.id AS order_id, o.total_amount, o.status, o.order_date,
                   p.payment_method
            FROM orders o
            LEFT JOIN payments p ON o.id = p.order_id
            WHERE o.user_id = ?
            ORDER BY o.order_date DESC";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}

function getOrderDetails($orderId) {
    $con = getConnection();
    $sql = "SELECT oi.quantity, oi.unit_price, pr.name AS product_name
            FROM order_items oi
            JOIN products pr ON oi.product_id = pr.id
            WHERE oi.order_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $orderId);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}
?>
