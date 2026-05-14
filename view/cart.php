<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/../model/CartModel.php';

$cartModel = new CartModel();
$user_id   = (int) $_SESSION['user_id'];
$cartItems = $cartModel->getCartByUser($user_id);

$total = 0;
foreach ($cartItems as $item) {
    $total += $item['quantity'] * $item['price'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <link rel="stylesheet" href="../asset/css/cart.css">
</head>
<body>

<nav class="navbar">
    <a class="brand" href="../index.php">StyleStore</a>
    <div class="nav-links">
        <a href="search_results.php">Browse</a>
        <a href="cart.php">Cart <span class="cart-badge" id="cart-count"><?php echo count($cartItems); ?></span></a>
        <a href="profile.php"><?php echo htmlspecialchars($_SESSION['name']); ?></a>
        <a href="../controller/AuthController.php?action=logout">Logout</a>
    </div>
</nav>

<div class="cart-wrapper">

    <h2 class="cart-title">My Cart</h2>

    <?php if (count($cartItems) == 0): ?>
        <div class="empty-cart">
            <p>Your cart is empty.</p>
            <a href="search_results.php" class="continue-btn">Continue Shopping</a>
        </div>

    <?php else: ?>

        <div class="cart-items" id="cart-items">
            <?php foreach ($cartItems as $item): ?>
                <?php $subtotal = $item['quantity'] * $item['price']; ?>
                <div class="cart-row" id="row-<?php echo $item['product_id']; ?>">

                    <div class="cart-img">
                        <?php if ($item['image_path'] != null && $item['image_path'] != ''): ?>
                            <img src="../public/uploads/products/<?php echo htmlspecialchars($item['image_path']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                        <?php else: ?>
                            <img src="../asset/img/no-image.jpg" alt="no image">
                        <?php endif; ?>
                    </div>

                    <div class="cart-name">
                        <a href="product_detail.php?id=<?php echo $item['product_id']; ?>">
                            <?php echo htmlspecialchars($item['name']); ?>
                        </a>
                    </div>

                    <div class="cart-price">Tk <?php echo number_format($item['price'], 2); ?></div>

                    <div class="cart-qty">
                        <button class="qty-btn minus-btn" data-product-id="<?php echo $item['product_id']; ?>">-</button>
                        <input type="number"
                               class="qty-input"
                               value="<?php echo $item['quantity']; ?>"
                               min="1"
                               max="<?php echo $item['stock']; ?>"
                               data-product-id="<?php echo $item['product_id']; ?>"
                               data-stock="<?php echo $item['stock']; ?>">
                        <button class="qty-btn plus-btn" data-product-id="<?php echo $item['product_id']; ?>">+</button>
                    </div>

                    <div class="cart-subtotal" id="subtotal-<?php echo $item['product_id']; ?>">
                        Tk <?php echo number_format($subtotal, 2); ?>
                    </div>

                    <div class="cart-remove">
                        <button class="remove-btn" data-product-id="<?php echo $item['product_id']; ?>">Remove</button>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>

        <div class="cart-footer">
            <div class="cart-total">
                Total: <span id="cart-total">Tk <?php echo number_format($total, 2); ?></span>
            </div>
            <div class="cart-actions">
                <a href="search_results.php" class="continue-btn">Continue Shopping</a>
                <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
            </div>
        </div>

    <?php endif; ?>

</div>

<script src="../asset/js/cart.js"></script>

</body>
</html>
