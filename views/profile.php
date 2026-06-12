<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>perfil</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css?v=20260612">
   <?php include 'components/tailwind_head.php'; ?>
</head>

<body class="tw-bg-coffee-50 tw-font-sans tw-text-coffee-900">

   <?php include 'components/user_header.php'; ?>

   <section class="user-details tw-mx-auto tw-max-w-4xl tw-px-6 tw-py-16">
      <div class="user tw-rounded-lg tw-bg-white tw-p-8 tw-text-center tw-shadow-cafe">
         <img class="tw-mx-auto tw-h-36 tw-w-36 tw-rounded-full tw-bg-coffee-50 tw-object-contain tw-p-5" src="images/user-icon.png" alt="">
         <div class="tw-mt-8 tw-grid tw-gap-4 tw-text-left">
            <p class="tw-rounded-md tw-bg-coffee-50 tw-p-5 tw-text-2xl"><i class="fas fa-user tw-mr-3 tw-text-coffee-700"></i><span><span><?= $fetch_profile['name']; ?></span></span></p>
            <p class="tw-rounded-md tw-bg-coffee-50 tw-p-5 tw-text-2xl"><i class="fas fa-phone tw-mr-3 tw-text-coffee-700"></i><span><?= $fetch_profile['number']; ?></span></p>
            <p class="tw-rounded-md tw-bg-coffee-50 tw-p-5 tw-text-2xl"><i class="fas fa-envelope tw-mr-3 tw-text-coffee-700"></i><span><?= $fetch_profile['email']; ?></span></p>
         </div>
         <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'update_profile' : 'update_profile.php'; ?>" class="btn tw-mt-6 tw-inline-flex tw-rounded-md tw-px-8 tw-py-4 tw-text-xl tw-font-bold">actualizar informacion</a>
         <p class="address tw-mt-8 tw-rounded-md tw-bg-coffee-50 tw-p-5 tw-text-left tw-text-2xl"><i class="fas fa-map-marker-alt tw-mr-3 tw-text-coffee-700"></i><span><?php if ($fetch_profile['address'] == '') { echo 'por favor ingresa tu direccion'; } else { echo $fetch_profile['address']; } ?></span></p>
         <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'update_address' : 'update_address.php'; ?>" class="btn tw-mt-6 tw-inline-flex tw-rounded-md tw-px-8 tw-py-4 tw-text-xl tw-font-bold">actualizar direccion</a>
      </div>
   </section>

   <?php include 'components/footer.php'; ?>

   <script src="js/script.js?v=20260612"></script>
</body>

</html>
