<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once('../model/orderModel.php');

if (!isset($_GET['id'])) {
    header("Location: purchase_history.php");
    exit();
}

$orderId = $_GET['id'];
$details = getOrderDetails($orderId);
?>

<html>
<head>
    <title>Order Details</title>
</head>
<body>
    <h2>Order Details (ID: <?php echo $orderId; ?>)</h2>
    
    <table border="1">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $total = 0;
            while($item = mysqli_fetch_assoc($details)): 
                $subtotal = $item['quantity'] * $item['unit_price'];
                $total += $subtotal;
            ?>
            <tr>
                <td><?php echo $item['name']; ?></td>
                <td><?php echo $item['quantity']; ?></td>
                <td><?php echo $item['unit_price']; ?> TK</td>
                <td><?php echo number_format($subtotal, 2); ?> TK</td>
            </tr>
            <?php endwhile; ?>
            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td><strong><?php echo number_format($total, 2); ?> TK</strong></td>
            </tr>
        </tbody>
    </table>

    <br>
    <a href="purchase_history.php">Back to Purchase History</a> | 
    <a href="home.php">Back to Home</a>
</body>
</html>