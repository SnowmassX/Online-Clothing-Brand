<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once('../model/db.php');
$user_id = $_SESSION['user_id'];
$con = getConnection();

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
</body>
</html>