<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

<<<<<<< HEAD
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
=======
require_once('../model/checkoutModel.php');
$userId = $_SESSION['user_id'];

$cartResult = getUserCartItems($userId);

if (mysqli_num_rows($cartResult) == 0) {
    header("Location: cart.php?error=empty_cart");
    exit();
}
>>>>>>> 1b4c921 (backup my checkout and payment work)
?>

<html>
<head>
    <title>Checkout - Invoice Summary</title>
    <link rel="stylesheet" href="../asset/css/checkout.css">
</head>
<body>
    <div class="checkout-container">
        <h2>Invoice Summary</h2>
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; margin-bottom: 20px; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $totalAmount = 0;
                while($item = mysqli_fetch_assoc($cartResult)): 
                    $subtotal = $item['quantity'] * $item['price'];
                    $totalAmount += $subtotal;
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['name'] ?? 'Product'); ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td><?php echo number_format($item['price'], 2); ?> TK</td>
                        <td><?php echo number_format($subtotal, 2); ?> TK</td>
                    </tr>
                <?php endwhile; ?>
                <tr style="font-weight: bold; background-color: #f9f9f9;">
                    <td colspan="3" style="text-align: right;">Total Amount:</td>
                    <td><?php echo number_format($totalAmount, 2); ?> TK</td>
                </tr>
            </tbody>
        </table>

        <form id="checkoutForm" action="../controller/checkoutController.php" method="POST">
            <input type="hidden" name="total_amount" value="<?php echo $totalAmount; ?>">
            
            <h3>Shipping Address</h3>
            <textarea id="address" name="address" rows="3" placeholder="Enter your full shipping address..." style="width: 100%; padding: 10px; margin-bottom: 20px;"></textarea>
            
            <h3>Select Payment Method</h3>
            <select id="paymentMethod" name="payment_method" style="width: 100%; padding: 10px; margin-bottom: 20px;">
                <option value="">-- Choose Option --</option>
                <option value="Credit Card">Credit Card</option>
                <option value="bKash">bKash</option>
                <option value="Nagad">Nagad</option>
                <option value="Bank Transfer">Bank Transfer</option>
                <option value="Cash on Delivery">Cash on Delivery</option>
            </select>

            <div style="display: flex; justify-content: space-between; margin-top: 20px;">
                <a href="cart.php" class="btn-cancel" style="padding: 10px 20px; background-color: #ccc; color: #000; text-decoration: none; font-weight: bold; display: inline-block;">Cancel</a>
                <button type="submit" class="btn-continue" style="padding: 10px 20px; background-color: #28a745; color: #fff; border: none; font-weight: bold; cursor: pointer;">Continue & Place Order</button>
            </div>
        </form>
    </div>

    <script>
    document.getElementById('checkoutForm').addEventListener('submit', function(event) {
        var address = document.getElementById('address').value.trim();
        var paymentMethod = document.getElementById('paymentMethod').value;

<<<<<<< HEAD
        <br><br>
        <button type="submit">Confirm Order</button>
    </form>
>>>>>>> 004b1b1 (Updated checkout and added order management & payment views)
=======
        if (address === "") {
            alert("Please enter your shipping address.");
            event.preventDefault(); // Form submit hote dibe na
            return false;
        }

        if (paymentMethod === "") {
            alert("Please select a payment method.");
            event.preventDefault(); // Form submit hote dibe na
            return false;
        }
    });
    </script>
>>>>>>> 1b4c921 (backup my checkout and payment work)
</body>
</html>
