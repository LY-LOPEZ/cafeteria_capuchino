# Coffee Shop Sucre - Sistema de pedidos en linea

Sistema web para una cafeteria en Sucre, Bolivia. Permite a clientes revisar productos, buscar en el catalogo, agregar al carrito, pagar por QR, confirmar pedidos, ver factura y seguir el estado del pedido.

## Tecnologias

- PHP
- MySQL / MariaDB
- XAMPP
- HTML, CSS y JavaScript

## Arquitectura

```text
Cafe-Shop-Limpio/
|-- public/          # Entrada web y recursos publicos
|   |-- css/
|   |-- js/
|   |-- images/
|   |-- uploaded_img/
|   `-- index.php    # Front Controller
|-- controllers/     # Logica de las paginas del cliente
|-- models/          # Acceso a base de datos
|-- views/           # Vistas PHP/HTML del cliente
|-- components/      # Header, footer y partes reutilizables
|-- admin/           # Panel de administrador
|-- employee/        # Panel de empleado
`-- index.php        # Redirige a public/
```

La raiz redirige automaticamente hacia `public/`.

## Rutas principales

- Cliente: `http://localhost/ECO/Cafe-Shop-Limpio/public/home`
- Menu: `http://localhost/ECO/Cafe-Shop-Limpio/public/menu`
- Productos: `http://localhost/ECO/Cafe-Shop-Limpio/public/product`
- Carrito: `http://localhost/ECO/Cafe-Shop-Limpio/public/cart`
- Pedidos: `http://localhost/ECO/Cafe-Shop-Limpio/public/orders`
- Login cliente: `http://localhost/ECO/Cafe-Shop-Limpio/public/login`
- Admin: `http://localhost/ECO/Cafe-Shop-Limpio/admin/admin_login.php`
- Empleado: `http://localhost/ECO/Cafe-Shop-Limpio/employee/employee_login.php`

## Funciones del cliente

- Registro e inicio de sesion.
- Catalogo de productos.
- Busqueda de productos.
- Vista rapida de producto.
- Carrito de compras protegido por login.
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

El archivo `food_db.sql` crea la base `food_db`, las tablas necesarias y datos demo minimos. Las tablas operativas `cart`, `orders`, `order_items` y `messages` quedan vacias para evitar datos de prueba al clonar.

Tablas principales:

- `users`
- `products`
- `cart`
- `orders`
- `order_items`
- `messages`
- `admin`
- `employee`

Credenciales demo despues de importar:

- Admin: usuario `admin`, contrasena `admin`
- Empleado: usuario `empleado1`, contrasena `empleado`
- Cliente: correo `cliente@example.com`, contrasena `admin`

## Ejecutar en XAMPP

1. Abrir XAMPP.
2. Iniciar Apache y MySQL.
3. Clonar/copiar el proyecto en `C:\xampp\htdocs\ECO\Cafe-Shop-Limpio`.
4. Importar `food_db.sql` desde phpMyAdmin o con MySQL.
5. Abrir:

```text
http://localhost/ECO/Cafe-Shop-Limpio/
```

El sistema redirige automaticamente a `public/`.
