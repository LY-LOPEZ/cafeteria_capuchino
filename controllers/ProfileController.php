<?php
require_once 'models/UserModel.php';
require_once 'components/auth.php';

class ProfileController {
    public function index() {
        include 'components/connect.php';

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $user_id = requireUser($conn);

        $userModel = new UserModel();
        $fetch_profile = $userModel->getById($user_id);

        require_once 'views/profile.php';
    }
}
