<?php
    require_once('../model/productModel.php');
    $products = getAllProducts();
    // print_r($products);
    include('../view/products.php');
?>