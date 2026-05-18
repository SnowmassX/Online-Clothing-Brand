<?php
require_once('db.php');

function createPayment($orderId, $amount, $accountNumber, $paymentMethod) {
    $con = getConnection();
    $sql = "INSERT INTO payments (order_id, amount, account_number, payment_method, status, payment_date) 
            VALUES (?, ?, ?, ?, 'Complete', NOW())";
            
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $orderId, $amount, $accountNumber, $paymentMethod);
    
    return mysqli_stmt_execute($stmt);
}
?>