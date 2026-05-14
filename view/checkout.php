<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
require_once('../model/db.php');
$user_id = $_SESSION['user_id'];
$con = getConnection();

<<<<<<< HEAD
$userId     = (int) $_SESSION['id'];
$cartResult = getUserCartItems($userId);

if (mysqli_num_rows($cartResult) == 0) {
    header("Location: cart.php");
    exit();
}

$items       = array();
$totalAmount = 0;

while ($item = mysqli_fetch_assoc($cartResult)) {
    $subtotal     = $item['quantity'] * $item['price'];
    $totalAmount += $subtotal;
    $items[]      = $item;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="../asset/css/checkout.css">
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

<div class="checkout-container">
    <h2>Invoice Summary</h2>

    <table class="invoice-table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <?php $subtotal = $item['quantity'] * $item['price']; ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>Tk <?php echo number_format($item['price'], 2); ?></td>
                    <td>Tk <?php echo number_format($subtotal, 2); ?></td>
                </tr>
            <?php endforeach; ?>
            <tr class="total-row">
                <td colspan="3">Total Amount</td>
                <td>Tk <?php echo number_format($totalAmount, 2); ?></td>
            </tr>
        </tbody>
    </table>

    <form id="checkoutForm" action="../controller/placeOrderAction.php" method="POST">
        <input type="hidden" name="total_amount" value="<?php echo $totalAmount; ?>">

        <div class="payment-section">
            <h3>Select Payment Method</h3>
            <div class="payment-methods">
                <label><input type="radio" name="payment_method" value="bkash" required> bKash</label>
                <label><input type="radio" name="payment_method" value="nagad"> Nagad</label>
                <label><input type="radio" name="payment_method" value="card"> Credit/Debit Card</label>
                <label><input type="radio" name="payment_method" value="cash"> Cash on Delivery</label>
            </div>
            <p id="payment-error" style="color:red; font-size:13px;"></p>
        </div>

        <div class="btn-group">
            <a href="cart.php" class="btn-cancel">Cancel</a>
            <button type="submit" class="btn-continue">Place Order</button>
        </div>
    </form>
</div>

<script src="../asset/script/checkout.js"></script>
=======
$sql = "SELECT c.quantity, p.name, p.price FROM cart c JOIN products p ON c.product_id = p.id WHERE c.user_id = $user_id";
$result = mysqli_query($con, $sql);
$total_amount = 0;
?>

<html>
<head><title>Checkout</title></head>
<body>
    <h2>Checkout</h2>
    <form action="../controller/placeOrderAction.php" method="POST">
        <table border="1">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($result)): 
                $subtotal = $row['quantity'] * $row['price'];
                $total_amount += $subtotal;
            ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php echo number_format($subtotal, 2); ?></td>
            </tr>
            <?php endwhile; ?>
            <tr>
                <td colspan="3">Total Amount</td>
                <td><?php echo number_format($total_amount, 2); ?> TK</td>
            </tr>
        </table>

        <input type="hidden" name="total_amount" value="<?php echo $total_amount; ?>">

        <h3>Shipping Information</h3>
        <textarea name="address" required></textarea>

        <h3>Select Payment Method</h3>
        <input type="radio" name="payment_method" value="bKash" required> bKash
        <input type="radio" name="payment_method" value="Nagad"> Nagad
        <input type="radio" name="payment_method" value="Credit Card"> Credit Card
        <input type="radio" name="payment_method" value="Cash on Delivery"> Cash on Delivery

        <br><br>
        <button type="submit">Confirm Order</button>
    </form>
>>>>>>> 004b1b1 (Updated checkout and added order management & payment views)
</body>
</html>
