<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

    <link rel="stylesheet" href="../asset/css/products.css">
</head>

<body>

    <header id="header">

        <div id="logo">
            Online Clothing Brand
        </div>

        <div id="gender-nav">

            <a href="../controller/categoryController.php?gender=men">
                Men
            </a>

            <a href="../controller/categoryController.php?gender=women">
                Women
            </a>

        </div>

        <div class="search-container">

            <input type="text"
                id="searchInput"
                placeholder="Search products...">

            <button type="button" id="searchBtn">
                Search
            </button>

        </div>

        <nav id="navbar">

            <a href="../view/home.php">Home</a>

            <a href="../controller/productController.php">
                Products
            </a>

            <a href="cart.php">Cart</a>

            <a href="profile.php">Profile</a>

            <a href="../view/login.php">Login</a>

            <a href="logout.php">Logout</a>

        </nav>

    </header>

    <main class="products-layout">

        <aside class="sidebar">

            <h2>Filters</h2>

            <div class="filter-section">

                <h3>Gender</h3>

                <a href="../controller/categoryController.php?gender=men">
                    Men
                </a>

                <a href="../controller/categoryController.php?gender=women">
                    Women
                </a>

            </div>

            <div class="filter-section">

                <h3>Categories</h3>

                <a href="#">Shirts</a>
                <a href="#">Pants</a>
                <a href="#">T-Shirts</a>
                <a href="#">Jeans</a>
                <a href="#">Salwar</a>

            </div>

            <div class="filter-section">

                <h3>Price Range</h3>

                <a href="#">Under $20</a>
                <a href="#">$20 - $50</a>
                <a href="#">$50 - $100</a>

            </div>

        </aside>

        <section class="products-section">

            <h1 class="page-title">
                Products
            </h1>

            <div class="product-grid">

                <?php if (!isset($products)) {
                    $products = [];
                } ?>

                <?php foreach ($products as $product): ?>

                    <div class="product-card">

                        <img
                            src="../asset/upload/home/<?php echo $product['image_path']; ?>"
                            alt="Product">

                        <div class="product-info">

                            <h3>
                                <?php echo $product['name']; ?>
                            </h3>

                            <p class="description">
                                <?php echo $product['description']; ?>
                            </p>

                            <p class="price">
                                $<?php echo $product['price']; ?>
                            </p>

                            <button class="view-btn">
                                View Details
                            </button>

                            <button class="cart-btn">
                                Add To Cart
                            </button>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        </section>

    </main>

    <footer id="footer">

        <p id="footerText">
            © 2026 Fashion Store. All Rights Reserved.
        </p>

    </footer>

    <script src="../asset/script/home.js"></script>

</body>

</html>