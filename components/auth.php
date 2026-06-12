<?php

if (!function_exists('publicUrl')) {
   function publicUrl($route, $legacy) {
      return defined('PUBLIC_BASE') ? PUBLIC_BASE . $route : $legacy;
   }
}

if (!function_exists('getValidUserId')) {
   function getValidUserId($conn) {
      if (!isset($_SESSION['user_id']) || !ctype_digit((string)$_SESSION['user_id']) || (int)$_SESSION['user_id'] <= 0) {
         unset($_SESSION['user_id']);
         return '';
      }

      $user_id = (string)$_SESSION['user_id'];
      $check_user = $conn->prepare("SELECT id FROM `users` WHERE id = ?");
      $check_user->execute([$user_id]);

      if ($check_user->rowCount() === 0) {
         unset($_SESSION['user_id']);
         return '';
      }

      return $user_id;
   }
}

if (!function_exists('requireUser')) {
   function requireUser($conn) {
      $user_id = getValidUserId($conn);

      if ($user_id === '') {
         $_SESSION['message'][] = 'Para continuar, inicia sesion o crea una cuenta.';
         header('location:' . publicUrl('login', 'login.php'));
         exit;
      }

      return $user_id;
   }
}
