<?php
require_once 'models/ProductModel.php';

class MenuController {
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
        $menuSections = [
            ['title' => 'Cafe', 'products' => $productModel->getProductsByCategory('coffee')],
            ['title' => 'acompanamientos', 'products' => $productModel->getProductsByCategory('fast food')],
            ['title' => 'bebidas', 'products' => $productModel->getProductsByCategory('drinks')],
            ['title' => 'postres', 'products' => $productModel->getProductsByCategory('desserts')],
        ];
        $menuSections = array_values(array_filter($menuSections, function ($section) {
            return !empty($section['products']);
        }));

        require_once 'views/menu.php';
    }
}
