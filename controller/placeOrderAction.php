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

    $cartResult = getUserCartItems($userId);
    if (mysqli_num_rows($cartResult) == 0) {
        header("Location: ../view/cart.php?error=empty_cart");
        exit();
    }

    $orderId = placeOrder($userId, $totalAmount);

    if ($orderId) {
        $cartResult = getUserCartItems($userId);
        while ($item = mysqli_fetch_assoc($cartResult)) {
            insertOrderItem($orderId, $item['product_id'], $item['quantity'], $item['price']);
        }

        insertPayment($orderId, $totalAmount, $paymentMethod);
        clearCart($userId);

        header("Location: ../view/order_success.php?order_id=" . $orderId);
        exit();
    } else {
        header("Location: ../view/checkout.php?error=failed");
        exit();
    }

} else {
    header("Location: ../view/checkout.php");
    exit();
}
?>
