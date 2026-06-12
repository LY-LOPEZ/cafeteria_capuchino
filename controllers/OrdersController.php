<?php
require_once 'models/OrderModel.php';

class OrdersController {
    public function index() {
        include 'components/connect.php';

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
        } else {
            $homeUrl = defined('PUBLIC_BASE') ? PUBLIC_BASE . 'home' : 'home.php';
            header('location:' . $homeUrl);
            exit;
        }

        $orderModel = new OrderModel();

        if (isset($_POST['delete_order'])) {
            $orderId = filter_var($_POST['order_id'], FILTER_SANITIZE_NUMBER_INT);
            if ($orderModel->deleteCompletedByUser($orderId, $user_id)) {
                $message[] = 'pedido eliminado correctamente';
            } else {
                $message[] = 'solo puedes eliminar pedidos entregados';
            }
        }

        $orders = $orderModel->getOrdersByUser($user_id);
        $tracking_steps = ['pendiente', 'preparando', 'listo', 'en camino', 'entregado'];

        require_once 'views/orders.php';
    }
}
