<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
};

if (isset($_POST['submit'])) {

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $age = $_POST['age'];
   $age = filter_var($age, FILTER_SANITIZE_STRING);
   $sex = $_POST['sex'];
   $sex = filter_var($sex, FILTER_SANITIZE_STRING);
   $phone = $_POST['phone'];
   $phone = filter_var($phone, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_EMAIL);
   $address = $_POST['address'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_employee = $conn->prepare("SELECT * FROM `employee` WHERE name = ?");
   $select_employee->execute([$name]);

   if ($select_employee->rowCount() > 0) {
      $message[] = '¡el nombre de usuario ya existe!';
   } else {
      if ($pass != $cpass) {
         $message[] = '¡la confirmación de contraseña no coincide!';
      } else {
         $insert_employee = $conn->prepare("INSERT INTO `employee`(name, age, sex, phone, email, address, password) VALUES(?,?,?,?,?,?,?)");
         $insert_employee->execute([$name, $age, $sex, $phone, $email, $address, $cpass]);
         $message[] = '¡nuevo empleado registrado!';
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>registro</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../public/css/dashboard_style.css">

</head>

<body>

   <?php include '../components/admin_header.php' ?>

   <!-- register admin section starts  -->

   <section class="form-container">

      <form action="" method="POST">
         <h3>registrar nuevo</h3>
         <input type="text" name="name" maxlength="20" required placeholder="ingresa tu nombre de usuario" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="number" name="age" min="18" max="99" required placeholder="ingresa tu edad" class="box">
         <select name="sex" class="box" required>
            <option value="" disabled selected>selecciona sexo</option>
            <option value="male">masculino</option>
            <option value="female">femenino</option>
            <option value="other">otro</option>
         </select>
         <input type="number" name="phone" maxlength="11" required placeholder="ingresa tu telÃ©fono" class="box">
         <input type="email" name="email" maxlength="150" required placeholder="ingresa tu correo" class="box">
         <input type="text" name="address" maxlength="150" required placeholder="ingresa tu direcciÃ³n" class="box">
         <input type="password" name="pass" maxlength="20" required placeholder="ingresa tu contraseña" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="password" name="cpass" maxlength="20" required placeholder="confirma tu contraseña" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="submit" value="regístrate ahora" name="submit" class="btn">
      </form>

   </section>

   <!-- register admin section ends -->

   <!-- custom js file link  -->
   <script src="../public/js/admin_script.js"></script>

</body>

</html>
