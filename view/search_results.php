<?php

session_start();

require_once __DIR__ . '/../model/SearchModel.php';

$searchModel   = new SearchModel();
$allCategories = $searchModel->getAllCategories();

$childCategories = array();
foreach ($allCategories as $cat) {
    if ($cat['parent_id'] != null) {
        $childCategories[] = $cat;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Products</title>
    <link rel="stylesheet" href="../asset/css/search.css">
</head>
<body>

<nav class="navbar">
    <a class="brand" href="../index.php">StyleStore</a>
    <div class="nav-links">
        <a href="../index.php">Home</a>
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

<div class="search-section">
    <div class="search-bar-wrap">
        <input type="text" id="search-input" placeholder="Search products...">
        <select id="gender-filter">
            <option value="">All Genders</option>
            <option value="Men">Men</option>
            <option value="Women">Women</option>
        </select>
        <select id="category-filter">
            <option value="">All Categories</option>
            <?php foreach ($childCategories as $cat): ?>
                <option value="<?php echo $cat['id']; ?>">
                    <?php echo htmlspecialchars($cat['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button id="search-btn">Search</button>
    </div>
    <p id="search-error" style="color:red; font-size:13px; text-align:center;"></p>
    <p id="result-count"></p>
</div>

<div class="product-grid-section">
    <div class="product-grid" id="product-grid">
        <p class="loading-msg">Loading products...</p>
    </div>
</div>

<script src="../asset/script/search.js"></script>
<script src="../asset/script/validation.js"></script>

</body>
</html>