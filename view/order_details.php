<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

<<<<<<< HEAD
<<<<<<< HEAD
require_once __DIR__ . '/../controller/orderController.php';

$orderId = isset($_GET['id']) ? (int) $_GET['id'] : null;
=======
require_once('../controller/orderController.php');
$orderId = $_GET['id'] ?? null;
>>>>>>> 1b4c921 (backup my checkout and payment work)
=======
require_once __DIR__ . '/../controller/orderController.php';

$orderId = isset($_GET['id']) ? (int) $_GET['id'] : null;
>>>>>>> e0ea6a1 (Fixed task 4 checkout and order system integration issues)

if (!$orderId) {
    header("Location: purchase_history.php");
    exit();
}

<<<<<<< HEAD
<<<<<<< HEAD
$result = getSpecificOrderDetails($orderId);
?>
<!DOCTYPE html>
<html lang="en">
<<<<<<< HEAD
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
=======
$result = getSpecificOrderDetails($orderId);
>>>>>>> 1b4c921 (backup my checkout and payment work)
?>

<html>
=======
>>>>>>> e0ea6a1 (Fixed task 4 checkout and order system integration issues)
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
<<<<<<< HEAD
>>>>>>> 004b1b1 (Updated checkout and added order management & payment views)
=======
>>>>>>> e0ea6a1 (Fixed task 4 checkout and order system integration issues)
