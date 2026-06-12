<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>pedido confirmado</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <div class="heading">
      <h3>pedido confirmado</h3>
      <p><a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'home' : 'home.php'; ?>">inicio</a> <span> / confirmacion</span></p>
   </div>

   <section class="order-success">
      <div class="success-card">
         <span class="success-icon"><i class="fas fa-check"></i></span>
         <h1>tu pedido fue registrado</h1>
         <p class="success-number">Pedido #<?= str_pad($fetch_order['id'], 6, '0', STR_PAD_LEFT); ?></p>
         <p>Verificaremos tu pago QR y actualizaremos el estado del pedido.</p>

         <div class="success-grid">
            <div>
               <h3>datos del pedido</h3>
               <p><strong>Total:</strong> Bs.<?= $fetch_order['total_price']; ?></p>
               <p><strong>Pago:</strong> <?= $fetch_order['method']; ?></p>
               <p><strong>Referencia QR:</strong> <?= $fetch_order['payment_reference']; ?></p>
               <p><strong>Estado:</strong> <?= $fetch_order['order_status']; ?></p>
            </div>
            <div>
               <h3>entrega</h3>
               <p><strong>Cliente:</strong> <?= $fetch_order['name']; ?></p>
               <p><strong>Telefono:</strong> <?= $fetch_order['number']; ?></p>
               <p><strong>Direccion:</strong> <?= $fetch_order['address']; ?></p>
               <p><strong>Factura:</strong> <?= $fetch_order['billing_name']; ?> - <?= $fetch_order['nit_ci']; ?></p>
            </div>
         </div>

         <div class="success-items">
            <h3>detalle</h3>
            <?php if (!empty($orderItems)) { ?>
               <?php foreach ($orderItems as $fetch_item) { ?>
                  <p>
                     <span><?= $fetch_item['product_name']; ?> x <?= $fetch_item['quantity']; ?></span>
                     <strong>Bs.<?= $fetch_item['subtotal']; ?></strong>
                  </p>
               <?php } ?>
            <?php } else { ?>
               <p><span><?= $fetch_order['total_products']; ?></span></p>
            <?php } ?>
         </div>

         <div class="success-actions">
            <a href="<?= $whatsapp_link; ?>" class="btn whatsapp-btn" target="_blank"><i class="fab fa-whatsapp"></i> avisar por WhatsApp</a>
            <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'orders' : 'orders.php'; ?>" class="btn">seguir pedido</a>
         </div>
      </div>
   </section>

   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>
</body>

</html>
