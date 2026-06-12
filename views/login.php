<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>iniciar sesion</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css?v=20260612">
   <?php include 'components/tailwind_head.php'; ?>
</head>

<body class="tw-bg-coffee-50 tw-font-sans tw-text-coffee-900">

   <?php include 'components/user_header.php'; ?>

   <section class="form-container tw-mx-auto tw-flex tw-min-h-[62vh] tw-max-w-3xl tw-items-center tw-justify-center tw-px-6 tw-py-16">
      <form class="tw-w-full tw-rounded-lg tw-bg-white tw-p-8 tw-shadow-cafe" action="" method="post">
         <h3 class="tw-mb-6 tw-text-center tw-text-4xl tw-font-bold tw-text-coffee-900">iniciar sesion ahora</h3>
         <input type="email" name="email" required placeholder="ingresa tu correo" class="box tw-mb-4 tw-w-full tw-rounded-md tw-border tw-border-coffee-700/15 tw-bg-coffee-50 tw-p-5 tw-text-2xl" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="password" name="pass" required placeholder="ingresa tu contrasena" class="box tw-mb-5 tw-w-full tw-rounded-md tw-border tw-border-coffee-700/15 tw-bg-coffee-50 tw-p-5 tw-text-2xl" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="submit" value="iniciar sesion ahora" name="submit" class="btn tw-w-full tw-rounded-md tw-px-8 tw-py-5 tw-text-xl tw-font-bold">
         <p class="tw-mt-6 tw-text-center tw-text-2xl tw-text-coffee-900/70">no tienes una cuenta? <a class="tw-font-bold tw-text-coffee-700 hover:tw-underline" href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'register' : 'register.php'; ?>">registrate ahora</a></p>
      </form>
   </section>

   <?php include 'components/footer.php'; ?>

   <script src="js/script.js?v=20260612"></script>
</body>

</html>
