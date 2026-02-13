<?php
//Sesija, MySQL, CSRF tokens
$host = "localhost";
$db   = "beisadb";
$user = "root";   
$pass = "";      
//pieslēgums pie MySQL
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("DB connection failed: " . $e->getMessage());
}

session_start();

// CSRF token
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

function check_csrf($token) {
    if (!hash_equals($_SESSION['csrf_token'], $token)) {
        die("CSRF aizliegts!");
    }
}
?>