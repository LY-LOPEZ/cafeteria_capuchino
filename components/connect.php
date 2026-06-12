<?php

$db_host = getenv('DB_HOST') ?: 'localhost';
$db_name = getenv('DB_NAME') ?: 'food_db';
$user_name = getenv('DB_USER') ?: 'root';
$user_password = getenv('DB_PASSWORD') ?: '';

$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4";

try {
	$conn = new PDO($dsn, $user_name, $user_password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	die('Error de conexión: ' . $e->getMessage());
}
