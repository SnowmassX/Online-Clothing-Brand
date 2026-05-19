<?php
require_once __DIR__ . "/db.php";

function dashboardCounts() {
    $con = getConnection();

    $stmt1 = mysqli_prepare($con, "SELECT COUNT(*) AS total FROM products");
    mysqli_stmt_execute($stmt1);
    $result1 = mysqli_stmt_get_result($stmt1);
    $products = mysqli_fetch_assoc($result1)['total'];

    $role = "customer";
    $stmt2 = mysqli_prepare($con, "SELECT COUNT(*) AS total FROM users WHERE role=?");
    mysqli_stmt_bind_param($stmt2, "s", $role);
    mysqli_stmt_execute($stmt2);
    $result2 = mysqli_stmt_get_result($stmt2);
    $customers = mysqli_fetch_assoc($result2)['total'];

    $stmt3 = mysqli_prepare($con, "SELECT COUNT(*) AS total FROM orders");
    mysqli_stmt_execute($stmt3);
    $result3 = mysqli_stmt_get_result($stmt3);
    $orders = mysqli_fetch_assoc($result3)['total'];

    $status = "pending";
    $stmt4 = mysqli_prepare($con, "SELECT COUNT(*) AS total FROM orders WHERE status=?");
    mysqli_stmt_bind_param($stmt4, "s", $status);
    mysqli_stmt_execute($stmt4);
    $result4 = mysqli_stmt_get_result($stmt4);
    $pending = mysqli_fetch_assoc($result4)['total'];

    return [
        "products" => $products,
        "customers" => $customers,
        "orders" => $orders,
        "pending" => $pending
    ];
}

function getProducts() {
    $con = getConnection();

    $sql = "SELECT products.*, categories.name AS category_name
            FROM products
            LEFT JOIN categories ON products.category_id = categories.id
            ORDER BY products.id DESC";

    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $products = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }

    return $products;
}

