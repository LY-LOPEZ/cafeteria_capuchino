<?php include 'components/asset_url.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Factura #<?= $fetch_order['id']; ?></title>
   <link rel="stylesheet" href="css/invoice.css">
</head>

<body>
   <main class="invoice">
      <header class="invoice-header">
         <div>
            <h1>Coffee Shop</h1>
            <p>Factura / Comprobante de pedido</p>
         </div>
         <div class="invoice-number">
            <span>Nro.</span>
            <strong>#<?= str_pad($fetch_order['id'], 6, '0', STR_PAD_LEFT); ?></strong>
         </div>
      </header>

      <section class="invoice-grid">
         <div>
            <h2>Cliente</h2>
            <p><strong>Nombre:</strong> <?= $fetch_order['name']; ?></p>
            <p><strong>Telefono:</strong> <?= $fetch_order['number']; ?></p>
            <p><strong>Correo:</strong> <?= $fetch_order['email']; ?></p>
            <p><strong>Direccion:</strong> <?= $fetch_order['address']; ?></p>
            <p><strong>Nombre factura:</strong> <?= $fetch_order['billing_name']; ?></p>
            <p><strong>NIT/CI:</strong> <?= $fetch_order['nit_ci']; ?></p>
         </div>
         <div>
            <h2>Pedido</h2>
            <p><strong>Fecha:</strong> <?= $fetch_order['placed_on']; ?></p>
            <p><strong>Metodo de pago:</strong> <?= $fetch_order['method']; ?></p>
            <p><strong>Referencia QR:</strong> <?= $fetch_order['payment_reference']; ?></p>
            <?php if ($fetch_order['payment_proof'] != '') { ?>
               <p><strong>Comprobante:</strong> <a href="<?= publicAssetUrl('uploaded_img/' . $fetch_order['payment_proof']); ?>" target="_blank">ver imagen</a></p>
            <?php } ?>
            <p><strong>Estado:</strong> <?= $fetch_order['payment_status']; ?></p>
            <p><strong>Seguimiento:</strong> <?= $fetch_order['order_status']; ?></p>
         </div>
      </section>

      <section class="invoice-items">
         <h2>Detalle</h2>
         <div class="items-box">
            <?php if (!empty($orderItems)) { ?>
               <?php foreach ($orderItems as $fetch_item) { ?>
                  <p><?= $fetch_item['product_name']; ?> (<?= $fetch_item['price']; ?> x <?= $fetch_item['quantity']; ?>) - Bs.<?= $fetch_item['subtotal']; ?></p>
               <?php } ?>
            <?php } else { ?>
               <?= $fetch_order['total_products']; ?>
            <?php } ?>
         </div>
      </section>

      <section class="invoice-total">
         <span>Total</span>
         <strong>Bs.<?= $fetch_order['total_price']; ?></strong>
      </section>

      <div class="invoice-actions">
         <button onclick="window.print()">Imprimir</button>
         <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'orders' : 'orders.php'; ?>">Volver</a>
      </div>
   </main>
</body>

</html>
