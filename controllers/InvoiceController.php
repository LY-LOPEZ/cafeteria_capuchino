<?php
require_once 'models/OrderModel.php';
require_once 'components/auth.php';

class InvoiceController {
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        include 'components/connect.php';
        $user_id = requireUser($conn);

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
