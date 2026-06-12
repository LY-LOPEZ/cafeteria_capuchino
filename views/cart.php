<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>carrito</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <div class="heading">
      <h3>carrito de compras</h3>
      <p><a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'home' : 'home.php'; ?>">inicio</a> <span> / carrito</span></p>
   </div>

   <section class="products">
      <h1 class="title">tu carrito</h1>

      <div class="box-container">
         <?php if (!empty($cartItems)) { ?>
            <?php foreach ($cartItems as $fetch_cart) { ?>
               <?php $sub_total = ((int)$fetch_cart['price'] * (int)$fetch_cart['quantity']); ?>
               <form action="" method="post" class="box">
                  <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                  <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'quick_view' : 'quick_view.php'; ?>?pid=<?= $fetch_cart['pid']; ?>" class="fas fa-eye"></a>
                  <button type="submit" class="fas fa-times" name="delete" onclick="return confirm('eliminar este articulo?');"></button>
                  <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
                  <div class="name"><?= $fetch_cart['name']; ?></div>
                  <div class="flex">
                     <div class="price"><span>Bs.</span><?= $fetch_cart['price']; ?></div>
                     <input type="number" name="qty" class="qty" min="1" max="99" value="<?= $fetch_cart['quantity']; ?>" maxlength="2">
                     <button type="submit" class="fas fa-edit" name="update_qty"></button>
                  </div>
                  <div class="sub-total"> subtotal : <span>Bs.<?= $sub_total; ?>/-</span> </div>
               </form>
            <?php } ?>
         <?php } else { ?>
            <p class="empty">tu carrito esta vacio</p>
         <?php } ?>
      </div>

      <div class="cart-total">
         <p>total del carrito : <span>Bs.<?= $grand_total; ?></span></p>
         <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'checkout' : 'checkout.php'; ?>" class="btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>">proceder al pago</a>
      </div>

      <div class="more-btn">
         <form action="" method="post">
            <button type="submit" class="delete-btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>" name="delete_all" onclick="return confirm('eliminar todo del carrito?');">eliminar todo</button>
         </form>
         <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'menu' : 'menu.php'; ?>" class="btn">continuar comprando</a>
      </div>
   </section>

   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>
</body>

</html>
