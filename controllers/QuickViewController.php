<?php
require_once 'models/ProductModel.php';

class QuickViewController {
    public function index() {
        include 'components/connect.php';

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
        } else {
            $user_id = '';
        }

        include 'components/add_cart.php';

        $productId = filter_var($_GET['pid'] ?? '', FILTER_SANITIZE_NUMBER_INT);
        $productModel = new ProductModel();
        $product = $productId !== '' ? $productModel->getProductById($productId) : false;

        require_once 'views/quick_view.php';
    }
}
