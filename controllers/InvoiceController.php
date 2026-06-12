<?php
require_once 'models/OrderModel.php';

class InvoiceController {
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
        } else {
            $loginUrl = defined('PUBLIC_BASE') ? PUBLIC_BASE . 'login' : 'login.php';
            header('location:' . $loginUrl);
            exit;
        }

        $orderId = filter_var($_GET['id'] ?? '', FILTER_SANITIZE_NUMBER_INT);
        $orderModel = new OrderModel();
        $fetch_order = $orderModel->getOrderByUser($orderId, $user_id);

        if (!$fetch_order) {
            http_response_code(404);
            die('Factura no encontrada');
        }

        if ($fetch_order['payment_status'] !== 'completed' || $fetch_order['order_status'] !== 'entregado') {
            http_response_code(403);
            die('La factura se genera cuando el pedido fue entregado.');
        }

        $orderItems = $orderModel->getItemsByOrder($fetch_order['id']);

        require_once 'views/invoice.php';
    }
}
