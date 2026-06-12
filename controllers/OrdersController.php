<?php
require_once 'models/OrderModel.php';
require_once 'components/auth.php';

class OrdersController {
    public function index() {
        include 'components/connect.php';

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $user_id = requireUser($conn);

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
