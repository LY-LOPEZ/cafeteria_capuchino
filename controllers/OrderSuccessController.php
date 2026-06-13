<?php
require_once 'models/OrderModel.php';
require_once 'components/auth.php';

class OrderSuccessController {
    public function index() {
        include 'components/connect.php';

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $user_id = requireUser($conn);

        $orderId = filter_var($_GET['id'] ?? '', FILTER_SANITIZE_NUMBER_INT);
        $orderModel = new OrderModel();
        $fetch_order = $orderModel->getOrderByUser($orderId, $user_id);

        if (!$fetch_order) {
            $ordersUrl = defined('PUBLIC_BASE') ? PUBLIC_BASE . 'orders' : 'orders.php';
            header('location:' . $ordersUrl);
            exit;
        }

        $orderItems = $orderModel->getItemsByOrder($fetch_order['id']);

        $shop_whatsapp = '59171818545';
        $whatsapp_text = 'Hola Cafeteria Capuchino, se registro el pedido #' . str_pad($fetch_order['id'], 6, '0', STR_PAD_LEFT) . '. Total Bs.' . $fetch_order['total_price'] . '. Ref. QR: ' . $fetch_order['payment_reference'] . '. Por favor revisar el detalle en el sistema.';
        $whatsapp_link = 'https://wa.me/' . $shop_whatsapp . '?text=' . urlencode($whatsapp_text);

        require_once 'views/order_success.php';
    }
}
