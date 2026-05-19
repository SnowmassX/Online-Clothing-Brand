<html>
<head>
    <title>Products</title>
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
        <a href="view/home.php">Main Website</a>
    </nav>
</header>

<div id="main">
    <div class="container">
        <h1 id="title">Product Management</h1>

        <div class="action-links">
            <a href="index.php?page=dashboard">Back</a>
            <a href="index.php?page=product_add">Add Product</a>
        </div>

        <table>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Gender</th>
                <th>Category</th>
                <th>Stock</th>
                <th>Action</th>
            </tr>

            <?php foreach ($products as $product) { ?>
            <tr>
                <td><?php echo e($product['id']); ?></td>

                <td>
                    <?php if (!empty($product['image_path'])) { ?>
                        <img src="asset/upload/products/<?php echo e(basename($product['image_path'])); ?>" width="60" alt="Product image">
                    <?php } else { ?>
                        No image
                    <?php } ?>
                </td>

                <td><?php echo e($product['name']); ?></td>
                <td><?php echo e($product['price']); ?></td>
                <td><?php echo e($product['gender']); ?></td>
                <td><?php echo e($product['category_name']); ?></td>
                <td><?php echo e($product['stock']); ?></td>

                <td>
                    <a class="btn" href="index.php?page=product_edit&id=<?php echo e($product['id']); ?>">Edit</a>

                    <form method="post" action="index.php?page=product_delete&id=<?php echo e($product['id']); ?>" style="display:inline;">
                        <input type="hidden" name="csrf_token" value="<?php echo createToken(); ?>">
                        <input type="submit" name="delete" value="Delete" onclick="return confirm('Delete this product?')">
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

</body>
</html>