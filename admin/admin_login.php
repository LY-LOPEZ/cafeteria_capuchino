<?php

include '../components/connect.php';

session_start();

if (isset($_POST['submit'])) {

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE name = ? AND password = ?");
   $select_admin->execute([$name, $pass]);

   if ($select_admin->rowCount() > 0) {
      $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
      $_SESSION['admin_id'] = $fetch_admin_id['id'];
      header('location:dashboard.php');
   } else {
      $message[] = '&iexcl;usuario o contrase&ntilde;a incorrectos!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Inicio de sesi&oacute;n de Admin</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../public/css/custom_login.css">
   <?php include '../components/tailwind_head.php'; ?>

</head>

<body class="tw-bg-coffee-50 tw-font-sans tw-text-coffee-900">

   <?php
   if (isset($message)) {
      foreach ($message as $message) {
         echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
      }
   }
   ?>

   <!-- admin login form section starts  -->

   <section class="box tw-mx-auto tw-flex tw-min-h-screen tw-max-w-3xl tw-items-center tw-justify-center tw-px-6 tw-py-16">

      <form class="tw-w-full tw-rounded-lg tw-bg-white tw-p-8 tw-shadow-cafe" action="" method="POST">
         <h1 class="tw-mb-8 tw-text-center tw-text-4xl tw-font-bold tw-text-coffee-900">Inicio de sesi&oacute;n de Admin</h1>
         <ul class="tw-grid tw-gap-5">
            <li><label class="tw-text-2xl tw-font-bold tw-text-coffee-900" for="name">Nombre de usuario</label></li>
            <li><input class="tw-w-full tw-rounded-md tw-border tw-border-coffee-700/15 tw-bg-coffee-50 tw-p-5 tw-text-2xl" type="text" name="name" maxlength="20" required placeholder="" oninput="this.value = this.value.replace(/\s/g, '')"></li>
            <li><label class="tw-text-2xl tw-font-bold tw-text-coffee-900" for="name">Contrase&ntilde;a</label></li>
            <li><input class="tw-w-full tw-rounded-md tw-border tw-border-coffee-700/15 tw-bg-coffee-50 tw-p-5 tw-text-2xl" type="password" name="pass" maxlength="20" required placeholder="" oninput="this.value = this.value.replace(/\s/g, '')"></li>
         </ul>
         <label for="name"></label>
         <input type="submit" value="iniciar sesi&oacute;n ahora" name="submit" class="button tw-mt-6 tw-w-full tw-rounded-md tw-bg-coffee-700 tw-px-8 tw-py-5 tw-text-xl tw-font-bold tw-text-white">
      </form>

   </section>

   <!-- admin login form section ends -->

</body>

</html>
