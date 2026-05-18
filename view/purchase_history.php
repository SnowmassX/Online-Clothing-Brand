<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

require_once __DIR__ . '/../controller/orderController.php';

$userId = (int) $_SESSION['id'];
$result = getUserOrders($userId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase History</title>
    <link rel="stylesheet" href="../asset/css/purchase_history.css">
</head>
<body>
<<<<<<< HEAD
<<<<<<< HEAD

<nav class="navbar">
    <a class="brand" href="home.php">StyleStore</a>
    <div class="nav-links">
        <a href="search_results.php">Browse</a>
        <a href="cart.php">Cart</a>
        <a href="purchase_history.php">My Orders</a>
        <a href="../controller/logout.php">Logout</a>
    </div>
</nav>

<div class="history-container">
    <h2>Your Purchase History</h2>

    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Total Amount</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td>#<?php echo $row['order_id']; ?></td>
                        <td><?php echo date('d M Y, h:i A', strtotime($row['order_date'])); ?></td>
                        <td>Tk <?php echo number_format($row['total_amount'], 2); ?></td>
                        <td><?php echo htmlspecialchars($row['payment_method'] ?? 'N/A'); ?></td>
                        <td>
                            <?php if ($row['status'] == 'confirmed'): ?>
                                <span style="color:green; font-weight:bold;">Confirmed</span>
                            <?php elseif ($row['status'] == 'rejected'): ?>
                                <span style="color:red; font-weight:bold;">Rejected</span>
                            <?php else: ?>
                                <span style="color:orange; font-weight:bold;">Pending</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="order_details.php?id=<?php echo $row['order_id']; ?>" style="color:#007bff; font-weight:bold; text-decoration:none;">View Details</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="no-orders">
            <p>You have not placed any orders yet.</p>
            <a href="search_results.php" class="btn-back">Start Shopping</a>
        </div>
    <?php endif; ?>

    <br>
    <a href="home.php" class="btn-back">Back to Home</a>
</div>

=======
    <div class="history-container">
        <h2>Your Purchase History</h2>
=======
>>>>>>> e0ea6a1 (Fixed task 4 checkout and order system integration issues)

<nav class="navbar">
    <a class="brand" href="home.php">StyleStore</a>
    <div class="nav-links">
        <a href="search_results.php">Browse</a>
        <a href="cart.php">Cart</a>
        <a href="purchase_history.php">My Orders</a>
        <a href="../controller/logout.php">Logout</a>
    </div>
<<<<<<< HEAD
>>>>>>> 1b4c921 (backup my checkout and payment work)
=======
</nav>

<div class="history-container">
    <h2>Your Purchase History</h2>

    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Total Amount</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td>#<?php echo $row['order_id']; ?></td>
                        <td><?php echo date('d M Y, h:i A', strtotime($row['order_date'])); ?></td>
                        <td>Tk <?php echo number_format($row['total_amount'], 2); ?></td>
                        <td><?php echo htmlspecialchars($row['payment_method'] ?? 'N/A'); ?></td>
                        <td>
                            <?php if ($row['status'] == 'confirmed'): ?>
                                <span style="color:green; font-weight:bold;">Confirmed</span>
                            <?php elseif ($row['status'] == 'rejected'): ?>
                                <span style="color:red; font-weight:bold;">Rejected</span>
                            <?php else: ?>
                                <span style="color:orange; font-weight:bold;">Pending</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="order_details.php?id=<?php echo $row['order_id']; ?>" style="color:#007bff; font-weight:bold; text-decoration:none;">View Details</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="no-orders">
            <p>You have not placed any orders yet.</p>
            <a href="search_results.php" class="btn-back">Start Shopping</a>
        </div>
    <?php endif; ?>

    <br>
    <a href="home.php" class="btn-back">Back to Home</a>
</div>

>>>>>>> e0ea6a1 (Fixed task 4 checkout and order system integration issues)
</body>
</html>
