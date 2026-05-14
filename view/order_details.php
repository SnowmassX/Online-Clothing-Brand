<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

require_once __DIR__ . '/../controller/orderController.php';

$orderId = isset($_GET['id']) ? (int) $_GET['id'] : null;

if (!$orderId) {
    header("Location: purchase_history.php");
    exit();
}

<<<<<<< HEAD
$result = getSpecificOrderDetails($orderId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="../asset/css/purchase_history.css">
</head>
<body>

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
    <h2>Order Invoice (#<?php echo htmlspecialchars($orderId); ?>)</h2>

    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <table>
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
                $grandTotal = 0;
                while ($row = mysqli_fetch_assoc($result)):
                    $subtotal    = $row['quantity'] * $row['unit_price'];
                    $grandTotal += $subtotal;
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td>Tk <?php echo number_format($row['unit_price'], 2); ?></td>
                        <td>Tk <?php echo number_format($subtotal, 2); ?></td>
                    </tr>
                <?php endwhile; ?>
                <tr style="font-weight:bold; background-color:#f8f9fa;">
                    <td colspan="3" style="text-align:right;">Grand Total:</td>
                    <td>Tk <?php echo number_format($grandTotal, 2); ?></td>
                </tr>
            </tbody>
        </table>
    <?php else: ?>
        <div class="no-orders">
            <p>No details found for this order.</p>
        </div>
    <?php endif; ?>

    <br>
    <a href="purchase_history.php" class="btn-back">Back to History</a>
</div>

</body>
</html>
=======
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
>>>>>>> 004b1b1 (Updated checkout and added order management & payment views)
