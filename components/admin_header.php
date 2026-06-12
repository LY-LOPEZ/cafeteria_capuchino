<?php
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
?>

<header class="header">

   <section class="flex">

      <a href="dashboard.php" class="logo">Panel<span>Admin</span></a>

      <nav class="navbar">
         <a href="dashboard.php">inicio</a>
         <a href="products.php">productos</a>
         <a href="placed_orders.php">pedidos</a>
         <a href="admin_accounts.php">administradores</a>
         <a href="users_accounts.php">usuarios</a>
         <a href="employee_accounts.php">empleados</a>
         <a href="messages.php">mensajes</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
         $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
         $select_profile->execute([$admin_id]);
         $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="update_profile.php" class="btn">actualizar perfil</a>
         <a href="../components/admin_logout.php" onclick="return confirm('¿cerrar sesión en este sitio web?');" class="delete-btn">salir</a>
      </div>

   </section>

</header>
