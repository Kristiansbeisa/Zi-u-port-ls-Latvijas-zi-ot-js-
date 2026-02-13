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

session_start();

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['Vards'] ?? '');
    $password = $_POST['parole'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM lietotaji WHERE Vards = ? OR epasts = ?");
    $stmt->execute([$username, $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['parole'])) {
        $_SESSION['Vards'] = $user['Vards'];
        $_SESSION['Liet_ID'] = $user['ID'];
        $_SESSION['Loma']    = $user['Loma'];
        header("Location: index.php");
        exit;
    } else {
        $errors[] = "Nepareizs lietotājvārds/e-pasts vai parole";
    }
}
?>
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <title>Pieslēgšanās</title>
    <link href="https://cdn.jsdelivr.net/npm/mdb-ui-kit@9.2.0/css/mdb.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" />
</head>
<body>
    <h1>Pieslēgšanās</h1>
    <?php foreach($errors as $e) echo "<p style='color:red;'>$e</p>"; ?>
    <form method="post">
        Lietotājvārds vai e-pasts: <input name="Vards"><br>
        Parole: <input type="password" name="parole"><br>
        <button type="submit">Pieslēgties</button>
    </form>
    <p><a href="index.php">← Atpakaļ</a></p>
    <script src="https://cdn.jsdelivr.net/npm/mdb-ui-kit@9.2.0/js/mdb.umd.min.js"></script>
</body>
</html>