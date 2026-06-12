<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_message = $conn->prepare("DELETE FROM `messages` WHERE id = ?");
   $delete_message->execute([$delete_id]);
   header('location:messages.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>mensajes</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/dashboard_style.css">
   <link rel="stylesheet" href="../css/table.css">

</head>

<body>

   <?php include '../components/admin_header.php' ?>

   <!-- messages section starts  -->

   <section class="messages">

      <h1 class="heading">gestión de mensajes</h1>

      <div class="table_header">
         <p>Detalles del Mensaje</p>
         <div>
            <input placeholder="nombre del cliente">
            <button class="add_new">buscar</button>
         </div>
      </div>

      </div>
      <div>
         <table class="table">
            <thead>
               <tr>
                  <th>Nombre</th>
                  <th>Número</th>
                  <th>correo</th>
                  <th>mensaje</th>
                  <th>Acción</th>
               </tr>
            </thead>
            <tbody>
               <?php
               $select_messages = $conn->prepare("SELECT * FROM `messages`");
               $select_messages->execute();
               if ($select_messages->rowCount() > 0) {
                  while ($fetch_messages = $select_messages->fetch(PDO::FETCH_ASSOC)) {
               ?>
                     <tr>
                        <td><span><?= $fetch_messages['name']; ?></span></td>
                        <td><span><?= $fetch_messages['number']; ?></span></td>
                        <td><span><?= $fetch_messages['email']; ?></span></td>
                        <td><span><?= $fetch_messages['message']; ?></span></td>
                        <td><a href="messages.php?delete=<?= $fetch_messages['id']; ?>" onclick="return confirm('¿eliminar este mensaje?');"><button><i class="fa-solid fa-trash"></i></button></a></td>
                     </tr>
               <?php
                  }
               } else {
                  echo '<p class="empty">no tienes mensajes</p>';
               }
               ?>
            </tbody>
         </table>
      </div>

   </section>

   <!-- messages section ends -->

   <!-- custom js file link  -->
   <script src="../js/admin_script.js"></script>

</body>

</html>