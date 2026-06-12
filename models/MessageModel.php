<?php
require_once 'models/Database.php';

class MessageModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function exists($name, $email, $number, $message) {
        $stmt = $this->conn->prepare("SELECT id FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
        $stmt->execute([$name, $email, $number, $message]);
        return $stmt->rowCount() > 0;
    }

    public function create($userId, $name, $email, $number, $message) {
        $stmt = $this->conn->prepare("INSERT INTO `messages`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
        return $stmt->execute([$userId, $name, $email, $number, $message]);
    }
}
