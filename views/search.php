<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>busqueda de productos</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <div class="heading">
      <h3>buscar productos</h3>
      <p><a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'home' : 'home.php'; ?>">inicio</a> <span> / buscar</span></p>
   </div>

   <section class="search-form">
      <form method="get" action="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'search' : 'search.php'; ?>">
         <input type="text" name="search_box" value="<?= htmlspecialchars($search_box); ?>" placeholder="buscar productos..." class="box" required>
         <button type="submit" class="fas fa-search" aria-label="buscar productos"></button>
      </form>
   </section>

   <section class="products" style="min-height: 100vh; padding-top:0;">
      <div class="box-container">
         <?php if ($search_box === '') { ?>
            <p class="empty">escribe el nombre de un producto para buscar</p>
         <?php } elseif (!empty($products)) { ?>
            <?php foreach ($products as $fetch_products) { ?>
               <form action="" method="post" class="box">
                  <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                  <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                  <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                  <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
                  <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'quick_view' : 'quick_view.php'; ?>?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
                  <?php renderCartAction($user_id); ?>
                  <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                  <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'category' : 'category.php'; ?>?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
                  <div class="name"><?= $fetch_products['name']; ?></div>
                  <div class="flex">
                     <div class="price"><span>Bs.</span><?= $fetch_products['price']; ?></div>
                     <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                  </div>
               </form>
            <?php } ?>
         <?php } else { ?>
            <p class="empty">no se encontraron productos con esa busqueda</p>
         <?php } ?>
      </div>
   </section>

   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>
</body>

</html>
