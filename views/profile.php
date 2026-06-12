<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>perfil</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <section class="user-details">
      <div class="user">
         <img src="images/user-icon.png" alt="">
         <p><i class="fas fa-user"></i><span><span><?= $fetch_profile['name']; ?></span></span></p>
         <p><i class="fas fa-phone"></i><span><?= $fetch_profile['number']; ?></span></p>
         <p><i class="fas fa-envelope"></i><span><?= $fetch_profile['email']; ?></span></p>
         <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'update_profile' : 'update_profile.php'; ?>" class="btn">actualizar informacion</a>
         <p class="address"><i class="fas fa-map-marker-alt"></i><span><?php if ($fetch_profile['address'] == '') { echo 'por favor ingresa tu direccion'; } else { echo $fetch_profile['address']; } ?></span></p>
         <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'update_address' : 'update_address.php'; ?>" class="btn">actualizar direccion</a>
      </div>
   </section>

   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>
</body>

</html>
