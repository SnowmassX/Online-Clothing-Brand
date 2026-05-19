<html>
<head>
    <title>Orders</title>
    <link rel="stylesheet" href="asset/css/admin.css">
    <script src="asset/script/admin.js"></script>
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
        <h1 id="title">Order List</h1>

        <a class="btn" href="index.php?page=dashboard">Back</a>

        <input type="hidden" id="csrf_token" value="<?php echo createToken(); ?>">

        <table>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Order Date</th>
                <th>Action</th>
            </tr>

            <?php if (!empty($orders) && is_array($orders)) {
                foreach ($orders as $order) {
                    $statusClass = "status-pending";

                    if ($order['status'] == "confirmed") {
                        $statusClass = "status-confirmed";
                    }

                    if ($order['status'] == "rejected") {
                        $statusClass = "status-rejected";
                    }
            ?>
            <tr>
                <td><?php echo e($order['id']); ?></td>
                <td><?php echo e($order['customer_name']); ?></td>
                <td><?php echo e($order['total_amount']); ?></td>
                <td id="status-<?php echo e($order['id']); ?>">
                    <span class="<?php echo $statusClass; ?>"><?php echo e($order['status']); ?></span>
                </td>
                <td><?php echo e($order['order_date']); ?></td>
                <td>
                    <input type="button" value="Confirm" onclick="updateOrder(<?php echo e($order['id']); ?>, 'confirmed')">
                    <input type="button" value="Reject" onclick="updateOrder(<?php echo e($order['id']); ?>, 'rejected')">
                </td>
            </tr>
            <?php }
            } else { ?>
            <tr>
                <td colspan="6">No orders available.</td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

</body>
</html>