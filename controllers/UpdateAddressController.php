<?php
require_once 'models/UserModel.php';

class UpdateAddressController {
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
            $city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
            $zone = filter_var($_POST['zone'], FILTER_SANITIZE_STRING);
            $street = filter_var($_POST['street'], FILTER_SANITIZE_STRING);
            $home_number = filter_var($_POST['home_number'], FILTER_SANITIZE_STRING);
            $reference = filter_var($_POST['reference'], FILTER_SANITIZE_STRING);
            $billing_name = filter_var($_POST['billing_name'], FILTER_SANITIZE_STRING);
            $nit_ci = filter_var($_POST['nit_ci'], FILTER_SANITIZE_STRING);

            $address = $city . ', zona ' . $zone . ', ' . $street . ', Nro. ' . $home_number . ', Ref.: ' . $reference;
            $address = filter_var($address, FILTER_SANITIZE_STRING);

            $userModel->updateAddressData($user_id, [
                'address' => $address,
                'city' => $city,
                'zone' => $zone,
                'street' => $street,
                'home_number' => $home_number,
                'delivery_reference' => $reference,
                'billing_name' => $billing_name,
                'nit_ci' => $nit_ci,
            ]);

            $message[] = 'datos guardados correctamente';
            $fetch_profile = $userModel->getById($user_id);
        }

        require_once 'views/update_address.php';
    }
}
