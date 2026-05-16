<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../view/login.php");
    exit();
}

require_once('../model/checkoutModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $totalAmount = $_POST['total_amount'] ?? 0;
    $address = $_POST['address'] ?? '';
    $paymentMethod = $_POST['payment_method'] ?? '';

    if (empty($address) || empty($paymentMethod)) {
        header("Location: ../view/checkout.php?error=empty_fields");
        exit();
    }

    $cartResult = getUserCartItems($userId);
    if (mysqli_num_rows($cartResult) == 0) {
        header("Location: ../view/checkout.php?error=empty_cart");
        exit();
    }

    $orderId = placeOrder($userId, $totalAmount, $address, $paymentMethod);

    if ($orderId) {
        while ($item = mysqli_fetch_assoc($cartResult)) {
            insertOrderItem($orderId, $item['product_id'], $item['quantity'], $item['price']);
        }

        if ($paymentMethod === 'Cash on Delivery') {
            clearCart($userId);
            header("Location: ../view/order_success.php");
            exit();
        } else {
            header("Location: ../view/payment.php?amount=" . $totalAmount . "&order_id=" . $orderId);
            exit();
        }
    } else {
        header("Location: ../view/checkout.php?error=failed");
        exit();
    }
} else {
    header("Location: ../view/checkout.php");
    exit();
}
?>