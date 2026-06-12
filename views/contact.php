<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contacto</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <div class="heading">
      <h3>contactanos</h3>
      <p><a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'home' : 'home.php'; ?>">inicio</a> <span> / contacto</span></p>
   </div>

   <section class="contact">
      <div class="row">
         <div class="image">
            <img src="images/contact-us.jpg" alt="">
         </div>

         <form action="" method="post">
            <h3>cuentanos algo</h3>
            <input type="text" name="name" maxlength="50" class="box" placeholder="ingresa tu nombre" required>
            <input type="number" name="number" min="0" max="9999999999" class="box" placeholder="ingresa tu numero" required maxlength="10">
            <input type="email" name="email" maxlength="50" class="box" placeholder="ingresa tu correo" required>
            <textarea name="msg" class="box" required placeholder="ingresa tu mensaje" maxlength="500" cols="30" rows="10"></textarea>
            <input type="submit" value="enviar mensaje" name="send" class="btn">
         </form>
      </div>
   </section>

   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>
</body>

</html>
