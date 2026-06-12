<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>pedidos</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css?v=20260612-orders2">
   <?php include 'components/tailwind_head.php'; ?>
</head>

<body class="tw-bg-coffee-50 tw-font-sans tw-text-coffee-900">

   <?php include 'components/user_header.php'; ?>

   <div class="heading">
      <h3>pedidos</h3>
      <p><a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'home' : 'home.php'; ?>">inicio</a> <span> / pedidos</span></p>
   </div>

   <section class="orders customer-orders">
      <h1 class="title">tus pedidos</h1>

      <div class="box-container customer-orders-grid">
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
               <article class="box customer-order-card">
                  <div class="customer-order-head">
                     <div>
                        <span class="order-kicker">Pedido #<?= $fetch_orders['id']; ?></span>
                        <h3><?= $fetch_orders['total_products']; ?></h3>
                        <p>Realizado el <?= $fetch_orders['placed_on']; ?></p>
                     </div>
                     <div class="order-total-pill">Bs.<?= $fetch_orders['total_price']; ?></div>
                  </div>

                  <div class="customer-order-meta">
                     <div><span>Cliente</span><strong><?= $fetch_orders['name']; ?></strong></div>
                     <div><span>Correo</span><strong><?= $fetch_orders['email']; ?></strong></div>
                     <div><span>Número</span><strong><?= $fetch_orders['number']; ?></strong></div>
                     <div><span>Método de pago</span><strong><?= $fetch_orders['method']; ?></strong></div>
                     <div class="wide"><span>Dirección</span><strong><?= $fetch_orders['address']; ?></strong></div>
                  </div>

                  <div class="customer-order-status">
                     <div>
                        <span>Estado del pago</span>
                        <strong class="<?= $fetch_orders['payment_status'] == 'completed' ? 'is-ok' : 'is-alert'; ?>"><?= $fetch_orders['payment_status']; ?></strong>
                     </div>
                     <div>
                        <span>Estado del pedido</span>
                        <strong><?= $order_status; ?></strong>
                     </div>
                  </div>

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

                  <div class="order-actions customer-order-actions">
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
               </article>
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
