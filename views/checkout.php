<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>pago</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <div class="heading">
      <h3>pago</h3>
      <p><a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'home' : 'home.php'; ?>">inicio</a> <span> / pago</span></p>
   </div>

   <section class="checkout">
      <h1 class="title">resumen del pedido</h1>
      <?php
         $hasField = function ($value) {
            return trim((string)$value) !== '';
         };
         $hasCompleteDeliveryData = $hasField($fetch_profile['address'] ?? '')
            && $hasField($fetch_profile['city'] ?? '')
            && $hasField($fetch_profile['zone'] ?? '')
            && $hasField($fetch_profile['street'] ?? '')
            && $hasField($fetch_profile['home_number'] ?? '')
            && $hasField($fetch_profile['delivery_reference'] ?? '')
            && $hasField($fetch_profile['billing_name'] ?? '')
            && $hasField($fetch_profile['nit_ci'] ?? '');
      ?>

      <form action="" method="post" enctype="multipart/form-data">
         <div class="cart-items">
            <h3>articulos del carrito</h3>
            <?php if (!empty($cartItems)) { ?>
               <?php foreach ($cartItems as $fetch_cart) { ?>
                  <p><span class="name"><?= $fetch_cart['name']; ?></span><span class="price">Bs.<?= $fetch_cart['price']; ?> x <?= $fetch_cart['quantity']; ?></span></p>
               <?php } ?>
            <?php } else { ?>
               <p class="empty">tu carrito esta vacio</p>
            <?php } ?>
            <p class="grand-total"><span class="name">gran total :</span><span class="price">Bs.<?= $grand_total; ?></span></p>
            <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'cart' : 'cart.php'; ?>" class="btn">ver carrito</a>
         </div>

         <div class="user-info">
            <h3>tu informacion</h3>
            <p><i class="fas fa-user"></i><span><?= $fetch_profile['name'] ?? ''; ?></span></p>
            <p><i class="fas fa-phone"></i><span><?= $fetch_profile['number'] ?? ''; ?></span></p>
            <p><i class="fas fa-envelope"></i><span><?= $fetch_profile['email'] ?? ''; ?></span></p>
            <div class="checkout-actions">
               <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'update_profile' : 'update_profile.php'; ?>" class="btn">actualizar informacion</a>
            </div>

            <h3>direccion de entrega</h3>
            <p><i class="fas fa-map-marker-alt"></i><span><?php
               if (($fetch_profile['address'] ?? '') == '') {
                  echo 'por favor ingresa tu direccion';
               } else {
                  echo $fetch_profile['address'];
               }
            ?></span></p>
            <div class="checkout-actions">
               <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'update_address' : 'update_address.php'; ?>" class="btn">actualizar direccion</a>
            </div>

            <h3>pago por QR</h3>
            <div class="checkout-actions">
               <button type="button" class="generate-qr-btn" id="generateQrBtn">generar QR de pago</button>
            </div>
            <div class="qr-payment" id="qrPaymentBox">
               <img src="images/payment-qr.svg" alt="QR de pago generico">
               <p>Escanea el QR, realiza el pago por Bs.<?= $grand_total; ?> y registra la referencia.</p>
            </div>

            <input type="text" name="payment_reference" class="box" required maxlength="100" placeholder="referencia o numero de comprobante QR">
            <input type="file" name="payment_proof" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
            <?php if ($hasCompleteDeliveryData) { ?>
               <input type="submit" value="realizar pedido" class="btn checkout-submit" name="submit">
            <?php } else { ?>
               <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'update_address' : 'update_address.php'; ?>" class="btn checkout-submit">completar direccion</a>
            <?php } ?>
         </div>
      </form>
   </section>

   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>
   <script>
      const generateQrBtn = document.getElementById('generateQrBtn');
      const qrPaymentBox = document.getElementById('qrPaymentBox');

      if (generateQrBtn && qrPaymentBox) {
         generateQrBtn.addEventListener('click', () => {
            qrPaymentBox.classList.add('show');
            generateQrBtn.textContent = 'QR generado';
            generateQrBtn.disabled = true;
         });
      }
   </script>
</body>

</html>
