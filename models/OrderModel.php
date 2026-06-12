<?php
require_once 'models/Database.php';

class OrderModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function createOrder($orderData, $items) {
        $this->conn->beginTransaction();

        try {
            $insertOrder = $this->conn->prepare(
                "INSERT INTO `orders`(user_id, name, number, email, method, payment_reference, payment_proof, address, city, zone, street, home_number, delivery_reference, billing_name, nit_ci, total_products, total_price, payment_status, order_status) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"
            );

            $insertOrder->execute([
                $orderData['user_id'],
                $orderData['name'],
                $orderData['number'],
                $orderData['email'],
                $orderData['method'],
                $orderData['payment_reference'],
                $orderData['payment_proof'],
                $orderData['address'],
                $orderData['city'],
                $orderData['zone'],
                $orderData['street'],
                $orderData['home_number'],
                $orderData['delivery_reference'],
                $orderData['billing_name'],
                $orderData['nit_ci'],
                $orderData['total_products'],
                $orderData['total_price'],
                'pending',
                'pendiente de verificacion',
            ]);

            $orderId = $this->conn->lastInsertId();
            $insertItem = $this->conn->prepare("INSERT INTO `order_items`(order_id, product_id, product_name, price, quantity, subtotal, image) VALUES(?,?,?,?,?,?,?)");

            foreach ($items as $item) {
                $subtotal = (int)$item['price'] * (int)$item['quantity'];
                $insertItem->execute([
                    $orderId,
                    $item['pid'],
                    $item['name'],
                    $item['price'],
                    $item['quantity'],
                    $subtotal,
                    $item['image'],
                ]);
            }

            $this->conn->commit();
            return $orderId;
        } catch (Exception $exception) {
            $this->conn->rollBack();
            throw $exception;
        }
    }

    public function getOrdersByUser($userId) {
        $stmt = $this->conn->prepare("SELECT * FROM `orders` WHERE user_id = ? ORDER BY id DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderByUser($orderId, $userId) {
        $stmt = $this->conn->prepare("SELECT * FROM `orders` WHERE id = ? AND user_id = ?");
        $stmt->execute([$orderId, $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getItemsByOrder($orderId) {
        $stmt = $this->conn->prepare("SELECT * FROM `order_items` WHERE order_id = ?");
        $stmt->execute([$orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteCompletedByUser($orderId, $userId) {
        $checkOrder = $this->conn->prepare("SELECT id FROM `orders` WHERE id = ? AND user_id = ? AND payment_status = ? AND order_status = ?");
        $checkOrder->execute([$orderId, $userId, 'completed', 'entregado']);

        if ($checkOrder->rowCount() == 0) {
            return false;
        }

        $this->conn->beginTransaction();

        try {
            $deleteItems = $this->conn->prepare("DELETE FROM `order_items` WHERE order_id = ?");
            $deleteItems->execute([$orderId]);

            $deleteOrder = $this->conn->prepare("DELETE FROM `orders` WHERE id = ? AND user_id = ? AND payment_status = ? AND order_status = ?");
            $deleteOrder->execute([$orderId, $userId, 'completed', 'entregado']);

            $this->conn->commit();
            return true;
        } catch (Exception $exception) {
            $this->conn->rollBack();
            throw $exception;
        }
    }
}
