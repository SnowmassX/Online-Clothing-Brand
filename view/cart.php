<?php

session_start();

<<<<<<< HEAD
<<<<<<< HEAD
if (!isset($_SESSION['id'])) {
=======
if (!isset($_SESSION['user_id'])) {
>>>>>>> e742baa (feat: add cart management with AJAX (Task 3))
=======
if (!isset($_SESSION['id'])) {
>>>>>>> 633f39a (fix: session variable, logout path and JS path corrections (Task 3))
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/../model/CartModel.php';

$cartModel = new CartModel();
<<<<<<< HEAD
<<<<<<< HEAD
$user_id   = (int) $_SESSION['id'];
=======
$user_id   = (int) $_SESSION['user_id'];
>>>>>>> e742baa (feat: add cart management with AJAX (Task 3))
=======
$user_id   = (int) $_SESSION['id'];
>>>>>>> 633f39a (fix: session variable, logout path and JS path corrections (Task 3))
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
<<<<<<< HEAD
        <a href="purchase_history.php">My Orders</a>
        <a href="profile.php"><?php echo htmlspecialchars($_SESSION['name']); ?></a>
        <a href="../controller/logout.php">Logout</a>
=======
        <a href="profile.php"><?php echo htmlspecialchars($_SESSION['name']); ?></a>
<<<<<<< HEAD
        <a href="../controller/AuthController.php?action=logout">Logout</a>
>>>>>>> e742baa (feat: add cart management with AJAX (Task 3))
=======
        <a href="../controller/logout.php">Logout</a>
>>>>>>> 633f39a (fix: session variable, logout path and JS path corrections (Task 3))
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
<<<<<<< HEAD
                            <img src="../asset/upload/products/<?php echo htmlspecialchars($item['image_path']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
=======
                            <img src="../public/uploads/products/<?php echo htmlspecialchars($item['image_path']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
>>>>>>> e742baa (feat: add cart management with AJAX (Task 3))
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
<<<<<<< HEAD
                        <div class="qty-controls">
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
                        <span id="qty-error-<?php echo $item['product_id']; ?>" style="color:red; font-size:12px;"></span>
=======
                        <button class="qty-btn minus-btn" data-product-id="<?php echo $item['product_id']; ?>">-</button>
                        <input type="number"
                               class="qty-input"
                               value="<?php echo $item['quantity']; ?>"
                               min="1"
                               max="<?php echo $item['stock']; ?>"
                               data-product-id="<?php echo $item['product_id']; ?>"
                               data-stock="<?php echo $item['stock']; ?>">
                        <button class="qty-btn plus-btn" data-product-id="<?php echo $item['product_id']; ?>">+</button>
>>>>>>> e742baa (feat: add cart management with AJAX (Task 3))
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

<<<<<<< HEAD
<<<<<<< HEAD
<script src="../asset/script/cart.js"></script>
<script src="../asset/script/validation.js"></script>

</body>
</html>
=======
<script src="../asset/js/cart.js"></script>

</body>
</html>
>>>>>>> e742baa (feat: add cart management with AJAX (Task 3))
=======
<script src="../asset/script/cart.js"></script>

</body>
</html>
>>>>>>> 633f39a (fix: session variable, logout path and JS path corrections (Task 3))
