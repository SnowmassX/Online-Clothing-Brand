<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<html>
<head>
    <title>Order Success</title>
</head>
<body>
    <div style="text-align: center; margin-top: 100px;">
        <h1>Order Placed Successfully!</h1>
        <p>Thank you for your purchase. We have received your order.</p>
        <br>
        <a href="home.php">Return to Home</a> | 
        <a href="purchase_history.php">View Your Orders</a>
    </div>
</body>
</html>