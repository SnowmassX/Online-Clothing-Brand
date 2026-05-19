<?php

require_once __DIR__ . '/db.php';

class SearchModel {

    private mysqli $con;

    public function __construct() {
        $this->con = getConnection();
    }

    public function search(string $q, string $category, string $gender) {
        $sql = "SELECT p.id, p.name, p.price, p.image_path, p.stock, p.gender, c.name AS category_name
                FROM products p
                JOIN categories c ON p.category_id = c.id
                WHERE 1=1";

        if ($q != "") {
            $sql .= " AND p.name LIKE ?";   
        }

        if ($category != "") {
            $sql .= " AND p.category_id = ?";
        }

        if ($gender == "Men" || $gender == "Women") {
            $sql .= " AND p.gender = ?";
        }

        $sql .= " ORDER BY p.created_at DESC";

        $stmt = mysqli_prepare($this->con, $sql);

        $types  = "";
        $values = array();

        if ($q != "") {
            $types   .= "s";
            $values[] = "%" . $q . "%";
        }

        if ($category != "") {
            $types   .= "i";
            $values[] = $category;
        }

        if ($gender == "Men" || $gender == "Women") {
            $types   .= "s";
            $values[] = $gender;
        }

        if (count($values) > 0) {
            $bind = array($stmt, $types);
            foreach ($values as $key => $val) {
                $bind[] = &$values[$key];
            }
            call_user_func_array('mysqli_stmt_bind_param', $bind);
        }

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rows   = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $rows;
    }

    public function getProductById(int $id) {
        $stmt = mysqli_prepare($this->con,
            "SELECT p.*, c.name AS category_name
             FROM products p
             JOIN categories c ON p.category_id = c.id
             WHERE p.id = ?
             LIMIT 1"
        );
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result  = mysqli_stmt_get_result($stmt);
        $product = mysqli_fetch_assoc($result);
        return $product;
    }

    public function getAllCategories() {
        $stmt = mysqli_prepare($this->con,
            "SELECT id, name, parent_id FROM categories ORDER BY parent_id ASC, name ASC"
        );
        mysqli_stmt_execute($stmt);
        $result     = mysqli_stmt_get_result($stmt);
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $categories;
    }
}
?>
