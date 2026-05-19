<?php
    require_once('../model/productModel.php');
    $products = getAllProducts();
    
    include('../view/products.php');
?>