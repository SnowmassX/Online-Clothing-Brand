<?php
require_once('../model/orderModel.php');

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
?>