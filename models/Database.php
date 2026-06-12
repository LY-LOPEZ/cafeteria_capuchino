<?php

class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        $db_name = 'mysql:host=localhost;dbname=food_db';
        $user_name = 'root';
        $user_password = '';
        try {
            $this->conn = new PDO($db_name, $user_name, $user_password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}
