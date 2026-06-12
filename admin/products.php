<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
};

if (isset($_POST['add_product'])) {

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../public/uploaded_img/' . $image;

   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_products->execute([$name]);

   if ($select_products->rowCount() > 0) {
      $message[] = '¡el nombre del producto ya existe!';
   } else {
      if ($image_size > 2000000) {
         $message[] = 'el tamaño de la imagen es demasiado grande';
      } else {
         move_uploaded_file($image_tmp_name, $image_folder);

         $insert_product = $conn->prepare("INSERT INTO `products`(name, category, price, image) VALUES(?,?,?,?)");
         $insert_product->execute([$name, $category, $price, $image]);

         $message[] = '¡nuevo producto añadido!';
      }
   }
}

if (isset($_GET['delete'])) {

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   if ($fetch_delete_image && file_exists('../public/uploaded_img/' . $fetch_delete_image['image'])) {
      unlink('../public/uploaded_img/' . $fetch_delete_image['image']);
   }
   $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   header('location:products.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>productos</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../public/css/table.css?v=20260612">
   <link rel="stylesheet" href="../public/css/dashboard_style.css?v=20260612-panel3">
   <?php include '../components/tailwind_head.php'; ?>

</head>

<body class="tw-bg-coffee-50 tw-font-sans tw-text-coffee-900">

   <?php include '../components/admin_header.php' ?>

   <!-- add products section starts  -->

   <section class="add-products panel-products tw-mx-auto tw-max-w-6xl tw-px-6 tw-py-12">

      <form class="panel-product-form tw-rounded-lg tw-bg-white tw-p-8 tw-shadow-cafe" action="" method="POST" enctype="multipart/form-data">
         <h3 class="tw-mb-2 tw-text-center tw-text-4xl tw-font-bold tw-text-coffee-900">Añadir Producto</h3>
         <p class="tw-mb-8 tw-text-center tw-text-xl tw-text-coffee-900/60">Registra productos nuevos para el menú de la cafetería.</p>
         <div class="panel-product-grid">
         <input type="text" required placeholder="ingresa el nombre del producto" name="name" maxlength="100" class="panel-field">
         <input type="number" min="0" max="9999999999" required placeholder="ingresa el precio del producto" name="price" onkeypress="if(this.value.length == 10) return false;" class="panel-field">
         <select name="category" class="panel-field" required>
            <option value="" disabled selected>selecciona categoría --</option>
            <option value="coffee"> café</option>
            <option value="fast food">comida rápida</option>
            <option value="drinks">bebidas</option>
            <option value="desserts">postres</option>
         </select>
         <input type="file" name="image" class="panel-field panel-file-field" accept="image/jpg, image/jpeg, image/png, image/webp" required>
         </div>
         <input type="submit" value="Añadir Producto" name="add_product" class="panel-primary-action panel-submit">
      </form>

   </section>

   <!-- add products section ends -->

   <!-- show products section starts  -->

   <section class="show-products panel-products tw-mx-auto tw-max-w-7xl tw-px-6 tw-pb-16" style="padding-top: 0;">

      <div class="panel-table-toolbar tw-mb-5 tw-flex tw-flex-wrap tw-items-center tw-justify-between tw-gap-4 tw-rounded-lg tw-bg-white tw-p-5 tw-shadow-cafe">
         <p class="tw-text-3xl tw-font-bold tw-text-coffee-900">Detalles del Producto</p>
         <div class="panel-toolbar-search">
            <input class="panel-search-field" id="productTableSearch" placeholder="nombre del producto">
            <button class="panel-search-action" type="button" id="productTableSearchBtn">buscar</button>
         </div>
      </div>

      <div class="panel-table-card tw-overflow-x-auto tw-rounded-lg tw-bg-white tw-p-4 tw-shadow-cafe">
         <table class="panel-table tw-w-full" id="productsTable">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>Foto</th>
                  <th>nombre</th>
                  <th>precio</th>
                  <th>categoría</th>
                  <th>Acción</th>
               </tr>
            </thead>
            <tbody>
               <?php
               $show_products = $conn->prepare("SELECT * FROM `products`");
               $show_products->execute();
               if ($show_products->rowCount() > 0) {
                  while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {
               ?>
                     <tr>
                        <td><?= $fetch_products['id']; ?></td>
                        <td><img class="tw-h-20 tw-w-20 tw-rounded-md tw-bg-coffee-50 tw-object-contain tw-p-2" src="../public/uploaded_img/<?= $fetch_products['image']; ?>" alt=""></td>
                        <td><?= $fetch_products['name']; ?></td>
                        <td><span>Bs.</span><?= $fetch_products['price']; ?><span></td>
                        <td><?= $fetch_products['category']; ?></td>


                        <td>
                           <a href="update_product.php?update=<?= $fetch_products['id']; ?>"><button class="tw-rounded-md tw-bg-sage tw-px-3 tw-py-2 tw-text-white"><i class="fa-solid fa-pen-to-square"></i></button></a>
                           <a href="products.php?delete=<?= $fetch_products['id']; ?>" onclick="return confirm('¿eliminar este producto?');"><button class="tw-rounded-md tw-bg-red-600 tw-px-3 tw-py-2 tw-text-white"><i class="fa-solid fa-trash"></i></button></a>
                        </td>
                     </tr>

               <?php
                  }
               } else {
                  echo '<p class="empty">¡aún no se han añadido productos!</p>';
               }
               ?>
            </tbody>
         </table>
      </div>

   </section>

   <!-- show products section ends -->

   <!-- custom js file link  -->
   <script src="../public/js/admin_script.js"></script>
   <script src="../public/js/product_table_search.js?v=20260612"></script>

</body>

</html>

