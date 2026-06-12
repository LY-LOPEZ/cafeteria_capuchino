<?php
require_once 'models/UserModel.php';

class ProfileController {
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

        require_once 'views/profile.php';
    }
}
