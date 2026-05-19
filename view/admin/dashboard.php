<?php

if (!isset($counts) || !is_array($counts)) {

    $counts = [

        'products' => 0,

        'customers' => 0,

        'orders' => 0,

        'pending' => 0,

    ];

}
 
if (!isset($orders) || !is_array($orders)) {

    $orders = [];

}

?>
<html>
<head>
<title>Admin Dashboard</title>
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
<a href="index.php?page=purchase_history">Purchase History</a>
<a href="view/home.php">Main Website</a>
<a href="controller/logout.php">Logout</a>
</nav>
</header>
 
<div id="main">
<div class="container">
<h1 id="title">Admin Dashboard</h1>
 
        <div class="cardBox">
<div class="card">
<h3>Total Products</h3>
<p><?php echo e($counts['products']); ?></p>
</div>
 
            <div class="card">
<h3>Total Customers</h3>
<p><?php echo e($counts['customers']); ?></p>
</div>
 
            <div class="card">
<h3>Total Orders</h3>
<p><?php echo e($counts['orders']); ?></p>
</div>
 
            <div class="card">
<h3>Pending Orders</h3>
<p><?php echo e($counts['pending']); ?></p>
</div>
</div>
 
        <div class="menu">
<a href="index.php?page=products">Manage Products</a>
<a href="index.php?page=customers">Manage Customers</a>
<a href="index.php?page=orders">Order List</a>
<a href="index.php?page=purchase_history">Purchase History</a>
</div>
 
        <h2>Recent Orders</h2>
 
        <table>
<tr>
<th>Order ID</th>
<th>Customer</th>
<th>Total</th>
<th>Status</th>
<th>Date</th>
</tr>
 
            <?php

            $count = 0;
 
            foreach ($orders as $order) {

                if ($count == 5) {

                    break;

                }
 
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
<td>
<span class="<?php echo $statusClass; ?>">
<?php echo e($order['status']); ?>
</span>
</td>
<td><?php echo e($order['order_date']); ?></td>
</tr>
<?php

                $count++;

            }

            ?>
</table>
</div>
</div>
 
<footer id="footer">
<p id="footerText">© 2026 StyleStore. All Rights Reserved.</p>
</footer>
 
</body>
</html>
 