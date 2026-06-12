<?php
require_once 'models/ProductModel.php';

class CategoryController {
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

        $category = filter_var($_GET['category'] ?? '', FILTER_SANITIZE_STRING);
        $productModel = new ProductModel();
        $products = $category !== '' ? $productModel->getProductsByCategory($category) : [];

        require_once 'views/category.php';
    }
}
