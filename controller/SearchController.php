<?php

require_once __DIR__ . '/../model/SearchModel.php';

header('Content-Type: application/json');

$searchModel = new SearchModel();

$q        = isset($_GET['q'])        ? trim($_GET['q'])        : "";
$gender   = isset($_GET['gender'])   ? trim($_GET['gender'])   : "";
$category = isset($_GET['category']) ? trim($_GET['category']) : "";

if ($category != "" && !is_numeric($category)) {
    echo json_encode(array('success' => false, 'error' => 'Invalid category'));
    exit;
}

if ($gender != "" && $gender != "Men" && $gender != "Women") {
    echo json_encode(array('success' => false, 'error' => 'Invalid gender'));
    exit;
}

$products = $searchModel->search($q, $category, $gender);

$cleanProducts = array();

foreach ($products as $p) {
    $cleanProducts[] = array(
        'id'            => $p['id'],
        'name'          => htmlspecialchars($p['name']),
        'price'         => $p['price'],
        'image_path'    => $p['image_path'],
        'stock'         => $p['stock'],
        'gender'        => $p['gender'],
        'category_name' => $p['category_name']
    );
}

echo json_encode(array('success' => true, 'products' => $cleanProducts));
?>
