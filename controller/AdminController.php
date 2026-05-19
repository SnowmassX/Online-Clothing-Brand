<?php
require_once __DIR__ . "/../model/AdminModel.php";
require_once __DIR__ . "/../model/helpers.php";

function adminGate() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header("Location: view/login.php");
        exit;
    }
}

function showDashboard() {
    adminGate();

    $counts = dashboardCounts();
    $orders = getOrders();

    require __DIR__ . "/../view/admin/dashboard.php";
}

function showProducts() {
    adminGate();

    $products = getProducts();

    require __DIR__ . "/../view/admin/products.php";
}

function showAddProduct() {
    adminGate();

    $product = null;
    $categories = getCategories();
    $error = "";

    if (isset($_POST['submit'])) {
        if (!checkToken($_POST['csrf_token'] ?? '')) {
            $error = "Invalid request!";
        } else {
            $data = validateProduct(true);

            if (isset($data['error'])) {
                $error = $data['error'];
            } else {
                addProduct($data);
                header("Location: index.php?page=products");
                exit;
            }
        }
    }

    require __DIR__ . "/../view/admin/product_form.php";
}

function showEditProduct() {
    adminGate();

    $id = (int)($_GET['id'] ?? 0);
    $product = getProductById($id);
    $categories = getCategories();
    $error = "";

    if (!$product) {
        die("Product not found!");
    }

    if (isset($_POST['submit'])) {
        if (!checkToken($_POST['csrf_token'] ?? '')) {
            $error = "Invalid request!";
        } else {
            $data = validateProduct(false);

            if (isset($data['error'])) {
                $error = $data['error'];
            } else {
                updateProduct($id, $data);
                header("Location: index.php?page=products");
                exit;
            }
        }
    }

    require __DIR__ . "/../view/admin/product_form.php";
}

function removeProduct() {
    adminGate();

    $id = (int)($_GET['id'] ?? 0);

    if (isset($_POST['delete'])) {
        if (checkToken($_POST['csrf_token'] ?? '')) {
            $deleted = deleteProduct($id);

            if ($deleted) {
                header("Location: index.php?page=products");
                exit;
            }

            echo "This product is already used in an order. Delete blocked.";
        } else {
            echo "Invalid request!";
        }
    }
}

function showCustomers() {
    adminGate();

    $customers = getCustomers();

    require __DIR__ . "/../view/admin/customers.php";
}

function removeCustomer() {
    adminGate();

    $id = (int)($_GET['id'] ?? 0);

    if (isset($_POST['delete'])) {
        if (checkToken($_POST['csrf_token'] ?? '')) {
            deleteCustomer($id);
            header("Location: index.php?page=customers");
            exit;
        }

        echo "Invalid request!";
    }
}

function showOrders() {
    adminGate();

    $orders = getOrders();

    require __DIR__ . "/../view/admin/orders.php";
}

function showPurchaseHistory() {
    adminGate();

    $history = getPurchaseHistory();

    require __DIR__ . "/../view/admin/purchase_history.php";
}

function validateProduct($image_required) {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $size_chart = trim($_POST['size_chart'] ?? '');
    $price = trim($_POST['price'] ?? '');
    $category_id = trim($_POST['category_id'] ?? '');
    $stock = trim($_POST['stock'] ?? '');
    $gender = trim($_POST['gender'] ?? '');

    if ($name === '' || $description === '' || $price === '' || $category_id === '' || $stock === '' || $gender === '') {
        return ['error' => 'Please fill all required fields!'];
    }

    if (!is_numeric($price) || $price <= 0) {
        return ['error' => 'Price must be greater than 0!'];
    }

    if (!is_numeric($stock) || $stock < 0) {
        return ['error' => 'Stock cannot be negative!'];
    }

    if ($gender !== "Men" && $gender !== "Women") {
        return ['error' => 'Invalid gender!'];
    }

    if (!is_numeric($category_id) || (int)$category_id <= 0) {
        return ['error' => 'Invalid category!'];
    }

    $image_path = "";

    if (!empty($_FILES['image']['name'])) {
        if (!is_uploaded_file($_FILES['image']['tmp_name'])) {
            return ['error' => 'Invalid image upload!'];
        }

        $file_type = mime_content_type($_FILES['image']['tmp_name']);

        if ($file_type !== "image/jpeg" && $file_type !== "image/png") {
            return ['error' => 'Only JPG and PNG images are allowed!'];
        }

        if ($_FILES['image']['size'] > 2 * 1024 * 1024) {
            return ['error' => 'Image must be less than 2MB!'];
        }

        $folder = __DIR__ . "/../asset/upload/products/";

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

        if ($ext !== 'jpg' && $ext !== 'jpeg' && $ext !== 'png') {
            return ['error' => 'Only JPG and PNG images are allowed!'];
        }

        $file_name = time() . "_" . rand(1000, 9999) . "." . $ext;
        $target_path = $folder . $file_name;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
            return ['error' => 'Image upload failed!'];
        }

        $image_path = $file_name;
    } else {
        if ($image_required) {
            return ['error' => 'Product image is required!'];
        }
    }

    return [
        'name' => $name,
        'description' => $description,
        'size_chart' => json_encode($size_chart),
        'price' => (float)$price,
        'category_id' => (int)$category_id,
        'stock' => (int)$stock,
        'gender' => $gender,
        'image_path' => $image_path
    ];
}
?>