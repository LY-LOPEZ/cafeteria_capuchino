<?php
require_once 'models/CartModel.php';
require_once 'models/OrderModel.php';
require_once 'models/UserModel.php';
require_once 'components/auth.php';

class CheckoutController {
    public function index() {
        include 'components/connect.php';

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $user_id = requireUser($conn);

        $cartModel = new CartModel();
        $userModel = new UserModel();
        $orderModel = new OrderModel();

        $fetch_profile = $userModel->getById($user_id);
        $cartItems = $cartModel->getItemsByUser($user_id);
        $grand_total = $cartModel->calculateTotal($cartItems);
        $total_products = $cartModel->summarizeItems($cartItems);

        if (isset($_POST['submit'])) {
            if (empty($cartItems)) {
                $message[] = 'tu carrito esta vacio';
            } elseif (!$fetch_profile || !$this->hasValue($fetch_profile['address'] ?? '')) {
                $message[] = 'por favor anade tu direccion';
            } elseif (
                !$this->hasValue($fetch_profile['city'] ?? '') ||
                !$this->hasValue($fetch_profile['zone'] ?? '') ||
                !$this->hasValue($fetch_profile['street'] ?? '') ||
                !$this->hasValue($fetch_profile['home_number'] ?? '') ||
                !$this->hasValue($fetch_profile['delivery_reference'] ?? '') ||
                !$this->hasValue($fetch_profile['billing_name'] ?? '') ||
                !$this->hasValue($fetch_profile['nit_ci'] ?? '')
            ) {
                $message[] = 'por favor completa tus datos de entrega y factura';
            } else {
                $paymentReference = filter_var($_POST['payment_reference'] ?? '', FILTER_SANITIZE_STRING);
                $paymentProof = '';

                if ($paymentReference == '') {
                    $message[] = 'por favor ingresa la referencia del pago QR';
                } else {
                    $uploadResult = $this->handlePaymentProofUpload();
                    if (!$uploadResult['valid']) {
                        $message[] = $uploadResult['message'];
                    } else {
                        $paymentProof = $uploadResult['filename'];

                        $orderData = [
                            'user_id' => $user_id,
                            'name' => $fetch_profile['name'],
                            'number' => $fetch_profile['number'],
                            'email' => $fetch_profile['email'],
                            'method' => 'Pago por QR',
                            'payment_reference' => $paymentReference,
                            'payment_proof' => $paymentProof,
                            'address' => $fetch_profile['address'],
                            'city' => $fetch_profile['city'],
                            'zone' => $fetch_profile['zone'],
                            'street' => $fetch_profile['street'],
                            'home_number' => $fetch_profile['home_number'],
                            'delivery_reference' => $fetch_profile['delivery_reference'],
                            'billing_name' => $fetch_profile['billing_name'],
                            'nit_ci' => $fetch_profile['nit_ci'],
                            'total_products' => $total_products,
                            'total_price' => $grand_total,
                        ];

                        $orderId = $orderModel->createOrder($orderData, $cartItems);
                        $cartModel->deleteAllByUser($user_id);

                        $successUrl = defined('PUBLIC_BASE') ? PUBLIC_BASE . 'order_success' : 'order_success.php';
                        header('location:' . $successUrl . '?id=' . $orderId);
                        exit;
                    }
                }
            }
        }

        require_once 'views/checkout.php';
    }

    private function hasValue($value) {
        return trim((string)$value) !== '';
    }

    private function handlePaymentProofUpload() {
        if (!isset($_FILES['payment_proof']) || $_FILES['payment_proof']['name'] == '') {
            return ['valid' => false, 'filename' => '', 'message' => 'por favor sube la imagen del comprobante QR'];
        }

        $originalName = filter_var($_FILES['payment_proof']['name'], FILTER_SANITIZE_STRING);
        $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        $size = $_FILES['payment_proof']['size'];

        if (!in_array($extension, $allowedExtensions) || $size > 2000000) {
            return ['valid' => false, 'filename' => '', 'message' => 'el comprobante debe ser una imagen JPG, PNG o WEBP menor a 2MB'];
        }

        $filename = 'qr_pago_' . uniqid() . '.' . $extension;
        $folder = 'public/uploaded_img/' . $filename;
        if (!move_uploaded_file($_FILES['payment_proof']['tmp_name'], $folder)) {
            return ['valid' => false, 'filename' => '', 'message' => 'no se pudo guardar el comprobante QR'];
        }

        return ['valid' => true, 'filename' => $filename, 'message' => ''];
    }
}
