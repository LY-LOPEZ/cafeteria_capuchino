<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>carrito</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css?v=20260612-cart2">
   <?php include 'components/tailwind_head.php'; ?>
</head>

<body class="tw-bg-coffee-50 tw-font-sans tw-text-coffee-900">

   <?php include 'components/user_header.php'; ?>

   <div class="heading">
      <h3>carrito de compras</h3>
      <p><a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'home' : 'home.php'; ?>">inicio</a> <span> / carrito</span></p>
   </div>

   <section class="cart-page tw-mx-auto tw-max-w-[1280px] tw-px-6 tw-py-14">
      <h1 class="title tw-font-sans tw-text-5xl tw-normal-case tw-text-coffee-900">tu carrito</h1>

      <div class="cart-layout">
         <div class="cart-items-list">
         <?php if (!empty($cartItems)) { ?>
            <?php foreach ($cartItems as $fetch_cart) { ?>
               <?php $sub_total = ((int)$fetch_cart['price'] * (int)$fetch_cart['quantity']); ?>
               <form action="" method="post" class="cart-item-card">
                  <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                  <div class="cart-item-media">
                     <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
                  </div>
                  <div class="cart-item-info">
                     <div class="cart-item-top">
                        <div>
                           <h3><?= $fetch_cart['name']; ?></h3>
                           <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'quick_view' : 'quick_view.php'; ?>?pid=<?= $fetch_cart['pid']; ?>">ver detalle</a>
                        </div>
                        <button type="submit" class="cart-remove-btn" name="delete" onclick="return confirm('eliminar este articulo?');" aria-label="eliminar producto">
                           <i class="fas fa-times"></i>
                        </button>
                     </div>
                     <div class="cart-item-bottom">
                        <div class="cart-price"><span>Bs.</span><?= $fetch_cart['price']; ?></div>
                        <div class="cart-qty-control">
                           <input type="number" name="qty" class="qty" min="1" max="99" value="<?= $fetch_cart['quantity']; ?>" maxlength="2">
                           <button type="submit" name="update_qty" aria-label="actualizar cantidad"><i class="fas fa-pen"></i></button>
                        </div>
                     </div>
                     <div class="cart-subtotal">subtotal <span>Bs.<?= $sub_total; ?></span></div>
                  </div>
               </form>
            <?php } ?>
         <?php } else { ?>
            <p class="empty">tu carrito esta vacio</p>
         <?php } ?>
         </div>

         <aside class="cart-summary-card">
            <span class="cart-summary-kicker">resumen</span>
            <h2>Tu pedido</h2>
            <div class="cart-summary-line">
               <span>Total del carrito</span>
               <strong>Bs.<?= $grand_total; ?></strong>
            </div>
            <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'checkout' : 'checkout.php'; ?>" class="cart-checkout-btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>">proceder al pago</a>
            <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'menu' : 'menu.php'; ?>" class="cart-continue-btn">continuar comprando</a>
            <form action="" method="post">
               <button type="submit" class="cart-clear-btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>" name="delete_all" onclick="return confirm('eliminar todo del carrito?');">eliminar todo</button>
            </form>
         </aside>
      </div>
   </section>

   <?php include 'components/footer.php'; ?>

   <script src="js/script.js?v=20260612"></script>
</body>

</html>
