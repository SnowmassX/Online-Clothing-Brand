<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

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
</body>
</html>