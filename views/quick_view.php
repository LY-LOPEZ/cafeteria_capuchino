<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>vista rapida</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css?v=20260612">
   <?php include 'components/tailwind_head.php'; ?>
</head>

<body class="tw-bg-coffee-50 tw-font-sans tw-text-coffee-900">

   <?php include 'components/user_header.php'; ?>

   <section class="quick-view tw-mx-auto tw-max-w-6xl tw-px-6 tw-py-14">
      <h1 class="title tw-font-sans tw-text-5xl tw-normal-case tw-text-coffee-900">vista rapida</h1>

      <?php if ($product) { ?>
         <form action="" method="post" class="box tw-grid tw-gap-8 tw-rounded-lg tw-bg-white tw-p-8 tw-shadow-cafe lg:tw-grid-cols-[.9fr_1.1fr]">
            <input type="hidden" name="pid" value="<?= $product['id']; ?>">
            <input type="hidden" name="name" value="<?= $product['name']; ?>">
            <input type="hidden" name="price" value="<?= $product['price']; ?>">
            <input type="hidden" name="image" value="<?= $product['image']; ?>">
            <img class="tw-h-[34rem] tw-w-full tw-rounded-md tw-bg-gradient-to-br tw-from-coffee-100 tw-to-white tw-object-contain tw-p-6" src="uploaded_img/<?= $product['image']; ?>" alt="">
            <div class="tw-flex tw-flex-col tw-justify-center">
               <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'category' : 'category.php'; ?>?category=<?= $product['category']; ?>" class="cat tw-mb-4 tw-inline-flex tw-w-fit tw-rounded-full tw-bg-sage/15 tw-px-4 tw-py-2 tw-text-sm tw-font-bold tw-uppercase tw-text-sage"><?= $product['category']; ?></a>
               <div class="name tw-text-5xl tw-font-bold tw-leading-tight tw-text-coffee-900"><?= $product['name']; ?></div>
               <div class="flex tw-mt-6 tw-flex tw-items-center tw-gap-4 tw-border-t tw-border-coffee-700/10 tw-pt-6">
                  <div class="price tw-mr-auto tw-text-5xl tw-font-bold tw-text-coffee-700"><span class="tw-text-2xl tw-text-coffee-500">Bs.</span><?= $product['price']; ?></div>
                  <input type="number" name="qty" class="qty tw-w-28 tw-rounded-md tw-border tw-border-coffee-700/20 tw-bg-coffee-50 tw-p-4 tw-text-center tw-text-2xl" min="1" max="99" value="1" maxlength="2">
               </div>
               <div class="tw-mt-6">
                  <?php renderCartAction($user_id, 'cart-btn tw-inline-flex tw-rounded-md tw-px-10 tw-py-5 tw-text-xl tw-font-bold', 'anadir al carrito'); ?>
               </div>
            </div>
         </form>

         <div class="tw-mt-8 tw-rounded-lg tw-bg-white tw-p-8 tw-text-2xl tw-leading-relaxed tw-text-coffee-900/75 tw-shadow-cafe"><?= $product['desc']; ?></div>
      <?php } else { ?>
         <p class="empty">producto no encontrado</p>
      <?php } ?>
   </section>

   <?php include 'components/footer.php'; ?>

   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
   <script src="js/script.js?v=20260612"></script>
</body>

</html>
