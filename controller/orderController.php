<?php
<<<<<<< HEAD
<<<<<<< HEAD
require_once __DIR__ . '/../model/orderModel.php';
=======
require_once('../model/orderModel.php');
>>>>>>> 1b4c921 (backup my checkout and payment work)
=======
require_once __DIR__ . '/../model/orderModel.php';
>>>>>>> e0ea6a1 (Fixed task 4 checkout and order system integration issues)

function getUserOrders($userId) {
    if (empty($userId)) {
        return false;
    }
    return getPurchaseHistory($userId);
}

function getSpecificOrderDetails($orderId) {
    if (empty($orderId)) {
        return false;
    }
    return getOrderDetails($orderId);
}
<<<<<<< HEAD
<<<<<<< HEAD
?>
=======
?>
>>>>>>> 1b4c921 (backup my checkout and payment work)
=======
?>
>>>>>>> e0ea6a1 (Fixed task 4 checkout and order system integration issues)
