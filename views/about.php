<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>sobre nosotros</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <div class="heading">
      <h3>sobre nosotros</h3>
      <p><a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'home' : 'home.php'; ?>">inicio</a> <span> / sobre nosotros</span></p>
   </div>

   <section class="about">
      <div class="row">
         <div class="image">
            <img src="images/about-card.jpg" alt="">
         </div>

         <div class="content">
            <h3>Nuestra mision</h3>
            <p>Somos una cafeteria enfocada en mejorar la atencion a clientes de Sucre mediante un sistema propio de pedidos en linea.</p>
            <p>El cliente puede revisar el menu, agregar productos al carrito, pagar por QR, confirmar su pedido y consultar el seguimiento desde la pagina web.</p>
            <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'menu' : 'menu.php'; ?>" class="btn">ver menu</a>
         </div>
      </div>
   </section>

   <section class="steps">
      <h1 class="title">como funciona</h1>

      <div class="box-container">
         <div class="box">
            <img src="images/step-1.png" alt="">
            <h3>elige productos</h3>
            <p>Explora cafe, bebidas, postres y acompanamientos disponibles en el catalogo.</p>
         </div>

         <div class="box">
            <img src="images/step-2.png" alt="">
            <h3>paga por QR</h3>
            <p>Genera el QR de pago, registra la referencia y envia el pedido a la cafeteria.</p>
         </div>

         <div class="box">
            <img src="images/step-3.png" alt="">
            <h3>sigue tu pedido</h3>
            <p>Consulta si tu pedido esta pendiente, preparandose, listo, en camino o entregado.</p>
         </div>
      </div>
   </section>

   <section class="about">
      <div class="row">
         <div class="content">
            <h3>por que elegirnos</h3>
            <p>El sistema reduce tiempos de espera, organiza los pedidos y permite que la cafeteria atienda mejor la demanda local sin depender de plataformas externas.</p>
            <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'contact' : 'contact.php'; ?>" class="btn">contacto</a>
         </div>

         <div class="image">
            <img src="images/contact-us.jpg" alt="">
         </div>
      </div>
   </section>

   <?php include 'components/footer.php'; ?>

   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
   <script src="js/script.js"></script>
</body>

</html>
