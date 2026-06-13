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
   <link rel="stylesheet" href="css/style.css?v=20260613-addgreen">
   <?php include 'components/tailwind_head.php'; ?>

</head>

<body class="tw-bg-coffee-50 tw-font-sans tw-text-coffee-900">

   <?php include 'components/user_header.php'; ?>

   <!-- showcase area -->

   <section class="hero tw-relative tw-isolate tw-mx-auto tw-mb-20 tw-w-full tw-overflow-hidden tw-px-6 tw-py-16 md:tw-px-16 lg:tw-px-24">

      <div class="swiper hero-slider">

         <div class="swiper-wrapper">

            <div class="swiper-slide slide tw-grid tw-min-h-[560px] tw-items-center tw-gap-12 lg:tw-grid-cols-[1.08fr_.82fr]">
               <div class="content tw-text-center lg:tw-text-left">
                  <span class="tw-inline-flex tw-items-center tw-rounded-full tw-border tw-border-coffee-300/40 tw-bg-white/10 tw-px-5 tw-py-3 tw-text-sm tw-font-bold tw-uppercase tw-tracking-[.16em] tw-text-coffee-100 tw-backdrop-blur">Cafeter&iacute;a en Sucre con pedidos en l&iacute;nea</span>
                  <h3 class="tw-mx-auto tw-my-7 tw-max-w-4xl tw-font-display tw-text-[4.2rem] tw-font-bold tw-leading-none tw-text-coffee-50 tw-shadow-black/40 lg:tw-mx-0 lg:tw-text-[7.8rem]">Tu café favorito, ahora en línea.</h3>
                  <p class="hero-copy tw-mx-auto tw-max-w-2xl tw-text-3xl tw-leading-relaxed tw-text-coffee-50/85 lg:tw-mx-0">Explora el men&uacute;, arma tu pedido desde la web, paga por QR y sigue el estado de tu compra hasta recibirla.</p>
                  <div class="hero-actions tw-mt-10 tw-flex tw-flex-wrap tw-items-center tw-justify-center tw-gap-5 lg:tw-justify-start">
                     <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'menu' : 'menu.php'; ?>" class="btn tw-inline-flex tw-items-center tw-justify-center tw-rounded-md tw-bg-coffee-100 tw-px-10 tw-py-5 tw-text-xl tw-font-extrabold tw-uppercase tw-text-coffee-900 tw-shadow-cafe tw-transition hover:-tw-translate-y-1 hover:tw-bg-white">Ver men&uacute;</a>
                     <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'contact' : 'contact.php'; ?>" class="hero-link tw-border-b tw-border-coffee-100/70 tw-pb-2 tw-text-xl tw-font-bold tw-text-coffee-50 tw-transition hover:tw-text-coffee-100">Ubicaci&oacute;n y contacto</a>
                  </div>
                  <div class="hero-proof tw-mx-auto tw-mt-14 tw-grid tw-max-w-3xl tw-grid-cols-1 tw-gap-4 sm:tw-grid-cols-3 lg:tw-mx-0">
                     <span class="tw-flex tw-min-h-32 tw-flex-col tw-justify-center tw-rounded-lg tw-border tw-border-white/15 tw-bg-white/10 tw-p-5 tw-text-lg tw-text-coffee-50/75 tw-backdrop-blur"><strong class="tw-font-sans tw-text-4xl tw-text-coffee-100">QR</strong> pago r&aacute;pido</span>
                     <span class="tw-flex tw-min-h-32 tw-flex-col tw-justify-center tw-rounded-lg tw-border tw-border-white/15 tw-bg-white/10 tw-p-5 tw-text-lg tw-text-coffee-50/75 tw-backdrop-blur"><strong class="tw-font-sans tw-text-4xl tw-text-coffee-100">5</strong> estados del pedido</span>
                     <span class="tw-flex tw-min-h-32 tw-flex-col tw-justify-center tw-rounded-lg tw-border tw-border-white/15 tw-bg-white/10 tw-p-5 tw-text-lg tw-text-coffee-50/75 tw-backdrop-blur"><strong class="tw-font-sans tw-text-4xl tw-text-coffee-100">Hoy</strong> caf&eacute; y postres</span>
                  </div>
               </div>
               <div class="image tw-flex tw-justify-center lg:tw-justify-end">
                  <div class="hero-visual-card tw-relative tw-w-full tw-max-w-xl tw-rounded-lg tw-border tw-border-white/20 tw-bg-white/10 tw-p-5 tw-shadow-cafe tw-backdrop-blur">
                     <img id="hero-product-img" class="tw-h-[32rem] tw-w-full tw-rounded-md tw-object-cover md:tw-h-[48rem]" src="images/pexels-chevanon-photography-302899.jpg" alt="Cafe latte recien servido">
                     <div class="tw-absolute tw-bottom-8 tw-left-8 tw-right-8 tw-rounded-md tw-bg-coffee-900/80 tw-p-6 tw-text-coffee-50 tw-backdrop-blur">
                        <span id="hero-product-kicker" class="tw-block tw-text-sm tw-font-bold tw-uppercase tw-tracking-[.12em] tw-text-coffee-100">Especial de la casa</span>
                        <strong id="hero-product-name" class="tw-mt-2 tw-block tw-font-sans tw-text-4xl">Latte artesanal</strong>
                     </div>
                  </div>
               </div>
            </div>

         </div>

         <div class="swiper-pagination"></div>

      </div>

   </section>



   <!-- category Area -->

   <section class="category tw-mx-auto tw-max-w-7xl tw-px-6 tw-py-12">

      <h1 class="title tw-font-sans tw-text-5xl tw-normal-case tw-text-coffee-900">Categor&iacute;as</h1>

      <div class="box-container tw-grid tw-grid-cols-1 tw-gap-6 sm:tw-grid-cols-2 lg:tw-grid-cols-4">

         <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'category' : 'category.php'; ?>?category=Coffee" class="box tw-group tw-rounded-lg tw-border tw-border-coffee-700/10 tw-bg-white tw-p-10 tw-text-center tw-shadow-cafe tw-transition hover:-tw-translate-y-1 hover:tw-bg-coffee-700">
            <img class="tw-mx-auto tw-h-36 tw-w-full tw-object-contain tw-transition group-hover:tw-invert" src="images/cat-1.png" alt="">
            <h3 class="tw-mt-6 tw-text-3xl tw-font-bold tw-text-coffee-900 group-hover:tw-text-white">Caf&eacute;</h3>
         </a>

         <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'category' : 'category.php'; ?>?category=fast food" class="box tw-group tw-rounded-lg tw-border tw-border-coffee-700/10 tw-bg-white tw-p-10 tw-text-center tw-shadow-cafe tw-transition hover:-tw-translate-y-1 hover:tw-bg-coffee-700">
            <img class="tw-mx-auto tw-h-36 tw-w-full tw-object-contain tw-transition group-hover:tw-invert" src="images/cat-2.png" alt="">
            <h3 class="tw-mt-6 tw-text-3xl tw-font-bold tw-text-coffee-900 group-hover:tw-text-white">Acompa&ntilde;amientos</h3>
         </a>

         <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'category' : 'category.php'; ?>?category=drinks" class="box tw-group tw-rounded-lg tw-border tw-border-coffee-700/10 tw-bg-white tw-p-10 tw-text-center tw-shadow-cafe tw-transition hover:-tw-translate-y-1 hover:tw-bg-coffee-700">
            <img class="tw-mx-auto tw-h-36 tw-w-full tw-object-contain tw-transition group-hover:tw-invert" src="images/cat-3.png" alt="">
            <h3 class="tw-mt-6 tw-text-3xl tw-font-bold tw-text-coffee-900 group-hover:tw-text-white">Bebidas</h3>
         </a>

         <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'category' : 'category.php'; ?>?category=desserts" class="box tw-group tw-rounded-lg tw-border tw-border-coffee-700/10 tw-bg-white tw-p-10 tw-text-center tw-shadow-cafe tw-transition hover:-tw-translate-y-1 hover:tw-bg-coffee-700">
            <img class="tw-mx-auto tw-h-36 tw-w-full tw-object-contain tw-transition group-hover:tw-invert" src="images/cat-4.png" alt="">
            <h3 class="tw-mt-6 tw-text-3xl tw-font-bold tw-text-coffee-900 group-hover:tw-text-white">Postres</h3>
         </a>

      </div>

   </section>
   <!-- give way -->

   <!-- products -->

   <section class="products tw-mx-auto tw-max-w-[1280px] tw-px-6 tw-py-14">

      <h1 class="title tw-font-sans tw-text-5xl tw-normal-case tw-text-coffee-900">&Uacute;ltimos productos</h1>

      <div class="box-container tw-grid tw-grid-cols-1 tw-gap-8 sm:tw-grid-cols-2 lg:tw-grid-cols-4">

         <?php
         if (!empty($latest_products)) {
            foreach ($latest_products as $fetch_products) {
         ?>
               <?php include 'components/product_card.php'; ?>
         <?php
            }
         } else {
            echo '<p class="empty">A&uacute;n no se han a&ntilde;adido productos.</p>';
         }
         ?>

      </div>

      <div class="more-btn tw-mt-10 tw-text-center">
         <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'menu' : 'menu.php'; ?>" class="btn tw-inline-flex tw-rounded-md tw-px-10 tw-py-5 tw-text-xl tw-font-bold">Ver todo</a>
      </div>

   </section>


   <section class="products tw-mx-auto tw-max-w-[1280px] tw-px-6 tw-py-14">

      <h1 class="title tw-font-sans tw-text-5xl tw-normal-case tw-text-coffee-900">Lo m&aacute;s elegido por clientes</h1>

      <div class="box-container tw-grid tw-grid-cols-1 tw-gap-8 sm:tw-grid-cols-2 lg:tw-grid-cols-4">

         <?php
         if (!empty($popular_products)) {
            foreach ($popular_products as $fetch_products) {
         ?>
               <?php include 'components/product_card.php'; ?>
         <?php
            }
         } else {
            echo '<p class="empty">&iexcl;a&uacute;n no se han a&ntilde;adido productos!</p>';
         }
         ?>

      </div>

      <div class="more-btn tw-mt-10 tw-text-center">
         <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'product' : 'product.php'; ?>" class="btn tw-inline-flex tw-rounded-md tw-px-10 tw-py-5 tw-text-xl tw-font-bold">Ver todo</a>
      </div>

   </section>

   <!-- about section starts  -->

   <section class="about tw-mx-auto tw-max-w-7xl tw-px-6 tw-py-16">

      <div class="row tw-grid tw-items-center tw-gap-10 tw-rounded-lg tw-bg-white tw-p-6 tw-shadow-cafe lg:tw-grid-cols-2 lg:tw-p-10">

         <div class="image">
            <img class="tw-h-[34rem] tw-w-full tw-rounded-md tw-object-cover" src="images/whychoose.jpg" alt="">
         </div>

         <div class="content tw-text-center lg:tw-text-left">
            <h3 class="tw-font-sans tw-text-5xl tw-font-bold tw-text-coffee-900">&iquest;por qu&eacute; elegirnos?</h3>
            <p class="tw-py-6 tw-text-3xl tw-leading-relaxed tw-text-coffee-900/70">Somos una cafeter&iacute;a pensada para atender mejor a los clientes de Sucre: puedes revisar el men&uacute;, hacer tu pedido en l&iacute;nea, pagar por QR y seguir el estado de tu compra desde la misma p&aacute;gina.</p>
            <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'menu' : 'menu.php'; ?>" class="btn tw-inline-flex tw-rounded-md tw-px-10 tw-py-5 tw-text-xl tw-font-bold">Nuestro men&uacute;</a>
         </div>

      </div>

   </section>



   <section class="steps tw-mx-auto tw-max-w-7xl tw-px-6 tw-py-16">

      <h1 class="title tw-font-sans tw-text-5xl tw-normal-case tw-text-coffee-900">Pasos sencillos</h1>

      <div class="box-container tw-grid tw-grid-cols-1 tw-gap-6 md:tw-grid-cols-3">

         <div class="box tw-rounded-lg tw-bg-white tw-p-8 tw-text-center tw-shadow-cafe">
            <img class="tw-mx-auto tw-h-40 tw-w-full tw-object-contain" src="images/step-1.png" alt="">
            <h3 class="tw-my-5 tw-text-3xl tw-font-bold tw-text-coffee-900">elige pedido</h3>
            <p class="tw-text-2xl tw-leading-relaxed tw-text-coffee-900/65">Explora el men&uacute;, revisa los productos disponibles y agrega al carrito tus bebidas o acompa&ntilde;amientos favoritos.</p>
         </div>

         <div class="box tw-rounded-lg tw-bg-white tw-p-8 tw-text-center tw-shadow-cafe">
            <img class="tw-mx-auto tw-h-40 tw-w-full tw-object-contain" src="images/step-2.png" alt="">
            <h3 class="tw-my-5 tw-text-3xl tw-font-bold tw-text-coffee-900">Pago r&aacute;pido</h3>
            <p class="tw-text-2xl tw-leading-relaxed tw-text-coffee-900/65">Genera el QR de pago, registra la referencia y confirma tu pedido de forma sencilla desde el checkout.</p>
         </div>

         <div class="box tw-rounded-lg tw-bg-white tw-p-8 tw-text-center tw-shadow-cafe">
            <img class="tw-mx-auto tw-h-40 tw-w-full tw-object-contain" src="images/step-3.png" alt="">
            <h3 class="tw-my-5 tw-text-3xl tw-font-bold tw-text-coffee-900">Disfruta tu pedido</h3>
            <p class="tw-text-2xl tw-leading-relaxed tw-text-coffee-900/65">Consulta el avance de tu pedido: pendiente, preparando, listo, en camino o entregado.</p>
         </div>

      </div>

   </section>
   <section class="contact tw-mx-auto tw-max-w-7xl tw-px-6 tw-py-16">

      <div class="row tw-grid tw-gap-8 lg:tw-grid-cols-2">

         <div class="map tw-overflow-hidden tw-rounded-lg tw-bg-white tw-p-4 tw-shadow-cafe">
            <iframe class="minmap" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10843.656734427863!2d-65.2723925019091!3d-19.047258909718963!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x93fbc97fe1cce27b%3A0x80756f54656d24ca!2sCentro%20Hist%C3%B3rico%20Sucre!5e0!3m2!1ses!2sbo!4v1781233134408!5m2!1ses!2sbo" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
         </div>

         <form class="tw-rounded-lg tw-bg-white tw-p-8 tw-shadow-cafe" action="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'contact' : 'contact.php'; ?>" method="post">
            <h3 class="tw-mb-6 tw-font-sans tw-text-5xl tw-font-bold tw-text-coffee-900">Cont&aacute;ctanos</h3>
            <input type="text" name="name" maxlength="50" class="box tw-mb-4 tw-w-full tw-rounded-md tw-border tw-border-coffee-700/15 tw-bg-coffee-50 tw-p-5 tw-text-2xl" placeholder="Ingresa Tu Nombre" required>
            <input type="email" name="email" maxlength="50" class="box tw-mb-4 tw-w-full tw-rounded-md tw-border tw-border-coffee-700/15 tw-bg-coffee-50 tw-p-5 tw-text-2xl" placeholder="Ingresa Tu Correo" required>
            <input type="number" name="number" min="0" max="9999999999" class="box tw-mb-4 tw-w-full tw-rounded-md tw-border tw-border-coffee-700/15 tw-bg-coffee-50 tw-p-5 tw-text-2xl" placeholder="Ingresa tu n&uacute;mero" required maxlength="10">
            <textarea name="msg" class="box tw-mb-4 tw-w-full tw-rounded-md tw-border tw-border-coffee-700/15 tw-bg-coffee-50 tw-p-5 tw-text-2xl" required placeholder="Ingresa Tu Mensaje" maxlength="500" cols="30" rows="10"></textarea>
            <input type="submit" value="enviar" name="send" class="btn tw-inline-flex tw-rounded-md tw-px-10 tw-py-5 tw-text-xl tw-font-bold">
         </form>

      </div>

   </section>


   <!-- steps section ends -->


   <?php include 'components/footer.php'; ?>


   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
   <!-- custom js file link  -->
   <script src="js/script.js?v=20260612"></script>

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
            alt: 'Cafe latte recien servido',
            kicker: 'Especial de la casa',
            name: 'Latte artesanal'
         },
         {
            image: 'uploaded_img/cappuccino-1659544996.png',
            alt: 'Cappuccino cremoso',
            kicker: 'Mas pedido',
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
            alt: 'Postres frescos de cafeteria',
            kicker: 'Para acompanar',
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