function getProductById($id) {
    $con = getConnection();

    $stmt = mysqli_prepare($con, "SELECT * FROM products WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}

function getCategories() {
    $con = getConnection();

    $sql = "SELECT c.*, p.name AS parent_name
            FROM categories c
            LEFT JOIN categories p ON c.parent_id = p.id
            ORDER BY c.name ASC";

    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $categories = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row;
    }

    return $categories;
}

function addProduct($product) {
    $con = getConnection();

    $sql = "INSERT INTO products
            (name, description, size_chart, price, category_id, image_path, stock, gender, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";

    $stmt = mysqli_prepare($con, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sssdisis",
        $product['name'],
        $product['description'],
        $product['size_chart'],
        $product['price'],
        $product['category_id'],
        $product['image_path'],
        $product['stock'],
        $product['gender']
    );

    return mysqli_stmt_execute($stmt);
}

function updateProduct($id, $product) {
    $con = getConnection();

    if ($product['image_path'] !== "") {
        $oldProduct = getProductById($id);

        if ($oldProduct && !empty($oldProduct['image_path'])) {
            $oldImage = __DIR__ . "/../asset/upload/products/" . basename($oldProduct['image_path']);

            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
        }

        $sql = "UPDATE products
                SET name=?, description=?, size_chart=?, price=?, category_id=?, image_path=?, stock=?, gender=?
                WHERE id=?";

        $stmt = mysqli_prepare($con, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            "sssdisisi",
            $product['name'],
            $product['description'],
            $product['size_chart'],
            $product['price'],
            $product['category_id'],
            $product['image_path'],
            $product['stock'],
            $product['gender'],
            $id
        );
    } else {
        $sql = "UPDATE products
                SET name=?, description=?, size_chart=?, price=?, category_id=?, stock=?, gender=?
                WHERE id=?";

        $stmt = mysqli_prepare($con, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            "sssdiisi",
            $product['name'],
            $product['description'],
            $product['size_chart'],
            $product['price'],
            $product['category_id'],
            $product['stock'],
            $product['gender'],
            $id
        );
    }

    return mysqli_stmt_execute($stmt);
}

function deleteProduct($id) {
    $con = getConnection();

    $stmt1 = mysqli_prepare($con, "SELECT COUNT(*) AS total FROM order_items WHERE product_id=?");
    mysqli_stmt_bind_param($stmt1, "i", $id);
    mysqli_stmt_execute($stmt1);
    $result1 = mysqli_stmt_get_result($stmt1);
    $row = mysqli_fetch_assoc($result1);

    if ($row['total'] > 0) {
        return false;
    }

    $product = getProductById($id);

    if ($product && !empty($product['image_path'])) {
        $imageFile = __DIR__ . "/../asset/upload/products/" . basename($product['image_path']);

        if (file_exists($imageFile)) {
            unlink($imageFile);
        }
    }

    $stmt2 = mysqli_prepare($con, "DELETE FROM products WHERE id=?");
    mysqli_stmt_bind_param($stmt2, "i", $id);

    return mysqli_stmt_execute($stmt2);
}

function getCustomers() {
    $con = getConnection();

    $role = "customer";
    $stmt = mysqli_prepare($con, "SELECT * FROM users WHERE role=? ORDER BY id DESC");
    mysqli_stmt_bind_param($stmt, "s", $role);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $customers = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $customers[] = $row;
    }

    return $customers;
}

function deleteCustomer($id) {
    $con = getConnection();

    mysqli_begin_transaction($con);

    try {
        $stmt = mysqli_prepare($con, "SELECT id FROM orders WHERE user_id=?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        while ($order = mysqli_fetch_assoc($result)) {
            $order_id = $order['id'];

            $stmt1 = mysqli_prepare($con, "DELETE FROM payments WHERE order_id=?");
            mysqli_stmt_bind_param($stmt1, "i", $order_id);
            mysqli_stmt_execute($stmt1);

            $stmt2 = mysqli_prepare($con, "DELETE FROM order_items WHERE order_id=?");
            mysqli_stmt_bind_param($stmt2, "i", $order_id);
            mysqli_stmt_execute($stmt2);
        }

        $stmt3 = mysqli_prepare($con, "DELETE FROM orders WHERE user_id=?");
        mysqli_stmt_bind_param($stmt3, "i", $id);
        mysqli_stmt_execute($stmt3);

        $stmt4 = mysqli_prepare($con, "DELETE FROM cart WHERE user_id=?");
        mysqli_stmt_bind_param($stmt4, "i", $id);
        mysqli_stmt_execute($stmt4);

        $role = "customer";
        $stmt5 = mysqli_prepare($con, "DELETE FROM users WHERE id=? AND role=?");
        mysqli_stmt_bind_param($stmt5, "is", $id, $role);
        mysqli_stmt_execute($stmt5);

        mysqli_commit($con);
        return true;
    } catch (Exception $e) {
        mysqli_rollback($con);
        return false;
    }
}

function getOrders() {
    $con = getConnection();

    $sql = "SELECT orders.*, users.name AS customer_name
            FROM orders
            JOIN users ON orders.user_id = users.id
            ORDER BY orders.order_date DESC";

    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $orders = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $orders[] = $row;
    }

    return $orders;
}

function updateOrderStatus($order_id, $status) {
    $con = getConnection();

    $stmt = mysqli_prepare($con, "UPDATE orders SET status=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "si", $status, $order_id);

    return mysqli_stmt_execute($stmt);
}

function getPurchaseHistory() {
    $con = getConnection();

    $sql = "SELECT users.name AS customer_name,
                   orders.id AS order_id,
                   orders.total_amount,
                   orders.status,
                   orders.order_date,
                   products.name AS product_name,
                   order_items.quantity,
                   order_items.unit_price
            FROM orders
            JOIN users ON orders.user_id = users.id
            JOIN order_items ON orders.id = order_items.order_id
            JOIN products ON order_items.product_id = products.id
            ORDER BY orders.order_date DESC";

    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $history = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $history[] = $row;
    }

    return $history;
}
?>