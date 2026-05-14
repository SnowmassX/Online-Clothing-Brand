<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$total_amount = $_GET['amount'] ?? 0;
?>

<html>
<head>
    <title>Payment Page</title>
</head>
<body>
    <h2>Complete Your Payment</h2>
    <p>Total Payable Amount: <strong><?php echo $total_amount; ?> TK</strong></p>

    <form action="../controller/PaymentController.php" method="POST">
        <input type="hidden" name="total_amount" value="<?php echo $total_amount; ?>">
        
        <h3>Choose Payment Method:</h3>
        <input type="radio" name="method" value="bKash" required> bKash <br>
        <input type="radio" name="method" value="Nagad"> Nagad <br>
        <input type="radio" name="method" value="Card"> Credit/Debit Card <br><br>

        <div id="payment-details">
            <label>Enter Account/Card Number:</label><br>
            <input type="text" name="account_no" required><br><br>
            <label>Enter PIN/CVV:</label><br>
            <input type="password" name="pin" required>
        </div>

        <br>
        <button type="submit">Pay Now</button>
    </form>

    <br>
    <a href="checkout.php">Cancel and Go Back</a>
</body>
</html>