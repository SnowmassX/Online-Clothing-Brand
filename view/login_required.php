<?php

session_start();

if (isset($_SESSION['id'])) {
    header('Location: cart.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Required</title>
    <link rel="stylesheet" href="../asset/css/login_required.css">
</head>
<body>

<nav class="navbar">
    <a class="brand" href="../index.php">StyleStore</a>
    <div class="nav-links">
        <a href="search_results.php">Browse</a>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    </div>
</nav>

<div class="container">
    <div class="box">
        <div class="icon">🔒</div>
        <h2>Login Required</h2>
        <p>You need to login first to access your cart and place orders.</p>
        <p>Browsing and searching products is free for everyone.</p>
        <div class="buttons">
            <a href="login.php" class="login-btn">Login</a>
            <a href="register.php" class="register-btn">Register</a>
        </div>
        <a href="search_results.php" class="browse-link">Continue Browsing</a>
    </div>
</div>

</body>
</html>
