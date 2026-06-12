<?php

include '../components/connect.php';

session_start();

$employee_id = $_SESSION['employee_id'];

if (!isset($employee_id)) {
   header('location:employee_login.php');
};

if (isset($_POST['add_product'])) {

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);
   $desc = $_POST['desc'];
   $desc = filter_var($desc, FILTER_SANITIZE_STRING);

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
   <link rel="stylesheet" href="../public/css/dashboard_style.css">
   <link rel="stylesheet" href="../public/css/table.css">

</head>

<body>

   <?php include '../components/employee_header.php' ?>

   <!-- add products section starts  -->

   <section class="add-products">

      <form action="" method="POST" enctype="multipart/form-data">
         <h3>añadir producto</h3>
         <input type="text" required placeholder="ingresa el nombre del producto" name="name" maxlength="100" class="box">
         <input type="number" min="0" max="9999999999" required placeholder="ingresa el precio del producto" name="price" onkeypress="if(this.value.length == 10) return false;" class="box">
         <select name="category" class="box" required>
            <option value="" disabled selected>selecciona categoría --</option>
            <option value="coffee"> café</option>
            <option value="fast food">comida rápida</option>
            <option value="drinks">bebidas</option>
            <option value="desserts">postres</option>
         </select>
         <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
         <input type="submit" value="añadir producto" name="add_product" class="btn">
      </form>

   </section>

   <!-- add products section ends -->

   <!-- show products section starts  -->

   <section class="show-products" style="padding-top: 0;">

      <div class="table_header">
         <p>Detalles del Producto</p>
         <div>
            <input placeholder="nombre del producto">
            <button class="add_new">buscar</button>
         </div>
      </div>

      </div>
      <div>
         <table class="table">
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
                        <td><img style="height: 60px;" src="../public/uploaded_img/<?= $fetch_products['image']; ?>" alt=""></td>
                        <td><?= $fetch_products['name']; ?></td>
                        <td><span>Bs.</span><?= $fetch_products['price']; ?><span></td>
                        <td><?= $fetch_products['category']; ?></td>


                        <td>
                           <a href="update_product.php?update=<?= $fetch_products['id']; ?>"><button><i class="fa-solid fa-pen-to-square"></i></button></a>
                           <a href="products.php?delete=<?= $fetch_products['id']; ?>" onclick="return confirm('¿eliminar este producto?');"><button><i class="fa-solid fa-trash"></i></button></a>
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
   <script src="../public/js/employee_script.js"></script>

</body>

</html>
