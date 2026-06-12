<?php
$route = function ($name, $legacy) {
   return defined('PUBLIC_BASE') ? PUBLIC_BASE . $name : $legacy;
};
$logoutUrl = defined('PUBLIC_BASE') ? rtrim(dirname(rtrim(PUBLIC_BASE, '/')), '/\\') . '/components/user_logout.php' : 'components/user_logout.php';
$current_path = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
if ($current_path == '' || $current_path == 'public') $current_path = 'home';
$current_path = str_replace('.php', '', $current_path);

$is_active = function($page_name) use ($current_path) {
    return ($current_path == $page_name || ($current_path == 'index' && $page_name == 'home')) ? 'active' : '';
};


if (isset($_SESSION['message'])) {
   $message = array_merge($message ?? [], $_SESSION['message']);
   unset($_SESSION['message']);
}

if (isset($message)) {
   foreach ($message as $message) {
      echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

$fetch_profile = false;
$total_cart_items = 0;
$has_valid_user = $user_id != '' && ctype_digit((string)$user_id) && (int)$user_id > 0;

if ($has_valid_user) {
   $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
   $select_profile->execute([$user_id]);

   if ($select_profile->rowCount() > 0) {
      $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
      $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $count_cart_items->execute([$user_id]);
      $total_cart_items = $count_cart_items->rowCount();
   } else {
      unset($_SESSION['user_id']);
      $user_id = '';
   }
}
?>

<header class="header">

   <section class="flex">

      <a href="<?= $route('home', 'home.php'); ?>" class="logo">
         <img src="images/logo.png" alt="Cafe Shop">
      </a>

      <nav class="navbar">
         <a href="<?= $route('home', 'home.php'); ?>" class="<?= $is_active('home'); ?>">INICIO</a>
         <a href="<?= $route('menu', 'menu.php'); ?>" class="<?= $is_active('menu'); ?>">MENÚ</a>
         <a href="<?= $route('orders', 'orders.php'); ?>" class="<?= $is_active('orders'); ?>">PEDIDOS</a>
         <a href="<?= $route('contact', 'contact.php'); ?>" class="<?= $is_active('contact'); ?>">CONTACTO</a>
      </nav>

      <div class="icons">
         <a href="<?= $route('search', 'search.php'); ?>"><i class="fas fa-search"></i></a>
         <a href="<?= $route('cart', 'cart.php'); ?>"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_items; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>

      <div class="profile">
         <?php
         if ($fetch_profile) {
         ?>
            <p class="name"><?= $fetch_profile['name']; ?></p>
            <div class="flex">
               <a style="margin-left: 10px;" href="<?= $route('profile', 'profile.php'); ?>" class="btn">perfil</a>
               <a href="<?= $logoutUrl; ?>" onclick="return confirm('¿cerrar sesión en este sitio web?');" class="delete-btn">salir</a>
            </div>
            <!-- <p class="account">
               <a href="<?= $route('login', 'login.php'); ?>">login</a> or
               <a href="<?= $route('register', 'register.php'); ?>">register</a>
            </p> -->
         <?php
         } else {
         ?>
            <p class="name">¡por favor inicia sesión primero!</p>
            <a href="<?= $route('login', 'login.php'); ?>" class="btn">iniciar sesión</a>
         <?php
         }
         ?>
      </div>

   </section>

</header>


