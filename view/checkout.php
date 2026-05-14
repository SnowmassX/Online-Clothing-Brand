<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once('../model/db.php');
$con = getConnection();

$user_id = $_SESSION['user_id'];
$cart_query = "SELECT c.*, p.name, p.price FROM cart c JOIN products p ON c.product_id = p.id WHERE c.user_id = ?";
$stmt = mysqli_prepare($con, $cart_query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$total_amount = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="../asset/css/login.css">
    <style>
        .checkout-container { max-width: 800px; margin: 20px auto; padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        .payment-group { margin: 15px 0; }
        .payment-group label { margin-right: 15px; cursor: pointer; }
        textarea { width: 100%; padding: 10px; margin-top: 10px; border-radius: 4px; border: 1px solid #ccc; font-family: inherit; }
        .btn-submit { background-color: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-size: 16px; margin-top: 20px; }
        .btn-cancel { display: inline-block; margin-top: 15px; color: #dc3545; text-decoration: none; font-size: 14px; }
    </style>
</head>
<body>
    <header id="header">
        <div class="logo" id="logo">Online Clothing Brand</div>
        <nav id="navbar">
            <a href="home.php">Home</a>
            <a href="cart.php">Back to Cart</a>
            <a href="../controller/logout.php">Logout</a>
        </nav>
    </header>

    <main id="main">
        <div class="checkout-container">
            <h2 id="title">Checkout</h2>
            
            <section class="invoice-summary">
                <h3>Order Summary</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($item = mysqli_fetch_assoc($result)): 
                            $subtotal = $item['price'] * $item['quantity'];
                            $total_amount += $subtotal;
                        ?>
                        <tr>
                            <td><?php echo $item['name']; ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td><?php echo number_format($item['price'], 2); ?> TK</td>
                            <td><?php echo number_format($subtotal, 2); ?> TK</td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3">Total Amount</th>
                            <th><?php echo number_format($total_amount, 2); ?> TK</th>
                        </tr>
                    </tfoot>
                </table>
            </section>

            <form action="../controller/CheckoutController.php" method="POST" onsubmit="return validateCheckout()">
                
                <h3>Shipping Information</h3>
                <textarea name="address" id="address" placeholder="Enter your full delivery address..." required></textarea>
                
                <h3>Select Payment Method</h3>
                <div class="payment-group">
                    <input type="radio" name="payment_method" value="bkash" id="bkash"> <label for="bkash">bKash</label>
                    <input type="radio" name="payment_method" value="nagad" id="nagad"> <label for="nagad">Nagad</label>
                    <input type="radio" name="payment_method" value="card" id="card"> <label for="card">Credit Card</label>
                    <input type="radio" name="payment_method" value="cash" id="cash"> <label for="cash">Cash on Delivery</label>
                </div>

                <input type="hidden" name="total_amount" value="<?php echo $total_amount; ?>">
                
                <button type="submit" name="place_order" class="btn-submit">Confirm Order</button>
                <center><a href="cart.php" class="btn-cancel">Cancel and Back to Cart</a></center>
                
                <p id="error-msg" style="color: red; text-align: center; margin-top: 10px; height: 20px;"></p>
            </form>
        </div>
    </main>

    <footer id="footer">
        <p id="footerText">© 2026 Fashion Store. All Rights Reserved.</p>
    </footer>

    <script src="../asset/script/checkout.js"></script>
</body>
</html>