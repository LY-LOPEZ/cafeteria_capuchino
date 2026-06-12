<?php
require_once 'models/ProductModel.php';

class HomeController {
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
        $latest_products = $productModel->getLatestProducts();
        $popular_products = $productModel->getPopularProducts();
        $all_products = $productModel->getProducts();

        require_once 'views/home.php';
    }
}
