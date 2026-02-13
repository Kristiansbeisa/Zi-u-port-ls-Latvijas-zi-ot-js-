<?php
$host = "localhost";
$db   = "beisadb";
$user = "root";   // XAMPP pēc noklusējuma
$pass = "";       // parole tukša

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("DB connection failed: " . $e->getMessage());
}

session_start();       // jāstartē, lai piekļūtu esošajai sesijai
session_unset();       // iztīra visus $_SESSION mainīgos
session_destroy();     // pilnībā izdzēš sesiju
header("Location: index.php");
exit;
?>