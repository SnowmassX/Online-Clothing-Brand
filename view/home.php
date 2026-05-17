<!-- home.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Online Clothing Brand</title>

    <link rel="stylesheet" href="../asset/css/home.css">
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
            <input type="text" id="searchInput" placeholder="Search products...">
            <button type="button" id="searchBtn">Search</button>
        </div>

        <nav id="navbar">
            <a href="home.php">Home</a>
            <a href="../controller/productController.php">
                Products
            </a>
            <a href="cart.php">Cart</a>
            <a href="purchase_history.php">My Orders</a>
            <a href="profile.php">Profile</a>
            <a href="login.php">Login</a>
            <a href="../controller/logout.php">Logout</a>
        </nav>

    </header>

    <main id="mainContent">

        <section class="hero">
            <h1>New Arrivals 2026</h1>
            <p>Discover the latest trends in fashion.</p>
        </section>

        <h2 class="section-title">Featured Products</h2>

        <div class="product-grid">

            <div class="product-card">

                <img src="../asset/upload/home/p1.jpg" alt="Casual Slim Shirt">

                <div class="product-info">

                    <span class="badge">New</span>

                    <h3>Casual Slim Shirt</h3>

                    <p class="price">
                        <span class="old-price">$35</span>
                        $25
                    </p>

                    <button class="view-btn">
                        View Details
                    </button>

                </div>

            </div>

            <div class="product-card">

                <img src="../asset/upload/home/p2.jpg" alt="Denim Jeans">

                <div class="product-info">

                    <span class="badge">Sale</span>

                    <h3>Denim Jeans</h3>

                    <p class="price">
                        <span class="old-price">$60</span>
                        $45
                    </p>

                    <button class="view-btn">
                        View Details
                    </button>

                </div>

            </div>

            <div class="product-card">

                <img src="../asset/upload/home/p3.jpg" alt="Winter Jacket">

                <div class="product-info">

                    <span class="badge">Hot</span>

                    <h3>Winter Jacket</h3>

                    <p class="price">
                        <span class="old-price">$120</span>
                        $95
                    </p>

                    <button class="view-btn">
                        View Details
                    </button>

                </div>

            </div>

        </div>

    </main>

    <footer id="footer">
        <p id="footerText">
            © 2026 Fashion Store. All Rights Reserved.
        </p>
    </footer>

    <script src="../asset/script/home.js"></script>

</body>

</html>