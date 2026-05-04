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

if (
    !isset($_SESSION['Liet_ID'])
) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'buy_sub') {

    $liet_id = $_SESSION['Liet_ID'];
    $dienas = (int)$_POST['tips'];

    $d = [30, 90, 180, 360];
    if (!in_array($dienas, $d)) {
        die("Nederīgs izvēles variants");
    }

    $sakums = date("Y-m-d");
    $beigas = date("Y-m-d", strtotime("+$dienas days"));

    $stmt = $pdo->prepare("INSERT INTO abonementi (Liet_ID, Tips, Sakums, Beigas)
        VALUES (?, ?, ?, ?)
    ");
    $stmt->execute([$liet_id, $dienas, $sakums, $beigas]);

    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="lv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Abonements</title>

    <link href="https://cdn.jsdelivr.net/npm/mdb-ui-kit@9.2.0/css/mdb.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" />
</head>

<body>

  <?php
        navbar();
    ?>

    <style>
        .fullscreen-menu {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: #f8f9fa;
            z-index: 10;
        }

        .fullscreen-menu .nav-link {
            font-size: 1.5rem;
            padding: 1rem 0;
        }
    </style>


    <div class="container mt-5">

        <div class="row">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Pirkt abonementu</h2>
                </div>

                <div class="card-body text-center">
                    <form method="POST">
                        <input type="hidden" name="action" value="buy_sub">
                        <select name="tips">
                            <option value="30">30 dienas</option>
                            <option value="90">90 dienas</option>
                            <option value="180">180 dienas</option>
                            <option value="360">360 dienas</option>
                        </select>   
                        
                        <button type="submit">Pirkt</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <script src="https://cdn.jsdelivr.net/npm/mdb-ui-kit@9.2.0/js/mdb.umd.min.js"></script>
</body>

</html>