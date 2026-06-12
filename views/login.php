<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>iniciar sesion</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <section class="form-container">
      <form action="" method="post">
         <h3>iniciar sesion ahora</h3>
         <input type="email" name="email" required placeholder="ingresa tu correo" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="password" name="pass" required placeholder="ingresa tu contrasena" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="submit" value="iniciar sesion ahora" name="submit" class="btn">
         <p>no tienes una cuenta? <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'register' : 'register.php'; ?>">registrate ahora</a></p>
      </form>
   </section>

   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>
</body>

</html>
