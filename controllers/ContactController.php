<?php
require_once 'models/MessageModel.php';

class ContactController {
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

        if (isset($_POST['send'])) {
            $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
            $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
            $msg = filter_var($_POST['msg'], FILTER_SANITIZE_STRING);

            $messageModel = new MessageModel();
            if ($messageModel->exists($name, $email, $number, $msg)) {
                $message[] = 'mensaje ya enviado';
            } else {
                $messageModel->create($user_id, $name, $email, $number, $msg);
                $message[] = 'mensaje enviado con exito';
            }
        }

        require_once 'views/contact.php';
    }
}
