# Coffee Shop Sucre - Sistema de pedidos en linea

Sistema web para una cafeteria en Sucre, Bolivia. Permite a clientes revisar productos, buscar en el catalogo, agregar al carrito, pagar por QR, confirmar pedidos, ver factura y seguir el estado del pedido.

## Tecnologias

- PHP
- MySQL
- XAMPP
- HTML, CSS y JavaScript

## Arquitectura actual

```text
Cafe-Shop-Management-System/
├── public/          # Entrada web y recursos publicos
│   ├── css/
│   ├── js/
│   ├── images/
│   ├── uploaded_img/
│   └── index.php    # Front Controller
├── controllers/     # Logica de las paginas del cliente
├── models/          # Acceso a base de datos
├── views/           # Vistas PHP/HTML del cliente
├── components/      # Header, footer y partes reutilizables
├── admin/           # Panel de administrador
├── employee/        # Panel de empleado
└── index.php        # Redirige a public/
```

Los archivos PHP antiguos de la raiz, como `home.php`, `menu.php` o `cart.php`, quedaron como redirecciones hacia `public/` para mantener compatibilidad.

## Rutas principales

- Cliente: `http://localhost/ECO/Cafe-Shop-Management-System/public/home`
- Menu: `http://localhost/ECO/Cafe-Shop-Management-System/public/menu`
- Productos: `http://localhost/ECO/Cafe-Shop-Management-System/public/product`
- Carrito: `http://localhost/ECO/Cafe-Shop-Management-System/public/cart`
- Pedidos: `http://localhost/ECO/Cafe-Shop-Management-System/public/orders`
- Login cliente: `http://localhost/ECO/Cafe-Shop-Management-System/public/login`
- Admin: `http://localhost/ECO/Cafe-Shop-Management-System/admin/admin_login.php`
- Empleado: `http://localhost/ECO/Cafe-Shop-Management-System/employee/employee_login.php`

## Funciones del cliente

- Registro e inicio de sesion.
- Catalogo de productos.
- Busqueda de productos.
- Vista rapida de producto.
- Carrito de compras.
- Checkout con pago por QR.
- Registro de referencia y comprobante QR.
- Confirmacion de pedido.
- Factura/comprobante.
- Seguimiento de pedido.
- Edicion de perfil, direccion y datos de factura.
- Contacto con la cafeteria.

## Funciones del administrador

- Dashboard.
- Gestion de productos.
- Gestion de pedidos por estado.
- Gestion de usuarios.
- Gestion de empleados.
- Gestion de mensajes.
- Factura/comprobante de pedidos.

## Funciones del empleado

- Dashboard propio.
- Gestion de productos.
- Gestion de pedidos.
- Factura/comprobante de pedidos.

## Base de datos

Base de datos esperada: `food_db`.

Archivo SQL principal:

```text
food_db.sql
```

Tablas importantes:

- `users`
- `products`
- `cart`
- `orders`
- `order_items`
- `messages`
- `admin`
- `employees`

## Ejecutar en XAMPP

1. Abrir XAMPP.
2. Iniciar Apache y MySQL.
3. Crear/importar la base de datos `food_db` en phpMyAdmin.
4. Importar `food_db.sql`.
5. Abrir:

```text
http://localhost/ECO/Cafe-Shop-Management-System/
```

El sistema redirige automaticamente a `public/`.


