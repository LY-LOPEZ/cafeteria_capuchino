<?php
require_once 'models/CartModel.php';
require_once 'components/auth.php';

class CartController {
    public function index() {
        include 'components/connect.php';

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $user_id = requireUser($conn);

        $cartModel = new CartModel();

        if (isset($_POST['delete'])) {
            $cart_id = filter_var($_POST['cart_id'], FILTER_SANITIZE_NUMBER_INT);
            $cartModel->deleteItem($cart_id, $user_id);
            $message[] = 'articulo del carrito eliminado';
        }

        if (isset($_POST['delete_all'])) {
            $cartModel->deleteAllByUser($user_id);
            $message[] = 'todo eliminado del carrito';
        }

        if (isset($_POST['update_qty'])) {
            $cart_id = filter_var($_POST['cart_id'], FILTER_SANITIZE_NUMBER_INT);
            $qty = filter_var($_POST['qty'], FILTER_SANITIZE_NUMBER_INT);
            $qty = max(1, min(99, (int)$qty));
            $cartModel->updateQuantity($cart_id, $user_id, $qty);
            $message[] = 'cantidad del carrito actualizada';
        }

        $cartItems = $cartModel->getItemsByUser($user_id);
        $grand_total = $cartModel->calculateTotal($cartItems);

        require_once 'views/cart.php';
    }
}
