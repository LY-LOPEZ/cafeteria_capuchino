<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>pedidos</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <div class="heading">
      <h3>pedidos</h3>
      <p><a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'home' : 'home.php'; ?>">inicio</a> <span> / pedidos</span></p>
   </div>

   <section class="orders">
      <h1 class="title">tus pedidos</h1>

      <div class="box-container">
         <?php if (!empty($orders)) { ?>
            <?php foreach ($orders as $fetch_orders) { ?>
               <?php
                  $order_status = $fetch_orders['order_status'] ?? 'pendiente';
                  $is_payment_approved = $fetch_orders['payment_status'] == 'completed';
                  $is_delivered = $is_payment_approved && $order_status == 'entregado';
                  $current_step = array_search($order_status, $tracking_steps);
                  if ($current_step === false) {
                     $current_step = -1;
                  }
               ?>
               <div class="box">
                  <p>realizado el : <span><?= $fetch_orders['placed_on']; ?></span></p>
                  <p>nombre : <span><?= $fetch_orders['name']; ?></span></p>
                  <p>correo : <span><?= $fetch_orders['email']; ?></span></p>
                  <p>numero : <span><?= $fetch_orders['number']; ?></span></p>
                  <p>direccion : <span><?= $fetch_orders['address']; ?></span></p>
                  <p>metodo de pago : <span><?= $fetch_orders['method']; ?></span></p>
                  <p>tus pedidos : <span><?= $fetch_orders['total_products']; ?></span></p>
                  <p>precio total : <span>Bs.<?= $fetch_orders['total_price']; ?>/-</span></p>
                  <p>estado del pago : <span style="color:<?= ($fetch_orders['payment_status'] == 'pending') ? 'red' : (($fetch_orders['payment_status'] == 'rejected') ? 'red' : 'green'); ?>"><?= $fetch_orders['payment_status']; ?></span></p>
                  <p>estado del pedido : <span><?= $order_status; ?></span></p>

                  <?php if ($is_payment_approved) { ?>
                     <div class="order-tracker <?= $order_status == 'cancelado' ? 'cancelled' : ''; ?>">
                        <?php foreach ($tracking_steps as $index => $step) { ?>
                           <div class="track-step <?= $index <= $current_step ? 'active' : ''; ?>">
                              <span><?= $index + 1; ?></span>
                              <p><?= $step; ?></p>
                           </div>
                        <?php } ?>
                     </div>
                  <?php } else { ?>
                     <p class="empty">tu pedido esta pendiente de verificacion del pago QR</p>
                  <?php } ?>

                  <div class="order-actions">
                     <?php if ($is_delivered) { ?>
                        <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'invoice' : 'invoice.php'; ?>?id=<?= $fetch_orders['id']; ?>" class="btn">ver factura</a>
                        <form action="" method="post">
                           <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
                           <button type="submit" name="delete_order" class="delete-btn" onclick="return confirm('eliminar este pedido entregado?');">eliminar pedido</button>
                        </form>
                     <?php } else { ?>
                        <span class="btn disabled">factura al entregar</span>
                     <?php } ?>
                  </div>
               </div>
            <?php } ?>
         <?php } else { ?>
            <p class="empty">aun no hay pedidos realizados</p>
         <?php } ?>
      </div>
   </section>

   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>
</body>

</html>
