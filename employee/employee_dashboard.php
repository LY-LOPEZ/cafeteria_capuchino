<?php

include '../components/connect.php';

session_start();

$employee_id = $_SESSION['employee_id'];

if (!isset($employee_id)) {
   header('location:employee_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Panel del Empleado</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../public/css/nav.css">
   <link rel="stylesheet" href="../public/css/dashboard_style.css">
   <?php include '../components/tailwind_head.php'; ?>

</head>

<body class="tw-bg-coffee-50 tw-font-sans tw-text-coffee-900">

   <?php include '../components/employee_header.php' ?>

   <!-- employee dashboard section starts  -->
   <div class="container">

      <section class="dashboard tw-px-6 tw-py-8">

         <h1 class="heading tw-mb-8 tw-text-center tw-text-4xl tw-font-bold tw-text-coffee-900" style="text-align: center; margin-top:3rem">PANEL </h1>
         <section class="dashboard">

            <div class="box-container tw-mx-auto tw-max-w-3xl">

               <div class="box tw-rounded-lg tw-bg-white tw-p-8 tw-text-center tw-shadow-cafe">
                  <h3 class="tw-text-3xl tw-font-bold tw-text-coffee-900">¡bienvenido!</h3>
                  <p class="tw-mt-3 tw-text-2xl tw-text-coffee-700"><?= $fetch_profile['name']; ?></p>

               </div>

            </div>

         </section>
         <div class="cardBox tw-grid tw-gap-6 md:tw-grid-cols-2 xl:tw-grid-cols-5">

            <div class="card tw-rounded-lg tw-bg-white tw-p-6 tw-shadow-cafe">
               <?php
               $select_orders = $conn->prepare("SELECT * FROM `orders`");
               $select_orders->execute();
               $numbers_of_orders = $select_orders->rowCount();
               ?>
               <div>
                  <div class="numbers"><?= $numbers_of_orders; ?></div>
                  <div class="cardName">total de pedidos</div>
               </div>

               <div class="iconBx">
                  <a href="placed_orders.php">
                     <ion-icon name="grid-outline"></ion-icon>
                  </a>
               </div>
            </div>

            <div class="card tw-rounded-lg tw-bg-white tw-p-6 tw-shadow-cafe">
               <?php
               $total_pendings = 0;
               $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
               $select_pendings->execute(['pending']);
               while ($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)) {
                  $total_pendings += $fetch_pendings['total_price'];
               }
               ?>
               <div>
                  <div class="numbers"><span>Bs.</span><?= $total_pendings; ?><span>/-</span></div>
                  <div class="cardName">total pendientes</div>
               </div>

               <div class="iconBx">
                  <a href="placed_orders.php">
                     <ion-icon name="wallet-outline"></ion-icon>
                  </a>
               </div>
            </div>

            <div class="card tw-rounded-lg tw-bg-white tw-p-6 tw-shadow-cafe">
               <?php
               $total_completes = 0;
               $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
               $select_completes->execute(['completed']);
               while ($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)) {
                  $total_completes += $fetch_completes['total_price'];
               }
               ?>
               <div>
                  <div class="numbers"><span>Bs.</span><?= $total_completes; ?><span>/-</span></div>
                  <div class="cardName">total completados</div>
               </div>

               <div class="iconBx">
                  <a href="placed_orders.php" class="ho">
                     <ion-icon name="wallet-outline"></ion-icon>
                  </a>
               </div>
            </div>

            <div class="card tw-rounded-lg tw-bg-white tw-p-6 tw-shadow-cafe">
               <?php
               $select_orders = $conn->prepare("SELECT * FROM `orders`");
               $select_orders->execute();
               $numbers_of_orders = $select_orders->rowCount();
               ?>
               <div>
                  <div class="numbers"><span>Bs.</span><?= $total_completes + $total_pendings; ?><span>/-</span></div>
                  <div class="cardName">total de pedidos</div>
               </div>

               <div class="iconBx">
                  <a href="placed_orders.php">
                     <ion-icon name="wallet-outline"></ion-icon>
                  </a>
               </div>
            </div>

            <div class="card tw-rounded-lg tw-bg-white tw-p-6 tw-shadow-cafe">
               <?php
               $select_products = $conn->prepare("SELECT * FROM `products`");
               $select_products->execute();
               $numbers_of_products = $select_products->rowCount();
               ?>
               <div>
                  <div class="numbers"><?= $numbers_of_products; ?></div>
                  <div class="cardName">productos añadidos</div>
               </div>

               <div class="iconBx">
                  <a href="products.php">
                     <ion-icon name="grid-outline"></ion-icon>
                  </a>
               </div>
            </div>

         </div>

   </div>
   </div>

   <!-- employee dashboard section ends -->

   <!-- custom js file link  -->
   <script src="../public/js/employee_script.js"></script>
   <script src="../public/js/nav.js"></script>

   <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
   <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
