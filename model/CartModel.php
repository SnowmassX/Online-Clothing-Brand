<?php

require_once __DIR__ . '/db.php';

class CartModel {

    private $con;

    public function __construct() {
        $this->con = getConnection();
    }

    public function addToCart($user_id, $product_id, $quantity) {
        $existing = $this->getCartItem($user_id, $product_id);

        if ($existing) {
            $new_quantity = $existing['quantity'] + $quantity;
            $stmt = mysqli_prepare($this->con,
                "UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?"
            );
            mysqli_stmt_bind_param($stmt, "iii", $new_quantity, $user_id, $product_id);
            mysqli_stmt_execute($stmt);
        } else {
            $stmt = mysqli_prepare($this->con,
                "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)"
            );
            mysqli_stmt_bind_param($stmt, "iii", $user_id, $product_id, $quantity);
            mysqli_stmt_execute($stmt);
        }
    }

    public function getCartItem($user_id, $product_id) {
        $stmt = mysqli_prepare($this->con,
            "SELECT * FROM cart WHERE user_id = ? AND product_id = ? LIMIT 1"
        );
        mysqli_stmt_bind_param($stmt, "ii", $user_id, $product_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $item   = mysqli_fetch_assoc($result);
        return $item;
    }

    public function getCartByUser($user_id) {
        $stmt = mysqli_prepare($this->con,
            "SELECT c.id, c.quantity, p.id AS product_id, p.name, p.price, p.image_path, p.stock
             FROM cart c
             JOIN products p ON c.product_id = p.id
             WHERE c.user_id = ?
             ORDER BY c.added_at DESC"
        );
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $items  = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $items;
    }

    public function updateQuantity($user_id, $product_id, $quantity) {
        $stmt = mysqli_prepare($this->con,
            "UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?"
        );
        mysqli_stmt_bind_param($stmt, "iii", $quantity, $user_id, $product_id);
        mysqli_stmt_execute($stmt);
    }

    public function removeItem($user_id, $product_id) {
        $stmt = mysqli_prepare($this->con,
            "DELETE FROM cart WHERE user_id = ? AND product_id = ?"
        );
        mysqli_stmt_bind_param($stmt, "ii", $user_id, $product_id);
        mysqli_stmt_execute($stmt);
    }

    public function getCartCount($user_id) {
        $stmt = mysqli_prepare($this->con,
            "SELECT SUM(quantity) AS total FROM cart WHERE user_id = ?"
        );
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row    = mysqli_fetch_assoc($result);
        if ($row['total'] == null) {
            return 0;
        }
        return (int) $row['total'];
    }

    public function getProductById($product_id) {
        $stmt = mysqli_prepare($this->con,
            "SELECT * FROM products WHERE id = ? LIMIT 1"
        );
        mysqli_stmt_bind_param($stmt, "i", $product_id);
        mysqli_stmt_execute($stmt);
        $result  = mysqli_stmt_get_result($stmt);
        $product = mysqli_fetch_assoc($result);
        return $product;
    }
}
?>
