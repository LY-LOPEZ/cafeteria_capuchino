<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Inicio | Cafe Shop</title>
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <!-- showcase area -->

   <section class="hero">

      <div class="swiper hero-slider">

         <div class="swiper-wrapper">

            <div class="swiper-slide slide">
               <div class="content">
                  <span>Cafetería en Sucre con pedidos en línea</span>
                  <h3>Café, pedidos en línea y pago QR.</h3>
                  <p class="hero-copy">Explora el menú, arma tu pedido desde la web, paga por QR y sigue el estado de tu compra hasta recibirla.</p>
                  <div class="hero-actions">
                     <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'menu' : 'menu.php'; ?>" class="btn">Ver menú</a>
                     <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'contact' : 'contact.php'; ?>" class="hero-link">Ubicación y contacto</a>
                  </div>
                  <div class="hero-proof">
                     <span><strong>QR</strong> pago rápido</span>
                     <span><strong>5</strong> estados del pedido</span>
                     <span><strong>Hoy</strong> café y postres</span>
                  </div>
               </div>
               <div class="image">
                  <div class="hero-visual-card">
                     <img id="hero-product-img" src="images/pexels-chevanon-photography-302899.jpg" alt="Café latte recién servido">
                     <div>
                        <span id="hero-product-kicker">Especial de la casa</span>
                        <strong id="hero-product-name">Latte artesanal</strong>
                     </div>
                  </div>
               </div>
            </div>

         </div>

         <div class="swiper-pagination"></div>

      </div>

   </section>



   <!-- category Area -->

   <section class="category">

      <h1 class="title">Categorías</h1>

      <div class="box-container">

         <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'category' : 'category.php'; ?>?category=Coffee" class="box">
            <img src="images/cat-1.png" alt="">
            <h3>Café</h3>
         </a>

         <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'category' : 'category.php'; ?>?category=fast food" class="box">
            <img src="images/cat-2.png" alt="">
            <h3>Acompañamientos</h3>
         </a>

         <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'category' : 'category.php'; ?>?category=drinks" class="box">
            <img src="images/cat-3.png" alt="">
            <h3>Bebidas</h3>
         </a>

         <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'category' : 'category.php'; ?>?category=desserts" class="box">
            <img src="images/cat-4.png" alt="">
            <h3>Postres</h3>
         </a>

      </div>

   </section>
   <!-- give way -->

   <!-- products -->

   <section class="products">

      <h1 class="title">Últimos productos</h1>

      <div class="box-container">

         <?php
         if (!empty($latest_products)) {
            foreach ($latest_products as $fetch_products) {
         ?>
               <form action="" method="post" class="box">
                  <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                  <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                  <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                  <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
                  <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'quick_view' : 'quick_view.php'; ?>?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
                  <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
                  <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                  <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'category' : 'category.php'; ?>?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
                  <div class="name"><?= $fetch_products['name']; ?></div>
                  <div class="flex">
                     <div class="price"><span>Bs.</span><?= $fetch_products['price']; ?></div>
                     <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                  </div>
               </form>
         <?php
            }
         } else {
            echo '<p class="empty">Aún no se han añadido productos.</p>';
         }
         ?>

      </div>

      <div class="more-btn">
         <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'menu' : 'menu.php'; ?>" class="btn">Ver todo</a>
      </div>

   </section>


   <section class="products">

      <h1 class="title">Lo más elegido por clientes</h1>

      <div class="box-container">

         <?php
         if (!empty($popular_products)) {
            foreach ($popular_products as $fetch_products) {
         ?>
               <form action="" method="post" class="box">
                  <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                  <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                  <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                  <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
                  <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'quick_view' : 'quick_view.php'; ?>?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
                  <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
                  <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                  <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'category' : 'category.php'; ?>?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>


                  <div class="name"><?= $fetch_products['name']; ?></div>
                  <div class="flex">
                     <div class="price"><span>Bs.</span><?= $fetch_products['price']; ?></div>
                     <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                  </div>
               </form>
         <?php
            }
         } else {
            echo '<p class="empty">¡aún no se han añadido productos!</p>';
         }
         ?>

      </div>

      <div class="more-btn">
         <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'product' : 'product.php'; ?>" class="btn">Ver todo</a>
      </div>

   </section>

   <!-- about section starts  -->

   <section class="about">

      <div class="row">

         <div class="image">
            <img src="images/whychoose.jpg" alt="">
         </div>

         <div class="content">
            <h3>¿por qué elegirnos?</h3>
            <p>Somos una cafetería pensada para atender mejor a los clientes de Sucre: puedes revisar el menú, hacer tu pedido en línea, pagar por QR y seguir el estado de tu compra desde la misma página.</p>
            <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'menu' : 'menu.php'; ?>" class="btn">Nuestro menú</a>
         </div>

      </div>

   </section>



   <section class="steps">

      <h1 class="title">Pasos sencillos</h1>

      <div class="box-container">

         <div class="box">
            <img src="images/step-1.png" alt="">
            <h3>elige pedido</h3>
            <p>Explora el menú, revisa los productos disponibles y agrega al carrito tus bebidas o acompañamientos favoritos.</p>
         </div>

         <div class="box">
            <img src="images/step-2.png" alt="">
            <h3>Pago rápido</h3>
            <p>Genera el QR de pago, registra la referencia y confirma tu pedido de forma sencilla desde el checkout.</p>
         </div>

         <div class="box">
            <img src="images/step-3.png" alt="">
            <h3>Disfruta tu pedido</h3>
            <p>Consulta el avance de tu pedido: pendiente, preparando, listo, en camino o entregado.</p>
         </div>

      </div>

   </section>
   <section class="contact">

      <div class="row">

         <div class="map">
            <iframe class="minmap" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10843.656734427863!2d-65.2723925019091!3d-19.047258909718963!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x93fbc97fe1cce27b%3A0x80756f54656d24ca!2sCentro%20Hist%C3%B3rico%20Sucre!5e0!3m2!1ses!2sbo!4v1781233134408!5m2!1ses!2sbo" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
         </div>

         <form action="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'contact' : 'contact.php'; ?>" method="post">
            <h3>Contáctanos</h3>
            <input type="text" name="name" maxlength="50" class="box" placeholder="Ingresa Tu Nombre" required>
            <input type="email" name="email" maxlength="50" class="box" placeholder="Ingresa Tu Correo" required>
            <input type="number" name="number" min="0" max="9999999999" class="box" placeholder="Ingresa tu número" required maxlength="10">
            <textarea name="msg" class="box" required placeholder="Ingresa Tu Mensaje" maxlength="500" cols="30" rows="10"></textarea>
            <input type="submit" value="enviar" name="send" class="btn">
         </form>

      </div>

   </section>


   <!-- steps section ends -->


   <?php include 'components/footer.php'; ?>


   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
   <!-- custom js file link  -->
   <script src="js/script.js"></script>

   <script>
      var swiper = new Swiper(".hero-slider", {
         loop: false,
         grabCursor: true,
         effect: "slide",
         speed: 700,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
      });

      const heroProducts = [
         {
            image: 'images/pexels-chevanon-photography-302899.jpg',
            alt: 'Café latte recién servido',
            kicker: 'Especial de la casa',
            name: 'Latte artesanal'
         },
         {
            image: 'uploaded_img/cappuccino-1659544996.png',
            alt: 'Cappuccino cremoso',
            kicker: 'Más pedido',
            name: 'Cappuccino cremoso'
         },
         {
            image: 'uploaded_img/mocha-1659544996.webp',
            alt: 'Mocha con chocolate',
            kicker: 'Dulce y intenso',
            name: 'Mocha chocolate'
         },
         {
            image: 'uploaded_img/cold-brew-1659544996.webp',
            alt: 'Cold brew especial',
            kicker: 'Refrescante',
            name: 'Cold brew especial'
         },
         {
            image: 'images/coffee-shop-1209863_1280.jpg',
            alt: 'Postres frescos de cafetería',
            kicker: 'Para acompañar',
            name: 'Postres frescos'
         }
      ];

      const heroProductImg = document.getElementById('hero-product-img');
      const heroProductKicker = document.getElementById('hero-product-kicker');
      const heroProductName = document.getElementById('hero-product-name');

      heroProducts.forEach((product) => {
         const image = new Image();
         image.src = product.image;
      });

      let heroProductIndex = 0;
      setInterval(() => {
         heroProductIndex = (heroProductIndex + 1) % heroProducts.length;
         const product = heroProducts[heroProductIndex];

         heroProductImg.classList.add('is-changing');
         heroProductName.classList.add('is-changing');
         heroProductKicker.classList.add('is-changing');

         setTimeout(() => {
            heroProductImg.src = product.image;
            heroProductImg.alt = product.alt;
            heroProductKicker.textContent = product.kicker;
            heroProductName.textContent = product.name;

            heroProductImg.classList.remove('is-changing');
            heroProductName.classList.remove('is-changing');
            heroProductKicker.classList.remove('is-changing');
         }, 260);
      }, 3500);
   </script>

</body>

</html>


