<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>busqueda de productos</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css?v=20260613-cartfix">
   <?php include 'components/tailwind_head.php'; ?>
</head>

<body class="tw-bg-coffee-50 tw-font-sans tw-text-coffee-900">

   <?php include 'components/user_header.php'; ?>

   <div class="heading">
      <h3>buscar productos</h3>
      <p><a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'home' : 'home.php'; ?>">inicio</a> <span> / buscar</span></p>
   </div>

   <section class="search-form tw-mx-auto tw-max-w-5xl tw-px-6 tw-py-10">
      <form class="tw-flex tw-overflow-hidden tw-rounded-lg tw-bg-white tw-p-3 tw-shadow-cafe" method="get" action="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'search' : 'search.php'; ?>">
         <input type="text" name="search_box" value="<?= htmlspecialchars($search_box); ?>" placeholder="buscar productos..." class="box tw-min-w-0 tw-flex-1 tw-rounded-md tw-bg-coffee-50 tw-px-5 tw-py-4 tw-text-2xl tw-text-coffee-900" required>
         <button type="submit" class="fas fa-search tw-ml-3 tw-grid tw-h-16 tw-w-16 tw-place-items-center tw-rounded-md tw-bg-coffee-700 tw-text-3xl tw-text-white" aria-label="buscar productos"></button>
      </form>
   </section>

   <section class="products tw-mx-auto tw-max-w-[1280px] tw-px-6 tw-pb-16 tw-pt-0" style="min-height: 100vh;">
      <div class="box-container tw-grid tw-grid-cols-1 tw-gap-8 sm:tw-grid-cols-2 lg:tw-grid-cols-4">
         <?php if ($search_box === '') { ?>
            <p class="empty">escribe el nombre de un producto para buscar</p>
         <?php } elseif (!empty($products)) { ?>
            <?php foreach ($products as $fetch_products) { ?>
               <?php include 'components/product_card.php'; ?>
            <?php } ?>
         <?php } else { ?>
            <p class="empty">no se encontraron productos con esa busqueda</p>
         <?php } ?>
      </div>
   </section>

   <?php include 'components/footer.php'; ?>

   <script src="js/script.js?v=20260612"></script>
</body>

</html>
