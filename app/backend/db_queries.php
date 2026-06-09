<?php

function user_create(PDO $obj, string $username, string $password, string $email) {
    $obj->query("INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')");
}

function get_products(PDO $obj) {
    $result = $obj->query("SELECT * FROM products");
    return $result->fetchAll(PDO::FETCH_ASSOC);
}
function get_user(PDO $obj) {
    $result = $obj->query("SELECT * FROM users");
    return $result->fetchAll(PDO::FETCH_ASSOC);
}

function create_product(PDO $obj, string $name, float $price, string $description, int $quantity) {
    $obj->query("INSERT INTO products (name, price, description, quantity) VALUES ('$name', $price, '$description', $quantity)");
}

function buy_product(PDO $obj, int $product_id, int $quantity) {
    $obj->query("INSERT INTO sales (product_id, quantity) VALUES ($product_id, $quantity)");
}

function get_sales(PDO $obj) {
    $result = $obj->query("SELECT * FROM sales");
    return $result->fetchAll(PDO::FETCH_ASSOC);
}

// Collecting Database Configuration
$config = require "config.php";

// Establishing Database Connection
$pdo = new PDO("mysql:host={$config['host']};dbname={$config['dbname']}", "{$config['user']}", "{$config['pass']}");

// Setting PDO Error Mode
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);