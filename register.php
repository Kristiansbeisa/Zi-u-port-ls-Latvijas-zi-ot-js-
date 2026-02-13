<?php
$host = "localhost";
$db   = "beisadb";
$user = "root"; 
$pass = ""; 

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
    $email = trim($_POST['epasts'] ?? '');
    $password = $_POST['parole'] ?? '';

    if (strlen($username) < 3) $errors[] = "Lietotājvārds pārāk īss";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Nederīgs e-pasts";
    if (strlen($password) < 6) $errors[] = "Parole pārāk īsa";

    if (empty($errors)) {
        // pārbaude, vai jau eksistē
        $stmt = $pdo->prepare("SELECT ID FROM lietotaji WHERE Vards = ? OR epasts = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->fetch()) {
            $errors[] = "Lietotājs vai e-pasts jau eksistē";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO lietotaji (Vards, epasts, parole) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $hash]);
            $_SESSION['Vards'] = $username;
            header("Location: index.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <title>Reģistrācija</title>
    <link href="https://cdn.jsdelivr.net/npm/mdb-ui-kit@9.2.0/css/mdb.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" />
</head>
<body>
    <h1>Reģistrācija</h1>
    <?php foreach($errors as $e) echo "<p style='color:red;'>$e</p>"; ?>
    <form method="post">
        Lietotājvārds: <input name="Vards"><br>
        E-pasts: <input name="epasts"><br>
        Parole: <input type="password" name="parole"><br>
        <button type="submit">Reģistrēties</button>
    </form>
    <p><a href="index.php">← Atpakaļ</a></p>
    <script src="https://cdn.jsdelivr.net/npm/mdb-ui-kit@9.2.0/js/mdb.umd.min.js"></script>
</body>
</html>