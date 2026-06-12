<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>actualizar direccion</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <section class="form-container">
      <form action="" method="post">
         <h3>datos de entrega y factura</h3>
         <input type="text" class="box" placeholder="Ciudad" required maxlength="50" name="city" value="<?= $fetch_profile['city'] != '' ? $fetch_profile['city'] : 'Sucre'; ?>">
         <input type="text" class="box" placeholder="Zona o barrio" required maxlength="80" name="zone" value="<?= $fetch_profile['zone']; ?>">
         <input type="text" class="box" placeholder="Calle o avenida" required maxlength="100" name="street" value="<?= $fetch_profile['street']; ?>">
         <input type="text" class="box" placeholder="Numero de domicilio" required maxlength="30" name="home_number" value="<?= $fetch_profile['home_number']; ?>">
         <textarea class="box" placeholder="Referencia de entrega" required maxlength="180" name="reference" cols="30" rows="4"><?= $fetch_profile['delivery_reference']; ?></textarea>
         <input type="text" class="box" placeholder="Nombre para factura" required maxlength="100" name="billing_name" value="<?= $fetch_profile['billing_name']; ?>">
         <input type="text" class="box" placeholder="NIT/CI" required maxlength="30" name="nit_ci" value="<?= $fetch_profile['nit_ci']; ?>">
         <input type="submit" value="guardar datos" name="submit" class="btn">
      </form>
   </section>

   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>
</body>

</html>
