<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$total_amount = $_GET['amount'] ?? 0;
$order_id = $_GET['order_id'] ?? null;
?>

<html>
<head>
    <title>Payment Page</title>
    <link rel="stylesheet" href="../asset/css/payment.css">
</head>
<body>
    <div class="payment-container">
        <h2>Complete Your Payment</h2>
        
        <div class="amount-box">
            Total Payable Amount: <?php echo number_format($total_amount, 2); ?> TK
        </div>

        <form action="../controller/PaymentController.php" method="POST">
            <input type="hidden" name="amount" value="<?php echo $total_amount; ?>">
            <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
            
            <h3>Choose Payment Method:</h3>
            <input type="radio" name="payment_method" value="bKash" required> bKash 
            <input type="radio" name="payment_method" value="Nagad"> Nagad 
            <input type="radio" name="payment_method" value="Card"> Credit/Debit Card 
            <br><br>

            <div id="payment-details">
                <div class="input-group">
                    <label>Enter Account/Card Number:</label>
                    <input type="text" name="account_number" required>
                </div>
                
                <div class="input-group">
                    <label>Enter PIN/CVV:</label>
                    <input type="password" name="pin" required>
                </div>
            </div>

            <button type="submit">Pay Now</button>
        </form>

        <br>
        <div style="text-align: center;">
            <a href="checkout.php" style="color: #6c757d; text-decoration: none;">Cancel and Go Back</a>
        </div>
    </div>

    <script src="../asset/script/payment.js"></script>
</body>
</html>