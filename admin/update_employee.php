<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
}

$update_id = $_GET['update'] ?? '';
$update_id = filter_var($update_id, FILTER_SANITIZE_STRING);

if (isset($_POST['submit'])) {
   $employee_id = $_POST['employee_id'];
   $employee_id = filter_var($employee_id, FILTER_SANITIZE_STRING);
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

   $select_name = $conn->prepare("SELECT * FROM `employee` WHERE name = ? AND id != ?");
   $select_name->execute([$name, $employee_id]);

   if ($select_name->rowCount() > 0) {
      $message[] = 'el nombre de empleado ya existe';
   } else {
      $update_employee = $conn->prepare("UPDATE `employee` SET name = ?, age = ?, sex = ?, phone = ?, email = ?, address = ? WHERE id = ?");
      $update_employee->execute([$name, $age, $sex, $phone, $email, $address, $employee_id]);
      $message[] = 'empleado actualizado correctamente';
      $update_id = $employee_id;
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>actualizar empleado</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/dashboard_style.css">
</head>

<body>

   <?php include '../components/admin_header.php' ?>

   <section class="form-container">
      <?php
      $select_employee = $conn->prepare("SELECT * FROM `employee` WHERE id = ?");
      $select_employee->execute([$update_id]);
      if ($select_employee->rowCount() > 0) {
         $fetch_employee = $select_employee->fetch(PDO::FETCH_ASSOC);
      ?>
         <form action="" method="POST">
            <h3>actualizar empleado</h3>
            <input type="hidden" name="employee_id" value="<?= $fetch_employee['id']; ?>">
            <input type="text" name="name" maxlength="20" required class="box" value="<?= $fetch_employee['name']; ?>" placeholder="nombre">
            <input type="number" name="age" min="18" max="99" required class="box" value="<?= $fetch_employee['age']; ?>" placeholder="edad">
            <select name="sex" class="box" required>
               <option selected value="<?= $fetch_employee['sex']; ?>"><?= $fetch_employee['sex']; ?></option>
               <option value="male">masculino</option>
               <option value="female">femenino</option>
               <option value="other">otro</option>
            </select>
            <input type="number" name="phone" maxlength="11" required class="box" value="<?= $fetch_employee['phone']; ?>" placeholder="telefono">
            <input type="email" name="email" maxlength="150" required class="box" value="<?= $fetch_employee['email']; ?>" placeholder="correo">
            <input type="text" name="address" maxlength="150" required class="box" value="<?= $fetch_employee['address']; ?>" placeholder="direccion">
            <div class="flex-btn">
               <input type="submit" value="actualizar" name="submit" class="btn">
               <a href="employee_accounts.php" class="option-btn">volver</a>
            </div>
         </form>
      <?php
      } else {
         echo '<p class="empty">empleado no encontrado</p>';
      }
      ?>
   </section>

   <script src="../js/admin_script.js"></script>

</body>

</html>
