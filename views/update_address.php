<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>actualizar direccion</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css?v=20260612">
   <?php include 'components/tailwind_head.php'; ?>
</head>

<body class="tw-bg-coffee-50 tw-font-sans tw-text-coffee-900">

   <?php include 'components/user_header.php'; ?>

   <section class="form-container tw-mx-auto tw-flex tw-min-h-[62vh] tw-max-w-5xl tw-items-center tw-justify-center tw-px-6 tw-py-16">
      <form class="tw-w-full tw-rounded-lg tw-bg-white tw-p-8 tw-shadow-cafe" action="" method="post">
         <h3 class="tw-mb-6 tw-text-center tw-text-4xl tw-font-bold tw-text-coffee-900">datos de entrega y factura</h3>
         <div class="tw-grid tw-gap-4 md:tw-grid-cols-2">
            <input type="text" class="box tw-w-full tw-rounded-md tw-border tw-border-coffee-700/15 tw-bg-coffee-50 tw-p-5 tw-text-2xl" placeholder="Ciudad" required maxlength="50" name="city" value="<?= $fetch_profile['city'] != '' ? $fetch_profile['city'] : 'Sucre'; ?>">
            <input type="text" class="box tw-w-full tw-rounded-md tw-border tw-border-coffee-700/15 tw-bg-coffee-50 tw-p-5 tw-text-2xl" placeholder="Zona o barrio" required maxlength="80" name="zone" value="<?= $fetch_profile['zone']; ?>">
            <input type="text" class="box tw-w-full tw-rounded-md tw-border tw-border-coffee-700/15 tw-bg-coffee-50 tw-p-5 tw-text-2xl" placeholder="Calle o avenida" required maxlength="100" name="street" value="<?= $fetch_profile['street']; ?>">
            <input type="text" class="box tw-w-full tw-rounded-md tw-border tw-border-coffee-700/15 tw-bg-coffee-50 tw-p-5 tw-text-2xl" placeholder="Numero de domicilio" required maxlength="30" name="home_number" value="<?= $fetch_profile['home_number']; ?>">
            <textarea class="box tw-w-full tw-rounded-md tw-border tw-border-coffee-700/15 tw-bg-coffee-50 tw-p-5 tw-text-2xl md:tw-col-span-2" placeholder="Referencia de entrega" required maxlength="180" name="reference" cols="30" rows="4"><?= $fetch_profile['delivery_reference']; ?></textarea>
            <input type="text" class="box tw-w-full tw-rounded-md tw-border tw-border-coffee-700/15 tw-bg-coffee-50 tw-p-5 tw-text-2xl" placeholder="Nombre para factura" required maxlength="100" name="billing_name" value="<?= $fetch_profile['billing_name']; ?>">
            <input type="text" class="box tw-w-full tw-rounded-md tw-border tw-border-coffee-700/15 tw-bg-coffee-50 tw-p-5 tw-text-2xl" placeholder="NIT/CI" required maxlength="30" name="nit_ci" value="<?= $fetch_profile['nit_ci']; ?>">
         </div>
         <input type="submit" value="guardar datos" name="submit" class="btn tw-mt-5 tw-w-full tw-rounded-md tw-px-8 tw-py-5 tw-text-xl tw-font-bold">
      </form>
   </section>

   <?php include 'components/footer.php'; ?>

   <script src="js/script.js?v=20260612"></script>
</body>

</html>
