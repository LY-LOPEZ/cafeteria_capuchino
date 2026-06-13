<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>productos</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css?v=20260613-cartfix">
   <?php include 'components/tailwind_head.php'; ?>
</head>

<body class="tw-bg-coffee-50 tw-font-sans tw-text-coffee-900">

   <?php include 'components/user_header.php'; ?>

   <div class="heading">
      <h3>productos</h3>
      <p><a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'home' : 'home.php'; ?>">inicio</a> <span> / productos</span></p>
   </div>

   <section class="products tw-mx-auto tw-max-w-[1280px] tw-px-6 tw-py-14">
      <h1 class="title tw-font-sans tw-text-5xl tw-normal-case tw-text-coffee-900">productos disponibles</h1>

      <div class="box-container tw-grid tw-grid-cols-1 tw-gap-8 sm:tw-grid-cols-2 lg:tw-grid-cols-4">
         <?php if (!empty($products)) { ?>
            <?php foreach ($products as $fetch_products) { ?>
               <?php include 'components/product_card.php'; ?>
            <?php } ?>
         <?php } else { ?>
            <p class="empty">aun no se han anadido productos</p>
         <?php } ?>
      </div>
   </section>

   <?php include 'components/footer.php'; ?>

   <script src="js/script.js?v=20260612"></script>
</body>

</html>
