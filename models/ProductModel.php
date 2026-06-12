<?php
require_once 'models/Database.php';

class ProductModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getLatestProducts($limit = 8) {
        $stmt = $this->conn->prepare("SELECT * FROM `products` LIMIT :limit");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPopularProducts($limit = 4) {
        $stmt = $this->conn->prepare("SELECT * FROM `products` ORDER BY COALESCE(popularity, 0) DESC, id DESC LIMIT :limit");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getProducts($limit = 12) {
        $stmt = $this->conn->prepare("SELECT * FROM `products` LIMIT :limit");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllProducts() {
        $stmt = $this->conn->prepare("SELECT * FROM `products`");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($productId) {
        $stmt = $this->conn->prepare("SELECT * FROM `products` WHERE id = ?");
        $stmt->execute([$productId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getProductsByCategory($category) {
        $stmt = $this->conn->prepare("SELECT * FROM `products` WHERE category = ?");
        $stmt->execute([$category]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchProducts($term) {
        $searchValue = "%{$term}%";
        $stmt = $this->conn->prepare("SELECT * FROM `products` WHERE name LIKE ? OR category LIKE ?");
        $stmt->execute([$searchValue, $searchValue]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
