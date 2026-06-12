<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

?>

<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
    }
}
?>

<?php
$select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
$select_profile->execute([$admin_id]);
$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>

    <link rel="stylesheet" href="../css/nav.css">


</head>

<body>
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <img style="width: 80px;" src="../images/08052021-05_generated-removebg-preview.png" alt="Cafe Shop 😋">
                        <P style="font-size: 1.8rem; margin-top: 1.2rem;"><span class="title">Cafe Shop 😋</span></P>

                    </a>

                </li>

                <li>
                    <a href="dashboard.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Panel</span>
                    </a>
                </li>

                <li>
                    <a href="products.php">
                        <span class="icon">
                            <ion-icon name="grid-outline"></ion-icon>
                        </span>
                        <span class="title">Productos</span>
                    </a>
                </li>

                <li>
                    <a href="placed_orders.php">
                        <span class="icon">
                            <ion-icon name="receipt-outline"></ion-icon>
                        </span>
                        <span class="title">pedidos</span>
                    </a>
                </li>

                <li>
                    <a href="admin_accounts.php">
                        <span class="icon">
                            <ion-icon name="accessibility-outline"></ion-icon>
                        </span>
                        <span class="title">administradores</span>
                    </a>
                </li>

                <li>
                    <a href="employee_accounts.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">empleados</span>
                    </a>
                </li>

                <li>
                    <a href="users_accounts.php">
                        <span class="icon">
                            <ion-icon name="people-circle-outline"></ion-icon>
                        </span>
                        <span class="title">usuarios</span>
                    </a>
                </li>

                <li>
                    <a href="messages.php">
                        <span class="icon">
                            <ion-icon name="chatbubble-outline"></ion-icon>
                        </span>
                        <span class="title">mensajes</span>
                    </a>
                </li>

                <li>
                    <a href="../components/admin_logout.php" onclick="return confirm('¿cerrar sesión en este sitio web?');" class="delete-btn"><span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Cerrar Sesión</span></a>
                </li>
            </ul>
        </div>

        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <a href="dashboard.php" class="logo">
                    <h1 style="text-align: center;">Panel<span style="color: blue;">Admin</span></h1>
                </a>

                <div class="">
                    <p>¡Bienvenido! <?= $fetch_profile['name']; ?></p>
                    <div class="icons">
                        <div id="user-btn" class="fas fa-user"></div>
                    </div>
                </div>


            </div>

            <section class="dashboard">

                <h1 class="heading" style="text-align: center; margin-top:3rem">PANEL </h1>

                <div class="cardBox">

                    <div class="card">
                        <?php
                        $total_pendings = 0;
                        $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
                        $select_pendings->execute(['pending']);
                        while ($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)) {
                            $total_pendings += $fetch_pendings['total_price'];
                        }
                        ?>
                        <div>
                            <div class="numbers"><span>Bs.</span><?= $total_pendings; ?><span>/-</span></div>
                            <div class="cardName">total pendientes</div>
                        </div>

                        <div class="iconBx">
                            <a href="pending_orders.php">
                                <ion-icon name="wallet-outline"></ion-icon>
                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <?php
                        $total_completes = 0;
                        $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
                        $select_completes->execute(['completed']);
                        while ($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)) {
                            $total_completes += $fetch_completes['total_price'];
                        }
                        ?>
                        <div>
                            <div class="numbers"><span>Bs.</span><?= $total_completes; ?><span>/-</span></div>
                            <div class="cardName">total completados</div>
                        </div>

                        <div class="iconBx">
                            <a href="completed_orders.php" class="ho">
                                <ion-icon name="wallet-outline"></ion-icon>
                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <?php
                        $select_orders = $conn->prepare("SELECT * FROM `orders`");
                        $select_orders->execute();
                        $numbers_of_orders = $select_orders->rowCount();
                        ?>
                        <div>
                            <div class="numbers"><span>Bs.</span><?= $total_completes + $total_pendings; ?><span>/-</span></div>
                            <div class="cardName">total de pedidos</div>
                        </div>

                        <div class="iconBx">
                            <a href="placed_orders.php">
                                <ion-icon name="wallet-outline"></ion-icon>
                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <?php
                        $select_products = $conn->prepare("SELECT * FROM `products`");
                        $select_products->execute();
                        $numbers_of_products = $select_products->rowCount();
                        ?>
                        <div>
                            <div class="numbers"><?= $numbers_of_products; ?></div>
                            <div class="cardName">productos añadidos</div>
                        </div>

                        <div class="iconBx">
                            <a href="products.php">
                                <ion-icon name="grid-outline"></ion-icon>
                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <?php
                        $select_users = $conn->prepare("SELECT * FROM `users`");
                        $select_users->execute();
                        $numbers_of_users = $select_users->rowCount();
                        ?>
                        <div>
                            <div class="numbers"><?= $numbers_of_users; ?></div>
                            <div class="cardName">cuentas de usuarios</div>
                        </div>

                        <div class="iconBx">
                            <a href="users_accounts.php">
                                <ion-icon name="people-circle-outline"></ion-icon>
                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <?php
                        $select_admins = $conn->prepare("SELECT * FROM `admin`");
                        $select_admins->execute();
                        $numbers_of_admins = $select_admins->rowCount();
                        ?>
                        <div>
                            <div class="numbers"><?= $numbers_of_admins; ?></div>
                            <div class="cardName">cuentas de admin</div>
                        </div>

                        <div class="iconBx">
                            <a href="admin_accounts.php">
                                <ion-icon name="accessibility-outline"></ion-icon>
                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <?php
                        $select_employees = $conn->prepare("SELECT * FROM `employee`");
                        $select_employees->execute();
                        $numbers_of_employees = $select_employees->rowCount();
                        ?>
                        <div>
                            <div class="numbers"><?= $numbers_of_employees; ?></div>
                            <div class="cardName">cuentas de empleados</div>
                        </div>

                        <div class="iconBx">
                            <a href="employee_accounts.php">
                                <ion-icon name="people-outline"></ion-icon>
                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <?php
                        $select_messages = $conn->prepare("SELECT * FROM `messages`");
                        $select_messages->execute();
                        $numbers_of_messages = $select_messages->rowCount();
                        ?>
                        <div>
                            <div class="numbers"><?= $numbers_of_messages; ?></div>
                            <div class="cardName">nuevos mensajes</div>
                        </div>

                        <div class="iconBx">
                            <a href="messages.php">
                                <ion-icon name="chatbubble-outline"></ion-icon>
                            </a>
                        </div>
                    </div>
                </div>

                <h1 class="heading" style="text-align: center;">Resumen de actividad</h1>

                <div class="cardBox">

                    <div class="card">
                        <div>
                            <div class="numbers">1,504</div>
                            <div class="cardName">Vistas Diarias</div>
                        </div>

                        <div class="iconBx">
                            <ion-icon name="eye-outline"></ion-icon>
                        </div>
                    </div>

                    <div class="card">
                        <div>
                            <div class="numbers">80</div>
                            <div class="cardName">Ventas</div>
                        </div>

                        <div class="iconBx">
                            <ion-icon name="cart-outline"></ion-icon>
                        </div>
                    </div>

                    <div class="card">
                        <div>
                            <div class="numbers">284</div>
                            <div class="cardName">Calificación</div>
                        </div>

                        <div class="iconBx">
                            <ion-icon name="chatbubbles-outline"></ion-icon>
                        </div>
                    </div>

                    <div class="card">
                        <div>
                            <div class="numbers">$7,842</div>
                            <div class="cardName">Ganancias</div>
                        </div>

                        <div class="iconBx">
                            <ion-icon name="cash-outline"></ion-icon>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    </div>

    <script src="../js/nav.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
