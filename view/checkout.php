<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once('../model/checkoutModel.php');
$userId = $_SESSION['user_id'];

$cartResult = getUserCartItems($userId);

if (mysqli_num_rows($cartResult) == 0) {
    header("Location: cart.php?error=empty_cart");
    exit();
}
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

        <form id="checkoutForm" action="payment.php" method="POST">
            <input type="hidden" name="total_amount" value="<?php echo $totalAmount; ?>">
            
            <h3>Shipping Address</h3>
            <textarea id="address" name="address" rows="3" placeholder="Enter your full shipping address..." style="width: 100%; padding: 10px; margin-bottom: 20px;"></textarea>

            <div style="display: flex; justify-content: space-between; margin-top: 20px;">
                <a href="cart.php" class="btn-cancel" style="padding: 10px 20px; background-color: #ccc; color: #000; text-decoration: none; font-weight: bold; display: inline-block;">Cancel</a>
                <button type="submit" class="btn-continue" style="padding: 10px 20px; background-color: #28a745; color: #fff; border: none; font-weight: bold; cursor: pointer;">Continue to Payment</button>
            </div>
        </form>
    </div>

    <script>
    document.getElementById('checkoutForm').addEventListener('submit', function(event) {
        var address = document.getElementById('address').value.trim();

        if (address === "") {
            alert("Please enter your shipping address.");
            event.preventDefault(); 
            return false;
        }
    });
    </script>
</body>
</html>