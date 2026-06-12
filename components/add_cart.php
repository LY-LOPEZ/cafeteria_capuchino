<?php

require_once 'components/auth.php';

if (!function_exists('cartLoginUrl')) {
   function cartLoginUrl() {
      return publicUrl('login', 'login.php');
   }
}

if (!function_exists('renderCartAction')) {
   function renderCartAction($user_id, $class = 'fas fa-shopping-cart', $label = '') {
      if ($user_id == '' || !ctype_digit((string)$user_id) || (int)$user_id <= 0) {
         echo '<a href="' . htmlspecialchars(cartLoginUrl(), ENT_QUOTES, 'UTF-8') . '" class="' . htmlspecialchars($class, ENT_QUOTES, 'UTF-8') . '" title="Inicia sesion o crea una cuenta para comprar" aria-label="Inicia sesion o crea una cuenta para comprar">' . $label . '</a>';
      } else {
         echo '<button type="submit" class="' . htmlspecialchars($class, ENT_QUOTES, 'UTF-8') . '" name="add_to_cart">' . $label . '</button>';
      }
   }
}

if(isset($_POST['add_to_cart'])){

   $user_id = getValidUserId($conn);

   if($user_id == ''){
      $_SESSION['message'][] = 'Para comprar, inicia sesion o crea una cuenta.';
      $loginUrl = cartLoginUrl();
      header('location:' . $loginUrl);
      exit;
   }else{

      $pid = $_POST['pid'];
      $pid = filter_var($pid, FILTER_SANITIZE_STRING);
      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $price = $_POST['price'];
      $price = filter_var($price, FILTER_SANITIZE_STRING);
      $image = $_POST['image'];
      $image = filter_var($image, FILTER_SANITIZE_STRING);
      $qty = $_POST['qty'];
      $qty = filter_var($qty, FILTER_SANITIZE_STRING);

      $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
      $check_cart_numbers->execute([$name, $user_id]);

      if($check_cart_numbers->rowCount() > 0){
         $message[] = '¡ya está añadido al carrito!';
      }else{
         $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
         $insert_cart->execute([$user_id, $pid, $name, $price, $qty, $image]);
         $message[] = '¡añadido al carrito!';
         
      }

   }

}
