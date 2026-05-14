<?php
session_start();
require_once('../model/orderModel.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../view/login.php");
        exit();
    }

    $userId = $_SESSION['user_id'];
    $address = $_POST['address'];
    $paymentMethod = $_POST['payment_method'];
    $totalAmount = $_POST['total_amount'];

    if (empty($address) || empty($paymentMethod)) {
        header("Location: ../view/checkout.php?error=empty_fields");
        exit();
    }

    $orderId = placeOrder($userId, $totalAmount, $address, $paymentMethod);

    if ($orderId) {
        clearCart($userId);
        header("Location: ../view/home.php?status=success");
    } else {
        header("Location: ../view/checkout.php?error=db_error");
    }
} else {
    header("Location: ../view/checkout.php");
}
?>