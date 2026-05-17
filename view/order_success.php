<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
<<<<<<< HEAD

$order_id = $_GET['order_id'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Placed Successfully</title>
    <link rel="stylesheet" href="../asset/css/order_success.css">
</head>
<body>

<nav class="navbar">
    <a class="brand" href="home.php">StyleStore</a>
    <div class="nav-links">
        <a href="search_results.php">Browse</a>
        <a href="purchase_history.php">My Orders</a>
        <a href="../controller/logout.php">Logout</a>
    </div>
</nav>

<div class="success-container">
    <div class="success-icon">✅</div>
    <h1>Order Placed Successfully!</h1>
    <p>Thank you for your purchase. We have received your order.</p>

    <?php if ($order_id): ?>
        <div class="order-id-box">
            Order ID: <strong>#<?php echo htmlspecialchars($order_id); ?></strong>
        </div>
    <?php endif; ?>

    <div class="success-actions">
        <a href="home.php" class="btn-home">Return to Home</a>
        <a href="purchase_history.php" class="btn-orders">View My Orders</a>
    </div>
</div>

=======

$order_id = $_GET['order_id'] ?? null;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <link rel="stylesheet" href="../asset/css/order_success.css">
</head>
<body>
    <div class="success-container">
        <h1>Order Placed Successfully!</h1>
        <p>Thank you for your purchase. We have received your order.</p>
        
        <div class="order-id-box">
            Order ID: <span id="display-order-id">#<?php echo htmlspecialchars($order_id ?? 'Loading...'); ?></span>
        </div>
        
        <br><br>
        <a href="home.php">Return to Home</a> | 
        <a href="purchase_history.php">View Your Orders</a>
    </div>

    <script src="../asset/script/order_success.js"></script>
>>>>>>> 028d60b (Task 4 added completely)
</body>
</html>
