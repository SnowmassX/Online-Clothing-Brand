<?php
session_start();
require_once('../model/orderModel.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../view/login.php");
        exit();
    }

    $orderId = isset($_POST['order_id']) ? $_POST['order_id'] : null;
    $paymentMethod = isset($_POST['payment_method']) ? $_POST['payment_method'] : 'bKash';
    $accountNumber = $_POST['account_number'];
    $pin = $_POST['pin'];

    if (empty($accountNumber) || empty($pin)) {
        header("Location: ../view/payment.php?error=empty_fields&amount=" . $_POST['amount'] . "&order_id=" . $orderId);
        exit();
    }

    $paymentStatus = true; 

    if ($paymentStatus) {
        header("Location: ../view/order_success.php");
        exit();
    } else {
        header("Location: ../view/payment.php?error=payment_failed&amount=" . $_POST['amount'] . "&order_id=" . $orderId);
        exit();
    }
} else {
    header("Location: ../view/checkout.php");
    exit();
}
?>