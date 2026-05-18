<?php

require_once __DIR__ . '/../model/ProductDetailModel.php';

header('Content-Type: application/json');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo json_encode(array('success' => false, 'error' => 'Invalid product ID'));
    exit;
}

$id = (int) $_GET['id'];

if ($id <= 0) {
    echo json_encode(array('success' => false, 'error' => 'Invalid product ID'));
    exit;
}

$productDetailModel = new ProductDetailModel();
$product = $productDetailModel->getProductById($id);

if (!$product) {
    echo json_encode(array('success' => false, 'error' => 'Product not found'));
    exit;
}

$sizeChart = array();
if ($product['size_chart'] != null && $product['size_chart'] != '') {
    $sizeChart = json_decode($product['size_chart'], true);
    if ($sizeChart == null) {
        $sizeChart = array();
    }
}

$response = array(
    'success'       => true,
    'id'            => $product['id'],
    'name'          => htmlspecialchars($product['name']),
    'description'   => htmlspecialchars($product['description']),
    'price'         => $product['price'],
    'stock'         => $product['stock'],
    'gender'        => $product['gender'],
    'category_name' => htmlspecialchars($product['category_name']),
    'image_path'    => $product['image_path'],
    'size_chart'    => $sizeChart
);

echo json_encode($response);
?>
