<?php
include 'funkcijas.php';

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
        $stmt = $pdo->prepare("SELECT * FROM lietotaji WHERE Vards = ? OR epasts = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->fetch()) {
            $errors[] = "Lietotājs vai e-pasts jau eksistē";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO lietotaji (Vards, epasts, parole, Loma) VALUES (?, ?, ?, ?)");
            $stmt->execute([$username, $email, $hash, "Lietotājs"]);
            $ID = $pdo->lastInsertId();
            $_SESSION['Vards'] = $username;
            $_SESSION['Liet_ID'] = $ID;
            $_SESSION['Loma']    = "Lietotājs";
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
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Reģistrācija</title>
    <link href="https://cdn.jsdelivr.net/npm/mdb-ui-kit@9.2.0/css/mdb.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" />
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
                            <label class="form-label" for="Vards" style="margin-left: 0px;">Lietotājvārds</label>
                            <div class="form-notch">
                                <div class="form-notch-leading" style="width: 9px;"></div>
                                <div class="form-notch-middle" style="width: 112px;"></div>
                                <div class="form-notch-trailing"></div>
                            </div>
                        </div>

                        <div class="form-outline mb-4" data-mdb-input-initialized="true" data-mdb-input-init="">
                            <input type="text" class="form-control" name="epasts" required="">
                            <label class="form-label" for="epasts" style="margin-left: 0px;">E-pasts</label>
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


                        <button type="submit" class="btn btn-primary">Piereģistrēties</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/mdb-ui-kit@9.2.0/js/mdb.umd.min.js"></script>
</body>
</html>