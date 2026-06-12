-- Cafe Shop database schema and seed data
-- Import this file in phpMyAdmin or run it with:
-- mysql -u root < food_db.sql

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `food_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `food_db`;

DROP TABLE IF EXISTS `order_items`;
DROP TABLE IF EXISTS `orders`;
DROP TABLE IF EXISTS `cart`;
DROP TABLE IF EXISTS `messages`;
DROP TABLE IF EXISTS `rating`;
DROP TABLE IF EXISTS `products`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `employee`;
DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

CREATE TABLE `employee` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `age` int(2) DEFAULT NULL,
  `sex` varchar(15) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `employee` (`id`, `name`, `age`, `sex`, `phone`, `email`, `address`, `password`) VALUES
(1, 'employee', 22, 'male', 1521509030, 'employee@example.com', 'Sucre, Bolivia', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2'),
(2, 'empleado1', 22, 'male', 70000001, 'empleado1@example.com', 'Sucre, Bolivia', 'f9f011a553550aef31a8ee2690e1d1b5f261c9ff');

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL DEFAULT '',
  `city` varchar(50) NOT NULL DEFAULT '',
  `zone` varchar(80) NOT NULL DEFAULT '',
  `street` varchar(100) NOT NULL DEFAULT '',
  `home_number` varchar(30) NOT NULL DEFAULT '',
  `delivery_reference` varchar(180) NOT NULL DEFAULT '',
  `billing_name` varchar(100) NOT NULL DEFAULT '',
  `nit_ci` varchar(30) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`, `address`, `city`, `zone`, `street`, `home_number`, `delivery_reference`, `billing_name`, `nit_ci`) VALUES
(1, 'cliente', 'cliente@example.com', '70000000', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Sucre, zona Centro, Calle Junin, Nro. 123, Ref.: cerca de la Plaza 25 de Mayo', 'Sucre', 'Centro', 'Calle Junin', '123', 'cerca de la Plaza 25 de Mayo', 'Consumidor Final', '0');

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(100) NOT NULL,
  `popularity` int(8) DEFAULT NULL,
  `disprice` int(10) DEFAULT NULL,
  `desc` varchar(1500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `products` (`id`, `name`, `category`, `price`, `image`, `popularity`, `disprice`, `desc`) VALUES
(11, 'Cappuccino', 'coffee', 25, 'cappuccino-1659544996.png', 10, NULL, 'Cafe cremoso con leche vaporizada.'),
(12, 'Cortado', 'coffee', 15, 'cortado-1659544996.webp', 7, NULL, 'Espresso equilibrado con un toque de leche.'),
(13, 'Latte', 'coffee', 22, 'latte-1659544996.webp', 6, NULL, 'Cafe suave con leche cremosa.'),
(15, 'Mocha', 'coffee', 25, 'mocha-1659544996.webp', 9, NULL, 'Cafe con chocolate y leche.'),
(17, 'Macchiato', 'coffee', 18, 'macchiato-1659544996.webp', 8, NULL, 'Espresso marcado con espuma de leche.'),
(18, 'Cold Brew', 'coffee', 20, 'cold-brew-1659544996.webp', 5, NULL, 'Cafe frio de extraccion lenta.'),
(19, 'Espresso Con Panna', 'coffee', 20, 'espresso-con-panna-1659544996.webp', 5, NULL, 'Espresso con crema batida.'),
(20, 'Cafe Cubano', 'coffee', 18, 'cafe-cubano-1659544996.webp', 4, NULL, 'Cafe intenso y dulce.'),
(21, 'Espresso Romano', 'coffee', 18, 'espresso-romano-1659544996.webp', 4, NULL, 'Espresso con toque citrico.'),
(24, 'Affogato', 'desserts', 30, 'affogato-1659544996.webp', 6, NULL, 'Helado banado con espresso.'),
(26, 'Mexican Coffee', 'coffee', 28, 'mexican-coffee-1659544996.webp', 3, NULL, 'Cafe aromatico con notas especiadas.'),
(28, 'Te Helado', 'drinks', 12, 'cold-brew-1659544996.webp', 2, NULL, 'Bebida fria para acompanar.'),
(29, 'Helado de Vainilla', 'desserts', 15, 'affogato-1659544996.webp', 2, NULL, 'Postre clasico de vainilla.'),
(30, 'Sandwich de Queso', 'fast food', 10, 'latte-1659544996.webp', 1, NULL, 'Acompanamiento sencillo para el cafe.');

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL DEFAULT 0,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `payment_reference` varchar(100) NOT NULL DEFAULT '',
  `payment_proof` varchar(100) NOT NULL DEFAULT '',
  `address` varchar(500) NOT NULL,
  `city` varchar(50) NOT NULL DEFAULT '',
  `zone` varchar(80) NOT NULL DEFAULT '',
  `street` varchar(100) NOT NULL DEFAULT '',
  `home_number` varchar(30) NOT NULL DEFAULT '',
  `delivery_reference` varchar(180) NOT NULL DEFAULT '',
  `billing_name` varchar(100) NOT NULL DEFAULT '',
  `nit_ci` varchar(30) NOT NULL DEFAULT '',
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  `order_status` varchar(30) NOT NULL DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `order_items` (
  `id` int(100) NOT NULL,
  `order_id` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `subtotal` int(100) NOT NULL,
  `image` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `rating` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `User_name` varchar(20) NOT NULL,
  `rating` int(2) NOT NULL,
  `review` varchar(1500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_name_unique` (`name`);

ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_name_unique` (`name`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_number_unique` (`number`);

ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_user_id` (`user_id`),
  ADD KEY `cart_pid` (`pid`);

ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id` (`user_id`);

ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id` (`order_id`),
  ADD KEY `order_items_product_id` (`product_id`);

ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `employee`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

ALTER TABLE `order_items`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

ALTER TABLE `rating`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

COMMIT;
