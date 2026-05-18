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
<<<<<<< HEAD
<<<<<<< HEAD
        header("Location: ../view/cart.php?error=empty_cart");
        exit();
    }

    $orderId = placeOrder($userId, $totalAmount);

    if ($orderId) {
        $cartResult = getUserCartItems($userId);
=======
        header("Location: ../view/checkout.php?error=empty_cart");
=======
        header("Location: ../view/cart.php?error=empty_cart");
>>>>>>> e0ea6a1 (Fixed task 4 checkout and order system integration issues)
        exit();
    }

    $orderId = placeOrder($userId, $totalAmount);

    if ($orderId) {
<<<<<<< HEAD
>>>>>>> 1b4c921 (backup my checkout and payment work)
=======
        $cartResult = getUserCartItems($userId);
>>>>>>> e0ea6a1 (Fixed task 4 checkout and order system integration issues)
        while ($item = mysqli_fetch_assoc($cartResult)) {
            insertOrderItem($orderId, $item['product_id'], $item['quantity'], $item['price']);
        }

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> e0ea6a1 (Fixed task 4 checkout and order system integration issues)
        insertPayment($orderId, $totalAmount, $paymentMethod);
        clearCart($userId);

        header("Location: ../view/order_success.php?order_id=" . $orderId);
        exit();
<<<<<<< HEAD
=======
        if ($paymentMethod === 'Cash on Delivery') {
            clearCart($userId);
            header("Location: ../view/order_success.php");
            exit();
        } else {
            header("Location: ../view/payment.php?amount=" . $totalAmount . "&order_id=" . $orderId);
            exit();
        }
>>>>>>> 1b4c921 (backup my checkout and payment work)
=======
>>>>>>> e0ea6a1 (Fixed task 4 checkout and order system integration issues)
    } else {
        header("Location: ../view/checkout.php?error=failed");
        exit();
    }

} else {
    header("Location: ../view/checkout.php");
    exit();
}
?>
