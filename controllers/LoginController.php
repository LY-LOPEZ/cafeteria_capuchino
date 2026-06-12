<?php
require_once 'models/UserModel.php';

class LoginController {
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

        if (isset($_POST['submit'])) {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
            $pass = filter_var(sha1($_POST['pass']), FILTER_SANITIZE_STRING);

            $userModel = new UserModel();
            $user = $userModel->findByEmailAndPassword($email, $pass);

            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $homeUrl = defined('PUBLIC_BASE') ? PUBLIC_BASE . 'home' : 'home.php';
                header('location:' . $homeUrl);
                exit;
            } else {
                $message[] = 'usuario o contrasena incorrectos';
            }
        }

        require_once 'views/login.php';
    }
}
