<footer class="footer">
   <?php
   $footerRoute = function ($name, $legacy) {
      return defined('PUBLIC_BASE') ? PUBLIC_BASE . $name : $legacy;
   };
   ?>

   <section class="grid">

      <div class="box">
         <h3>enlaces rapidos</h3>
         <a href="<?= $footerRoute('home', 'home.php'); ?>">Inicio</a>
         <a href="<?= $footerRoute('menu', 'menu.php'); ?>">Menu</a>
         <a href="<?= $footerRoute('product', 'product.php'); ?>">Productos</a>
         <a href="<?= $footerRoute('orders', 'orders.php'); ?>">Pedidos</a>
         <a href="<?= $footerRoute('contact', 'contact.php'); ?>">Contacto</a>
      </div>

      <div class="box">
         <h3>Coffee Shop Sucre <i class="fas fa-mug-hot"></i></h3>
         <p>Cafeteria con sistema de pedidos en linea, pago por QR y seguimiento de pedidos.</p>
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
      </div>

      <div class="box">
         <h3>horario de atencion</h3>
         <div class="dateinfo">
            <p>LUNES</p><samp>CERRADO</samp>
         </div>
         <div class="dateinfo">
            <p>MARTES</p><samp>09:00 - 22:00</samp>
         </div>
         <div class="dateinfo">
            <p>MIERCOLES</p><samp>09:00 - 22:00</samp>
         </div>
         <div class="dateinfo">
            <p>JUEVES</p><samp>09:00 - 22:00</samp>
         </div>
         <div class="dateinfo">
            <p>VIERNES</p><samp>09:00 - 22:00</samp>
         </div>
         <div class="dateinfo">
            <p>SABADO</p><samp>09:00 - 22:00</samp>
         </div>
         <div class="dateinfo">
            <p>DOMINGO</p><samp>10:00 - 20:00</samp>
         </div>
      </div>

      <div class="box">
         <h3>informacion de contacto</h3>
         <div class="phone">
            <p><i class="fas fa-envelope"></i> cafeshopsucre@gmail.com</p>
         </div>

         <div class="phone1">
            <h3>ubicacion</h3>
            <p><i class="fas fa-map-marker-alt"></i> Centro historico de Sucre, cerca de la Plaza 25 de Mayo</p>
            <p>Sucre - Bolivia</p>
         </div>
      </div>

   </section>

   <div class="credit">&copy; <?= date('Y'); ?> Coffee Shop Sucre | Sistema de pedidos en linea</div>

</footer>
