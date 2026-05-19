<?php
$page = $_GET['page'] ?? '';

if ($page !== '') {
    require_once __DIR__ . "/controller/AdminController.php";

    switch ($page) {
        case "dashboard":
            showDashboard();
            break;

        case "products":
            showProducts();
            break;

        case "product_add":
            showAddProduct();
            break;

        case "product_edit":
            showEditProduct();
            break;

        case "product_delete":
            removeProduct();
            break;

        case "customers":
            showCustomers();
            break;

        case "customer_delete":
            removeCustomer();
            break;

        case "orders":
            showOrders();
            break;

        case "purchase_history":
            showPurchaseHistory();
            break;

        default:
            http_response_code(404);
            echo "Page not found!";
            break;
    }
} else {
    header("Location: view/home.php");
    exit;
}
?>