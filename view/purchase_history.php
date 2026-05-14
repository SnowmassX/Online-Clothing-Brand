<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once('../model/orderModel.php');
$userId = $_SESSION['user_id'];
$orders = getPurchaseHistory($userId);
?>

<html>
<head>
    <title>Purchase History</title>
</head>
<body>
    <h2>Your Purchase History</h2>
    <table border="1" width="100%">
        <tr>
            <th>Order ID</th>
            <th>Date</th>
            <th>Total Amount</th>
            <th>Status</th>
            <th>Payment Method</th>
            <th>Action</th>
        </tr>
        <?php while($order = mysqli_fetch_assoc($orders)): ?>
        <tr>
            <td><?php echo $order['id']; ?></td>
            <td><?php echo $order['created_at']; ?></td>
            <td><?php echo $order['total_price']; ?> TK</td>
            <td><?php echo $order['status']; ?></td>
            <td><?php echo $order['payment_method']; ?></td>
            <td>
                <a href="order_details.php?id=<?php echo $order['id']; ?>">View Details</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="home.php">Back to Home</a>
</body>
</html>