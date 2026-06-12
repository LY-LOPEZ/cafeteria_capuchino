<?php

include '../components/connect.php';
include '../components/order_workflow.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
};

if (isset($_POST['update_payment'])) {

   $order_id = $_POST['order_id'];
   $payment_status = $_POST['payment_status'];
   $order_status = $_POST['order_status'];
   [$payment_status, $order_status] = normalize_order_workflow($payment_status, $order_status);
   $update_status = $conn->prepare("UPDATE `orders` SET payment_status = ?, order_status = ? WHERE id = ?");
   $update_status->execute([$payment_status, $order_status, $order_id]);
   $message[] = '¡estado de pago actualizado!';
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_items = $conn->prepare("DELETE FROM `order_items` WHERE order_id = ?");
   $delete_items->execute([$delete_id]);
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('location:placed_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>pedidos realizados</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/dashboard_style.css">
   <link rel="stylesheet" href="../css/table.css">


</head>

<body>

   <?php include '../components/admin_header.php' ?>

   <!-- placed orders section starts  -->

   <section class="placed-orders">

      <h1 class="heading">pedidos realizados</h1>

      <div class="table_header">
         <p>Detalles del Pedido</p>
         <div>
            <input placeholder="número de pedido">
            <button class="add_new">buscar</button>
         </div>
      </div>

      <div>
         <table class="table">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>Fecha</th>
                  <th>Nombre</th>
                  <th>Correo</th>
                  <th>Teléfono</th>
                  <th>Dirección</th>
                  <th>productos</th>
                  <th>Precio</th>
                  <th>TipoPago</th>
                  <th>RefPago</th>
                  <th>EstadoPedido</th>
                  <th>Acción</th>
               </tr>
            </thead>
            <tbody>
               <?php
               $select_orders = $conn->prepare("SELECT * FROM `orders` where payment_status='pending'");
               $select_orders->execute();
               if ($select_orders->rowCount() > 0) {
                  while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
               ?>
                     <tr>
                        <td><?= $fetch_orders['user_id']; ?></td>
                        <td><?= $fetch_orders['placed_on']; ?></td>
                        <td><?= $fetch_orders['name']; ?></td>
                        <td><?= $fetch_orders['email']; ?></td>
                        <td><?= $fetch_orders['number']; ?></span></td>
                        <td><?= $fetch_orders['address']; ?></td>
                        <td><?= $fetch_orders['total_products']; ?></td>
                        <td><?= $fetch_orders['total_price']; ?></td>
                        <td><?= $fetch_orders['method']; ?></td>
                        <td>
                           <?= $fetch_orders['payment_reference']; ?>
                           <?php if ($fetch_orders['payment_proof'] != '') { ?>
                              <br><a href="../uploaded_img/<?= $fetch_orders['payment_proof']; ?>" target="_blank">comprobante</a>
                           <?php } ?>
                        </td>
                        <td><?= $fetch_orders['order_status']; ?></td>
                        <td>
                           <form action="" method="POST">
                              <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
                              <select name="payment_status" class="drop-down">
                                 <option value="" selected disabled><?= $fetch_orders['payment_status']; ?></option>
                                 <option value="pending">pendiente</option>
                                 <option value="completed">aprobado</option>
                                 <option value="rejected">rechazado</option>
                              </select>
                              <select name="order_status" class="drop-down">
                                 <option selected value="<?= $fetch_orders['order_status']; ?>"><?= $fetch_orders['order_status']; ?></option>
                                 <option value="pendiente de verificacion">pendiente de verificacion</option>
                                 <option value="pendiente">pendiente</option>
                                 <option value="preparando">preparando</option>
                                 <option value="listo">listo</option>
                                 <option value="en camino">en camino</option>
                                 <option value="entregado">entregado</option>
                                 <option value="cancelado">cancelado</option>
                              </select>
                              <div class="flex-btn">
                                 <input type="submit" value="actualizar" class="btn" name="update_payment">
                                 <?php if (can_generate_invoice($fetch_orders)) { ?>
                                    <a href="invoice.php?id=<?= $fetch_orders['id']; ?>" class="option-btn">factura</a>
                                 <?php } ?>
                                 <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('¿eliminar este pedido?');">eliminar</a>
                              </div>
                           </form>
                        </td>
                     </tr>
               <?php
                  }
               } else {
                  echo '<p class="empty">¡aún no hay pedidos realizados!</p>';
               }
               ?>
            </tbody>
         </table>
      </div>



   </section>

   <!-- placed orders section ends -->

   <!-- custom js file link  -->
   <script src="../js/admin_script.js"></script>

</body>

</html>
