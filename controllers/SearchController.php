<?php
require_once 'models/ProductModel.php';

class SearchController {
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

        $search_box = '';
        if (isset($_GET['search_box'])) {
            $search_box = trim($_GET['search_box']);
        } elseif (isset($_POST['search_box'])) {
            $search_box = trim($_POST['search_box']);
        }

        $products = [];
        if ($search_box !== '') {
            $productModel = new ProductModel();
            $products = $productModel->searchProducts($search_box);
        }

        require_once 'views/search.php';
    }
}
