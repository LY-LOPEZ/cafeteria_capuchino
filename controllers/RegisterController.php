<?php
require_once 'models/UserModel.php';

class RegisterController {
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
            $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
            $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
            $pass = filter_var(sha1($_POST['pass']), FILTER_SANITIZE_STRING);
            $cpass = filter_var(sha1($_POST['cpass']), FILTER_SANITIZE_STRING);

            $userModel = new UserModel();

            if ($userModel->existsByEmailOrNumber($email, $number)) {
                $message[] = 'el correo o numero ya existe';
            } elseif ($pass != $cpass) {
                $message[] = 'la confirmacion de contrasena no coincide';
            } else {
                $userModel->create($name, $email, $number, $cpass);
                $user = $userModel->findByEmailAndPassword($email, $pass);
                if ($user) {
                    $_SESSION['user_id'] = $user['id'];
                    $homeUrl = defined('PUBLIC_BASE') ? PUBLIC_BASE . 'home' : 'home.php';
                    header('location:' . $homeUrl);
                    exit;
                }
            }
        }

        require_once 'views/register.php';
    }
}
