<?php
define('PROJECT_ROOT', dirname(__DIR__));
define('PUBLIC_BASE', rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/');

chdir(PROJECT_ROOT);

$url = isset($_GET['url']) ? trim($_GET['url'], '/') : 'home';
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = $url === '' ? 'home' : $url;

$routes = [
    'home' => ['controller' => 'HomeController', 'file' => 'controllers/HomeController.php', 'method' => 'index'],
    'menu' => ['controller' => 'MenuController', 'file' => 'controllers/MenuController.php', 'method' => 'index'],
    'search' => ['controller' => 'SearchController', 'file' => 'controllers/SearchController.php', 'method' => 'index'],
    'cart' => ['controller' => 'CartController', 'file' => 'controllers/CartController.php', 'method' => 'index'],
    'checkout' => ['controller' => 'CheckoutController', 'file' => 'controllers/CheckoutController.php', 'method' => 'index'],
    'orders' => ['controller' => 'OrdersController', 'file' => 'controllers/OrdersController.php', 'method' => 'index'],
    'order_success' => ['controller' => 'OrderSuccessController', 'file' => 'controllers/OrderSuccessController.php', 'method' => 'index'],
    'invoice' => ['controller' => 'InvoiceController', 'file' => 'controllers/InvoiceController.php', 'method' => 'index'],
    'product' => ['controller' => 'ProductController', 'file' => 'controllers/ProductController.php', 'method' => 'index'],
    'category' => ['controller' => 'CategoryController', 'file' => 'controllers/CategoryController.php', 'method' => 'index'],
    'quick_view' => ['controller' => 'QuickViewController', 'file' => 'controllers/QuickViewController.php', 'method' => 'index'],
    'contact' => ['controller' => 'ContactController', 'file' => 'controllers/ContactController.php', 'method' => 'index'],
    'login' => ['controller' => 'LoginController', 'file' => 'controllers/LoginController.php', 'method' => 'index'],
    'register' => ['controller' => 'RegisterController', 'file' => 'controllers/RegisterController.php', 'method' => 'index'],
    'profile' => ['controller' => 'ProfileController', 'file' => 'controllers/ProfileController.php', 'method' => 'index'],
    'update_profile' => ['controller' => 'UpdateProfileController', 'file' => 'controllers/UpdateProfileController.php', 'method' => 'index'],
    'update_address' => ['controller' => 'UpdateAddressController', 'file' => 'controllers/UpdateAddressController.php', 'method' => 'index'],
    'about' => ['controller' => 'AboutController', 'file' => 'controllers/AboutController.php', 'method' => 'index'],
];

if (isset($routes[$url])) {
    $route = $routes[$url];
    require_once $route['file'];
    $controller = new $route['controller']();
    $controller->{$route['method']}();
    exit;
}

if (str_ends_with($url, '.php')) {
    $cleanUrl = substr($url, 0, -4);
    if (isset($routes[$cleanUrl])) {
        $query = $_SERVER['QUERY_STRING'] ?? '';
        $query = preg_replace('/(^|&)url=[^&]*/', '', $query);
        $query = trim($query, '&');
        header('location:' . PUBLIC_BASE . $cleanUrl . ($query !== '' ? '?' . $query : ''));
        exit;
    }
}

http_response_code(404);
echo '<h1>404 - Pagina no encontrada</h1>';
