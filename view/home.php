<<<<<<< HEAD
<<<<<<< HEAD
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - StyleStore</title>
    <link rel="stylesheet" href="../asset/css/home.css">
</head>
<body>

    <header id="header">
        <div id="logo">StyleStore</div>

        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Search products...">
            <button type="button" id="searchBtn">Search</button>
        </div>

        <nav id="navbar">
            <a href="home.php">Home</a>
            <a href="product_detail.php">Products</a>
            <?php if (isset($_SESSION['id'])): ?>
                <a href="cart.php">Cart</a>
                <a href="profile.php"><?php echo htmlspecialchars($_SESSION['name']); ?></a>
                <a href="../controller/logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="registration.php">Register</a>
            <?php endif; ?>
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
                    <p class="price"><span class="old-price">$35</span> $25</p>
                    <a href="search_results.php" class="view-btn">View Details</a>
                </div>
            </div>

            <div class="product-card">
                <img src="../asset/upload/home/p2.jpg" alt="Denim Jeans">
                <div class="product-info">
                    <span class="badge">Sale</span>
                    <h3>Denim Jeans</h3>
                    <p class="price"><span class="old-price">$60</span> $45</p>
                    <a href="search_results.php" class="view-btn">View Details</a>
                </div>
            </div>

            <div class="product-card">
                <img src="../asset/upload/home/p3.jpg" alt="Winter Jacket">
                <div class="product-info">
                    <span class="badge">Hot</span>
                    <h3>Winter Jacket</h3>
                    <p class="price"><span class="old-price">$120</span> $95</p>
                    <a href="search_results.php" class="view-btn">View Details</a>
                </div>
            </div>
        </div>
    </main>

    <footer id="footer">
        <p id="footerText">© 2026 Fashion Store. All Rights Reserved.</p>
    </footer>

    <script src="../asset/script/home.js"></script>
</body>
</html>
=======
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - StyleStore</title>
    <link rel="stylesheet" href="../asset/css/home.css">
</head>
<body>

    <header id="header">
        <div id="logo">StyleStore</div>

        <div id="gender-nav">
            <a href="search_results.php?gender=Men">Men</a>
            <a href="search_results.php?gender=Women">Women</a>
        </div>

        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Search products...">
            <button type="button" id="searchBtn">Search</button>
        </div>

        <nav id="navbar">
            <a href="home.php">Home</a>
            <a href="search_results.php">Products</a>
            <?php if (isset($_SESSION['id'])): ?>
                <a href="cart.php">Cart</a>
                <a href="profile.php"><?php echo htmlspecialchars($_SESSION['name']); ?></a>
                <a href="../controller/logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="registration.php">Register</a>
            <?php endif; ?>
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
                    <p class="price"><span class="old-price">$35</span> $25</p>
                    <a href="search_results.php" class="view-btn">View Details</a>
                </div>
            </div>

            <div class="product-card">
                <img src="../asset/upload/home/p2.jpg" alt="Denim Jeans">
                <div class="product-info">
                    <span class="badge">Sale</span>
                    <h3>Denim Jeans</h3>
                    <p class="price"><span class="old-price">$60</span> $45</p>
                    <a href="search_results.php" class="view-btn">View Details</a>
                </div>
            </div>

            <div class="product-card">
                <img src="../asset/upload/home/p3.jpg" alt="Winter Jacket">
                <div class="product-info">
                    <span class="badge">Hot</span>
                    <h3>Winter Jacket</h3>
                    <p class="price"><span class="old-price">$120</span> $95</p>
                    <a href="search_results.php" class="view-btn">View Details</a>
                </div>
            </div>
        </div>
    </main>

    <footer id="footer">
        <p id="footerText">© 2026 Fashion Store. All Rights Reserved.</p>
    </footer>

    <script src="../asset/script/home.js"></script>
</body>
</html>
>>>>>>> a58d868 (merge issue fixing 2)
=======
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - StyleStore</title>
    <link rel="stylesheet" href="../asset/css/home.css">
</head>
<body>

    <header id="header">
        <div id="logo">StyleStore</div>

        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Search products...">
            <button type="button" id="searchBtn">Search</button>
        </div>

        <nav id="navbar">
            <a href="home.php">Home</a>
            <a href="product_detail.php">Products</a>
            <?php if (isset($_SESSION['id'])): ?>
                <a href="cart.php">Cart</a>
                <a href="profile.php"><?php echo htmlspecialchars($_SESSION['name']); ?></a>
                <a href="../controller/logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="registration.php">Register</a>
            <?php endif; ?>
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
                    <p class="price"><span class="old-price">$35</span> $25</p>
                    <a href="search_results.php" class="view-btn">View Details</a>
                </div>
            </div>

            <div class="product-card">
                <img src="../asset/upload/home/p2.jpg" alt="Denim Jeans">
                <div class="product-info">
                    <span class="badge">Sale</span>
                    <h3>Denim Jeans</h3>
                    <p class="price"><span class="old-price">$60</span> $45</p>
                    <a href="search_results.php" class="view-btn">View Details</a>
                </div>
            </div>

            <div class="product-card">
                <img src="../asset/upload/home/p3.jpg" alt="Winter Jacket">
                <div class="product-info">
                    <span class="badge">Hot</span>
                    <h3>Winter Jacket</h3>
                    <p class="price"><span class="old-price">$120</span> $95</p>
                    <a href="search_results.php" class="view-btn">View Details</a>
                </div>
            </div>
        </div>
    </main>

    <footer id="footer">
        <p id="footerText">© 2026 Fashion Store. All Rights Reserved.</p>
    </footer>

    <script src="../asset/script/home.js"></script>
</body>
</html>
>>>>>>> 93bb743 (merge issue fixing 3)
