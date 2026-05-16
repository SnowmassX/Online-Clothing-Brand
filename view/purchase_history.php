<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once('../controller/orderController.php');
$userId = $_SESSION['user_id'];

$result = getUserOrders($userId);
?>

<html>
<head>
    <title>Purchase History</title>
    <link rel="stylesheet" href="../asset/css/purchase_history.css">
</head>
<body>
    <div class="history-container">
        <h2>Your Purchase History</h2>

        <?php if ($result && mysqli_num_rows($result) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Total Amount</th>
                        <th>Order Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td>#<?php echo $row['order_id']; ?></td>
                            <td><?php echo date('d M Y, h:i A', strtotime($row['order_date'])); ?></td>
                            <td><?php echo number_format($row['total_amount'], 2); ?> TK</td>
                            <td>
                                <?php if (($row['payment_status'] ?? '') === 'Complete'): ?>
                                    <span class="status-badge status-paid" style="color: green; font-weight: bold;">Paid</span>
                                <?php else: ?>
                                    <span class="status-badge status-pending" style="color: orange; font-weight: bold;">Pending</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="order_details.php?id=<?php echo $row['order_id']; ?>" class="btn-view" style="color: #007bff; text-decoration: none; font-weight: bold;">View Details</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="no-orders">
                <p>You haven't placed any orders yet.</p>
            </div>
        <?php endif; ?>

        <br>
        <a href="dashboard.php" class="btn-back">Back to Dashboard</a>
    </div>
</body>
</html>