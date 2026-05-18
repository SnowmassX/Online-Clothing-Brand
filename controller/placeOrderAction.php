<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../view/login.php");
    exit();
}

require_once __DIR__ . '/../model/checkoutModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $userId        = (int) $_SESSION['id'];
    $totalAmount   = $_POST['total_amount'] ?? 0;
    $paymentMethod = $_POST['payment_method'] ?? '';

    if (empty($paymentMethod)) {
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
