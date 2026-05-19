<html>
<head>
    <title>Purchase History</title>
    <link rel="stylesheet" href="asset/css/admin.css">
</head>
<body>

<header id="header">
    <div id="logo">StyleStore</div>
    <nav id="navbar">
        <a href="index.php?page=dashboard">Dashboard</a>
        <a href="index.php?page=products">Products</a>
        <a href="index.php?page=customers">Customers</a>
        <a href="index.php?page=orders">Orders</a>
    </nav>
</header>

<div id="main">
    <div class="container">
        <h1 id="title">All Purchase History</h1>

        <a class="btn" href="index.php?page=dashboard">Back</a>

        <table>
            <tr>
                <th>Customer</th>
                <th>Order ID</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Date</th>
            </tr>

            <?php foreach($history as $row){ ?>
            <tr>
                <td><?php echo e($row['customer_name']); ?></td>
                <td><?php echo e($row['order_id']); ?></td>
                <td><?php echo e($row['product_name']); ?></td>
                <td><?php echo e($row['quantity']); ?></td>
                <td><?php echo e($row['unit_price']); ?></td>
                <td><?php echo e($row['total_amount']); ?></td>
                <td><?php echo e($row['status']); ?></td>
                <td><?php echo e($row['order_date']); ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

</body>
</html>