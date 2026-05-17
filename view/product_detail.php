<?php

session_start();

require_once __DIR__ . '/../model/ProductDetailModel.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: search_results.php');
    exit;
}

$id = (int) $_GET['id'];

$productDetailModel = new ProductDetailModel();
$product = $productDetailModel->getProductById($id);

if (!$product) {
    header('Location: search_results.php');
    exit;
}

$sizeChart = array();
if ($product['size_chart'] != null && $product['size_chart'] != '') {
    $decoded = json_decode($product['size_chart'], true);
    if ($decoded != null) {
        $sizeChart = $decoded;
    }
}

$imgSrc = '../asset/img/no-image.jpg';
if ($product['image_path'] != null && $product['image_path'] != '') {
    $imgSrc = '../asset/uploads/products/' . $product['image_path'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?></title>
    <link rel="stylesheet" href="../asset/css/product_detail.css">
</head>
<body>

<nav class="navbar">
    <a class="brand" href="../index.php">StyleStore</a>
    <div class="nav-links">
        <a href="search_results.php">Browse</a>
        <?php if (isset($_SESSION['id'])): ?>
            <a href="cart.php">Cart <span class="cart-badge" id="cart-count">0</span></a>
            <a href="purchase_history.php">My Orders</a>
            <a href="profile.php"><?php echo htmlspecialchars($_SESSION['name']); ?></a>
            <a href="../controller/logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php endif; ?>
    </div>
</nav>

<div class="detail-wrapper">

    <div class="product-image-box">
        <img src="<?php echo $imgSrc; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
    </div>

    <div class="product-info-box">

        <h1 class="product-name"><?php echo htmlspecialchars($product['name']); ?></h1>

        <div class="product-meta">
            <span><?php echo htmlspecialchars($product['gender']); ?></span>
            <span>&middot;</span>
            <span><?php echo htmlspecialchars($product['category_name']); ?></span>
        </div>

        <div class="product-price">Tk <?php echo number_format($product['price'], 2); ?></div>

        <div class="product-stock">
            <?php if ($product['stock'] > 0): ?>
                <span class="in-stock">In Stock (<?php echo $product['stock']; ?> available)</span>
            <?php else: ?>
                <span class="out-stock">Out of Stock</span>
            <?php endif; ?>
        </div>

        <div class="product-description">
            <h3>Description</h3>
            <p><?php echo htmlspecialchars($product['description']); ?></p>
        </div>

        <?php if (count($sizeChart) > 0): ?>
        <div class="size-chart">
            <h3>Size Chart</h3>
            <table>
                <thead>
                    <tr>
                        <?php foreach ($sizeChart as $size => $measurement): ?>
                            <th><?php echo htmlspecialchars($size); ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php foreach ($sizeChart as $size => $measurement): ?>
                            <td><?php echo htmlspecialchars($measurement); ?></td>
                        <?php endforeach; ?>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php endif; ?>

        <?php if ($product['stock'] > 0): ?>
        <div class="quantity-box">
            <h3>Quantity</h3>
            <div class="quantity-controls">
                <button id="minus-btn">-</button>
                <input type="number" id="quantity-input" value="1" min="1" max="<?php echo $product['stock']; ?>">
                <button id="plus-btn">+</button>
            </div>
            <p id="quantity-error" class="quantity-error"></p>
        </div>

        <button class="add-to-cart-btn" id="add-to-cart-btn"
                data-product-id="<?php echo $product['id']; ?>"
                data-stock="<?php echo $product['stock']; ?>">
            Add to Cart
        </button>

        <p id="cart-message" class="cart-message"></p>

        <?php else: ?>
            <button class="add-to-cart-btn disabled" disabled>Out of Stock</button>
        <?php endif; ?>

    </div>
</div>

<script src="../asset/script/product_detail.js"></script>

</body>
</html>