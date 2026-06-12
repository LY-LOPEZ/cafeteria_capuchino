<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>vista rapida</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <section class="quick-view">
      <h1 class="title">vista rapida</h1>

      <?php if ($product) { ?>
         <form action="" method="post" class="box">
            <input type="hidden" name="pid" value="<?= $product['id']; ?>">
            <input type="hidden" name="name" value="<?= $product['name']; ?>">
            <input type="hidden" name="price" value="<?= $product['price']; ?>">
            <input type="hidden" name="image" value="<?= $product['image']; ?>">
            <img src="uploaded_img/<?= $product['image']; ?>" alt="">
            <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'category' : 'category.php'; ?>?category=<?= $product['category']; ?>" class="cat"><?= $product['category']; ?></a>
            <div class="name"><?= $product['name']; ?></div>
            <div class="flex">
               <div class="price"><span>Bs.</span><?= $product['price']; ?></div>
               <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
            </div>
            <button type="submit" name="add_to_cart" class="cart-btn">anadir al carrito</button>
         </form>

         <div style="padding: 0 150px; font-size: 20px;"><?= $product['desc']; ?></div>
      <?php } else { ?>
         <p class="empty">producto no encontrado</p>
      <?php } ?>
   </section>

   <?php include 'components/footer.php'; ?>

   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
   <script src="js/script.js"></script>
</body>

</html>
