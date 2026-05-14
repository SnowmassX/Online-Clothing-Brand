<?php

session_start();

require_once __DIR__ . '/../model/CartModel.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(array('success' => false, 'error' => 'not_logged_in'));
    exit;
}

$user_id = (int) $_SESSION['user_id'];
$action  = isset($_POST['action']) ? trim($_POST['action']) : '';

$cartModel = new CartModel();

if ($action == 'add') {

    $product_id = isset($_POST['product_id']) ? (int) $_POST['product_id'] : 0;
    $quantity   = isset($_POST['quantity'])   ? (int) $_POST['quantity']   : 1;

    if ($product_id <= 0) {
        echo json_encode(array('success' => false, 'error' => 'Invalid product'));
        exit;
    }

    if ($quantity <= 0) {
        echo json_encode(array('success' => false, 'error' => 'Invalid quantity'));
        exit;
    }

    $product = $cartModel->getProductById($product_id);

    if (!$product) {
        echo json_encode(array('success' => false, 'error' => 'Product not found'));
        exit;
    }

    if ($product['stock'] <= 0) {
        echo json_encode(array('success' => false, 'error' => 'Product is out of stock'));
        exit;
    }

    if ($quantity > $product['stock']) {
        echo json_encode(array('success' => false, 'error' => 'Not enough stock available'));
        exit;
    }

    $cartModel->addToCart($user_id, $product_id, $quantity);
    $cart_count = $cartModel->getCartCount($user_id);

    echo json_encode(array('success' => true, 'cart_count' => $cart_count));
    exit;
}

if ($action == 'update') {

    $product_id = isset($_POST['product_id']) ? (int) $_POST['product_id'] : 0;
    $quantity   = isset($_POST['quantity'])   ? (int) $_POST['quantity']   : 1;

    if ($product_id <= 0) {
        echo json_encode(array('success' => false, 'error' => 'Invalid product'));
        exit;
    }

    if ($quantity <= 0) {
        echo json_encode(array('success' => false, 'error' => 'Quantity must be at least 1'));
        exit;
    }

    $product = $cartModel->getProductById($product_id);

    if (!$product) {
        echo json_encode(array('success' => false, 'error' => 'Product not found'));
        exit;
    }

    if ($quantity > $product['stock']) {
        echo json_encode(array('success' => false, 'error' => 'Not enough stock available'));
        exit;
    }

    $cartModel->updateQuantity($user_id, $product_id, $quantity);

    $subtotal   = $quantity * $product['price'];
    $cart_count = $cartModel->getCartCount($user_id);

    $cartItems = $cartModel->getCartByUser($user_id);
    $total = 0;
    foreach ($cartItems as $item) {
        $total += $item['quantity'] * $item['price'];
    }

    echo json_encode(array(
        'success'    => true,
        'subtotal'   => number_format($subtotal, 2),
        'total'      => number_format($total, 2),
        'cart_count' => $cart_count
    ));
    exit;
}

if ($action == 'remove') {

    $product_id = isset($_POST['product_id']) ? (int) $_POST['product_id'] : 0;

    if ($product_id <= 0) {
        echo json_encode(array('success' => false, 'error' => 'Invalid product'));
        exit;
    }

    $cartModel->removeItem($user_id, $product_id);

    $cart_count = $cartModel->getCartCount($user_id);

    $cartItems = $cartModel->getCartByUser($user_id);
    $total = 0;
    foreach ($cartItems as $item) {
        $total += $item['quantity'] * $item['price'];
    }

    echo json_encode(array(
        'success'    => true,
        'cart_count' => $cart_count,
        'total'      => number_format($total, 2)
    ));
    exit;
}

echo json_encode(array('success' => false, 'error' => 'Invalid action'));
?>
