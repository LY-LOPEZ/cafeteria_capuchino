<?php

include '../components/connect.php';
include '../components/order_workflow.php';
include '../components/asset_url.php';
include '../components/order_table_ui.php';

session_start();

$admin_id = $_SESSION['admin_id'] ?? null;

if (!isset($admin_id)) {
   header('location:admin_login.php');
   exit;
}

$current_page = 'placed_orders.php';
$order_search = filter_var($_GET['order_id'] ?? '', FILTER_SANITIZE_NUMBER_INT);

if (isset($_POST['update_payment'])) {
   $order_id = filter_var($_POST['order_id'], FILTER_SANITIZE_NUMBER_INT);
   $payment_status = filter_var($_POST['payment_status'] ?? '', FILTER_SANITIZE_STRING);
   $order_status = filter_var($_POST['order_status'] ?? '', FILTER_SANITIZE_STRING);
   [$payment_status, $order_status] = normalize_order_workflow($payment_status, $order_status);

   $update_status = $conn->prepare("UPDATE `orders` SET payment_status = ?, order_status = ? WHERE id = ?");
   $update_status->execute([$payment_status, $order_status, $order_id]);
   $message[] = 'estado de pago actualizado';
}

if (isset($_GET['delete'])) {
   $delete_id = filter_var($_GET['delete'], FILTER_SANITIZE_NUMBER_INT);
   $delete_items = $conn->prepare("DELETE FROM `order_items` WHERE order_id = ?");
   $delete_items->execute([$delete_id]);
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('location:' . $current_page);
   exit;
}

if ($order_search !== '') {
   $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE id = ? ORDER BY id DESC");
   $select_orders->execute([$order_search]);
} else {
   $select_orders = $conn->prepare("SELECT * FROM `orders` ORDER BY id DESC");
   $select_orders->execute();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>pedidos realizados</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../public/css/dashboard_style.css">
   <link rel="stylesheet" href="../public/css/table.css?v=20260613-mobile">
   <?php include '../components/tailwind_head.php'; ?>
</head>

<body class="tw-bg-coffee-50 tw-font-sans tw-text-coffee-900">

   <?php include '../components/admin_header.php'; ?>

   <section class="placed-orders orders-management tw-mx-auto tw-max-w-[1500px] tw-px-6 tw-py-12">

      <h1 class="heading tw-mb-8 tw-text-center tw-text-4xl tw-font-bold tw-text-coffee-900">pedidos realizados</h1>

      <div class="table_header orders-toolbar tw-mb-5 tw-flex tw-flex-wrap tw-items-center tw-justify-between tw-gap-4 tw-rounded-lg tw-bg-white tw-p-5 tw-shadow-cafe">
         <p class="tw-text-3xl tw-font-bold tw-text-coffee-900">Detalles del Pedido</p>
         <form action="" method="GET" class="orders-search tw-flex tw-flex-wrap tw-gap-3">
            <input class="tw-rounded-md tw-border tw-border-coffee-700/15 tw-bg-coffee-50 tw-px-4 tw-py-3 tw-text-xl" type="number" min="1" name="order_id" value="<?= htmlspecialchars($order_search, ENT_QUOTES, 'UTF-8'); ?>" placeholder="numero de pedido">
            <button class="add_new tw-rounded-md tw-bg-coffee-700 tw-px-5 tw-py-3 tw-text-xl tw-font-bold tw-text-white" type="submit"><i class="fas fa-search"></i> buscar</button>
            <?php if ($order_search !== '') { ?>
               <a href="<?= $current_page; ?>" class="clear-search tw-rounded-md tw-bg-coffee-100 tw-px-5 tw-py-3 tw-text-xl tw-font-bold tw-text-coffee-900">limpiar</a>
            <?php } ?>
         </form>
      </div>

      <div class="orders-table-wrapper tw-overflow-x-auto tw-rounded-lg tw-bg-white tw-p-4 tw-shadow-cafe">
         <table class="table tw-w-full">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>Fecha</th>
                  <th>Nombre</th>
                  <th>Correo</th>
                  <th>Telefono</th>
                  <th>Direccion</th>
                  <th>Productos</th>
                  <th>Precio</th>
                  <th>Tipo Pago</th>
                  <th>Ref. Pago</th>
                  <th>Estado</th>
                  <th>Acciones</th>
               </tr>
            </thead>
            <tbody>
               <?php if ($select_orders->rowCount() > 0) { ?>
                  <?php while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) { ?>
                     <tr>
                        <td data-label="ID"><span class="order-id">#<?= $fetch_orders['id']; ?></span></td>
                        <td data-label="Fecha"><?= $fetch_orders['placed_on']; ?></td>
                        <td data-label="Nombre"><?= $fetch_orders['name']; ?></td>
                        <td data-label="Correo"><?= $fetch_orders['email']; ?></td>
                        <td data-label="Telefono"><?= $fetch_orders['number']; ?></td>
                        <td data-label="Direccion" class="address-cell"><?= $fetch_orders['address']; ?></td>
                        <td data-label="Productos" class="products-cell"><?= $fetch_orders['total_products']; ?></td>
                        <td data-label="Precio"><strong>Bs. <?= $fetch_orders['total_price']; ?></strong></td>
                        <td data-label="Tipo Pago"><?= $fetch_orders['method']; ?></td>
                        <td data-label="Ref. Pago">
                           <span class="payment-reference"><?= $fetch_orders['payment_reference']; ?></span>
                           <?php renderPaymentProofControl($fetch_orders); ?>
                        </td>
                        <td data-label="Estado"><span class="status-pill status-<?= orderStatusClass($fetch_orders['order_status']); ?>"><?= $fetch_orders['order_status']; ?></span></td>
                        <td data-label="Acciones" class="order-actions-cell">
                           <?php renderOrderActionsControl($fetch_orders, $current_page); ?>
                        </td>
                     </tr>
                  <?php } ?>
               <?php } else { ?>
                  <tr>
                     <td colspan="12" class="empty-table">Aun no hay pedidos realizados.</td>
                  </tr>
               <?php } ?>
            </tbody>
         </table>
      </div>

   </section>

   <?php renderOrderProofModalRoot(); ?>

   <script src="../public/js/admin_script.js"></script>
   <script src="../public/js/order_modals.js"></script>

</body>

</html>

