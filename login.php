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

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['Vards'] ?? '');
    $password = $_POST['parole'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM lietotaji WHERE Vards = ? OR epasts = ?");
    $stmt->execute([$username, $username]);
    $user = $stmt->fetch();

    if (!$user) {
        $error = "Nepareizs lietotājvārds/e-pasts!";
    }

    elseif (!password_verify($password, $user['parole'])) {
        $error = "Nepareiza parole!";
    }

    else {
        $_SESSION['Vards'] = $user['Vards'];
        $_SESSION['Liet_ID'] = $user['ID'];
        $_SESSION['Loma'] = $user['Loma'];

        $stmtsub = $pdo->prepare(" SELECT * FROM abonementi WHERE Liet_ID = ? AND Beigas >= CURDATE() ORDER BY Beigas DESC LIMIT 1 ");
        $stmtsub->execute([$_SESSION['Liet_ID']]);
        $abonements = $stmtsub->fetch();

        if ($abonements) {
            $_SESSION['Abonements'] = $abonements['Tips'];
        } else {
            $_SESSION['Abonements'] = null;
        }

        $_SESSION['positive_alert_text'] = 'Jūs pieteicāties kontā!';
        
        header("Location: index.php");
        exit;
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

    <div class="container mt-5" style="max-width:700px;">

        <div class="row">
            <div class="col-12">
            <div class="card shadow-6-strong">
                <div class="card-header text-center">
                    <h2>Pieteikšanās</h2>
                </div>

                <div class="card-body text-center">
                    <form id="login_forma" method="post" novalidate>

                        <?php form_negative_alert('login_forma', 'login_alert', $error); ?>

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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/mdb-ui-kit@9.2.0/js/mdb.umd.min.js"></script>
</body>
</html>