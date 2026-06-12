<?php
require_once 'models/Database.php';

class CartModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getItemsByUser($userId) {
        $stmt = $this->conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteItem($cartId, $userId) {
        $stmt = $this->conn->prepare("DELETE FROM `cart` WHERE id = ? AND user_id = ?");
        return $stmt->execute([$cartId, $userId]);
    }

    public function deleteAllByUser($userId) {
        $stmt = $this->conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
        return $stmt->execute([$userId]);
    }

    public function updateQuantity($cartId, $userId, $quantity) {
        $stmt = $this->conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ? AND user_id = ?");
        return $stmt->execute([$quantity, $cartId, $userId]);
    }

    public function calculateTotal($items) {
        $total = 0;
        foreach ($items as $item) {
            $total += ((int)$item['price'] * (int)$item['quantity']);
        }
        return $total;
    }

    public function summarizeItems($items) {
        $summary = [];
        foreach ($items as $item) {
            $summary[] = $item['name'] . ' (' . $item['price'] . ' x ' . $item['quantity'] . ')';
        }
        return implode(' - ', $summary);
    }
}
