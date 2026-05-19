<?php
session_start();

header("Content-Type: application/json");

require_once __DIR__ . "/../model/AdminModel.php";
require_once __DIR__ . "/../model/helpers.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Only admin allowed']);
    exit;
}

$order_id = $_POST['order_id'] ?? '';
$status = $_POST['status'] ?? '';
$token = $_POST['csrf_token'] ?? '';

if (!checkToken($token)) {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

if ($order_id === '' || !is_numeric($order_id)) {
    echo json_encode(['success' => false, 'message' => 'Invalid order ID']);
    exit;
}

if ($status !== "confirmed" && $status !== "rejected") {
    echo json_encode(['success' => false, 'message' => 'Invalid status']);
    exit;
}

$result = updateOrderStatus((int)$order_id, $status);

if ($result) {
    echo json_encode(['success' => true, 'message' => 'Order updated successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Order update failed']);
}
?>