<?php
include 'funkcijas.php';

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
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Pieslēgšanās</title>
    <link href="https://cdn.jsdelivr.net/npm/mdb-ui-kit@9.2.0/css/mdb.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" />
    <link href="dizains.css" rel="stylesheet" />
</head>
<body>

    <?php
        navbar();
    ?>

    <div class="container mt-5">

        <div class="row">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Pieteikšanās</h2>
                </div>

                <div class="card-body text-center">
                    <form method="post">

                        <div class="form-outline mb-4" data-mdb-input-initialized="true" data-mdb-input-init="">
                            <input type="text" class="form-control" name="Vards" required="">
                            <label class="form-label" for="Vards" style="margin-left: 0px;">Lietotājvārds vai e-pasts</label>
                            <div class="form-notch">
                                <div class="form-notch-leading" style="width: 9px;"></div>
                                <div class="form-notch-middle" style="width: 112px;"></div>
                                <div class="form-notch-trailing"></div>
                            </div>
                        </div>

                        <div class="form-outline mb-4" data-mdb-input-initialized="true" data-mdb-input-init="">
                            <input type="password" class="form-control" name="parole" required="">
                            <label class="form-label" for="parole" style="margin-left: 0px;">Parole</label>
                            <div class="form-notch">
                                <div class="form-notch-leading" style="width: 9px;"></div>
                                <div class="form-notch-middle" style="width: 112px;"></div>
                                <div class="form-notch-trailing"></div>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary">Pieteikties</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/mdb-ui-kit@9.2.0/js/mdb.umd.min.js"></script>
</body>
</html>