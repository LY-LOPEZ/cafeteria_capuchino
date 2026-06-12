<?php
require_once 'models/Database.php';

class UserModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getById($userId) {
        $stmt = $this->conn->prepare("SELECT * FROM `users` WHERE id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByEmailAndPassword($email, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
        $stmt->execute([$email, $password]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function existsByEmailOrNumber($email, $number) {
        $stmt = $this->conn->prepare("SELECT id FROM `users` WHERE email = ? OR number = ?");
        $stmt->execute([$email, $number]);
        return $stmt->rowCount() > 0;
    }

    public function create($name, $email, $number, $password) {
        $stmt = $this->conn->prepare("INSERT INTO `users`(name, email, number, password) VALUES(?,?,?,?)");
        $stmt->execute([$name, $email, $number, $password]);
        return $this->conn->lastInsertId();
    }

    public function emailExistsForAnotherUser($email, $userId) {
        $stmt = $this->conn->prepare("SELECT id FROM `users` WHERE email = ? AND id != ?");
        $stmt->execute([$email, $userId]);
        return $stmt->rowCount() > 0;
    }

    public function numberExistsForAnotherUser($number, $userId) {
        $stmt = $this->conn->prepare("SELECT id FROM `users` WHERE number = ? AND id != ?");
        $stmt->execute([$number, $userId]);
        return $stmt->rowCount() > 0;
    }

    public function updateProfileField($userId, $field, $value) {
        $allowedFields = ['name', 'email', 'number', 'password'];
        if (!in_array($field, $allowedFields)) {
            return false;
        }

        $stmt = $this->conn->prepare("UPDATE `users` SET `$field` = ? WHERE id = ?");
        return $stmt->execute([$value, $userId]);
    }

    public function updateAddressData($userId, $data) {
        $stmt = $this->conn->prepare("UPDATE `users` SET address = ?, city = ?, zone = ?, street = ?, home_number = ?, delivery_reference = ?, billing_name = ?, nit_ci = ? WHERE id = ?");
        return $stmt->execute([
            $data['address'],
            $data['city'],
            $data['zone'],
            $data['street'],
            $data['home_number'],
            $data['delivery_reference'],
            $data['billing_name'],
            $data['nit_ci'],
            $userId,
        ]);
    }
}
