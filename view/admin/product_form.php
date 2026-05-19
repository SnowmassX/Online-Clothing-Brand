<html>
<head>
    <title>Product Form</title>
    <link rel="stylesheet" href="asset/css/admin.css">
    <script src="asset/script/admin.js"></script>
</head>
<body>

<?php

if (!isset($product)) {
    $product = null;
}
if (!isset($error)) {
    $error = "";
}
if (!isset($categories)) {
    $categories = [];
}
?>

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
        <h1 id="title">
            <?php
            if ($product) {
                echo "Edit Product";
            } else {
                echo "Add Product";
            }
            ?>
        </h1>

        <a class="btn" href="index.php?page=products">Back</a>

        <?php if ($error !== "") { ?>
            <p class="error"><?php echo e($error); ?></p>
        <?php } ?>

        <form method="post" enctype="multipart/form-data" onsubmit="return checkProductForm()">
            <input type="hidden" name="csrf_token" value="<?php echo createToken(); ?>">

            Name:
            <input type="text" name="name" id="name" value="<?php echo $product ? e($product['name']) : ''; ?>">

            Description:
            <textarea name="description" id="description"><?php echo $product ? e($product['description']) : ''; ?></textarea>

            Size Chart:
            <textarea name="size_chart" id="size_chart"><?php echo $product ? e(sizeText($product['size_chart'])) : ''; ?></textarea>

            Price:
            <input type="number" step="0.01" name="price" id="price" value="<?php echo $product ? e($product['price']) : ''; ?>">

            Gender:
            <select name="gender" id="gender" onchange="filterCategory()">
                <option value="">Select Gender</option>

                <option value="Men" <?php if ($product && $product['gender'] == "Men") { echo "selected"; } ?>>
                    Men
                </option>

                <option value="Women" <?php if ($product && $product['gender'] == "Women") { echo "selected"; } ?>>
                    Women
                </option>
            </select>

            Category:
            <select name="category_id" id="category_id">
                <option value="" data-gender="">Select Category</option>

                <?php foreach ($categories as $cat) { ?>
                    <option value="<?php echo e($cat['id']); ?>"
                            data-gender="<?php echo e($cat['parent_name']); ?>"
                            <?php if ($product && $product['category_id'] == $cat['id']) { echo "selected"; } ?>>
                        <?php echo e($cat['name']); ?>
                    </option>
                <?php } ?>
            </select>

            Stock:
            <input type="number" name="stock" id="stock" value="<?php echo $product ? e($product['stock']) : ''; ?>">

            Image:
            <input type="file" name="image" id="image">

            <?php if ($product && !empty($product['image_path'])) { ?>
                <p>Current Image:</p>
                <img src="asset/upload/products/<?php echo e(basename($product['image_path'])); ?>" width="100" alt="Current product image">
            <?php } ?>

            <br><br>
            <input type="submit" name="submit" value="Save Product">
        </form>
    </div>
</div>

<script>
filterCategory();
</script>

</body>
</html>