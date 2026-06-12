<?php
require_once 'models/ProductModel.php';

class ProductController {
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

        $productModel = new ProductModel();
        $products = $productModel->getAllProducts();

        require_once 'views/product.php';
    }
}
