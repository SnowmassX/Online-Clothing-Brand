<html>
<head>
    <title>Customers</title>
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
        <h1 id="title">Customer Management</h1>

        <a class="btn" href="index.php?page=dashboard">Back</a>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>

            <?php $customers = $customers ?? []; foreach($customers as $customer){ ?>
            <tr>
                <td><?php echo e($customer['id']); ?></td>
                <td><?php echo e($customer['name']); ?></td>
                <td><?php echo e($customer['email']); ?></td>
                <td><?php echo e($customer['phone']); ?></td>
                <td>
                    <form method="post" action="index.php?page=customer_delete&id=<?php echo e($customer['id']); ?>">
                        <input type="hidden" name="csrf_token" value="<?php echo createToken(); ?>">
                        <input type="submit" name="delete" value="Delete" onclick="return confirm('Delete this customer?')">
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

</body>
</html>