<?php
require_once 'models/UserModel.php';

class UpdateProfileController {
    public function index() {
        include 'components/connect.php';

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
        } else {
            $homeUrl = defined('PUBLIC_BASE') ? PUBLIC_BASE . 'home' : 'home.php';
            header('location:' . $homeUrl);
            exit;
        }

        $userModel = new UserModel();
        $fetch_profile = $userModel->getById($user_id);

        if (isset($_POST['submit'])) {
            $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
            $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);

            if ($name !== '') {
                $userModel->updateProfileField($user_id, 'name', $name);
            }

            if ($email !== '') {
                if ($userModel->emailExistsForAnotherUser($email, $user_id)) {
                    $message[] = 'el correo ya esta en uso';
                } else {
                    $userModel->updateProfileField($user_id, 'email', $email);
                }
            }

            if ($number !== '') {
                if ($userModel->numberExistsForAnotherUser($number, $user_id)) {
                    $message[] = 'el numero ya esta en uso';
                } else {
                    $userModel->updateProfileField($user_id, 'number', $number);
                }
            }

            $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
            $old_pass = filter_var(sha1($_POST['old_pass']), FILTER_SANITIZE_STRING);
            $new_pass = filter_var(sha1($_POST['new_pass']), FILTER_SANITIZE_STRING);
            $confirm_pass = filter_var(sha1($_POST['confirm_pass']), FILTER_SANITIZE_STRING);

            if ($old_pass != $empty_pass) {
                if ($old_pass != $fetch_profile['password']) {
                    $message[] = 'la contrasena antigua no coincide';
                } elseif ($new_pass != $confirm_pass) {
                    $message[] = 'la confirmacion de contrasena no coincide';
                } elseif ($new_pass == $empty_pass) {
                    $message[] = 'por favor ingresa una nueva contrasena';
                } else {
                    $userModel->updateProfileField($user_id, 'password', $confirm_pass);
                    $message[] = 'contrasena actualizada con exito';
                }
            }

            $fetch_profile = $userModel->getById($user_id);
        }

        require_once 'views/update_profile.php';
    }
}
