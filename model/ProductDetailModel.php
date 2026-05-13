<?php

require_once __DIR__ . '/db.php';

class ProductDetailModel {

    private $con;

    public function __construct() {
        $this->con = getConnection();
    }

    public function getProductById($id) {
        $stmt = mysqli_prepare($this->con,
            "SELECT p.*, c.name AS category_name, parent.name AS gender_label
             FROM products p
             JOIN categories c ON p.category_id = c.id
             LEFT JOIN categories parent ON c.parent_id = parent.id
             WHERE p.id = ?
             LIMIT 1"
        );
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result  = mysqli_stmt_get_result($stmt);
        $product = mysqli_fetch_assoc($result);
        return $product;
    }
}
?>
