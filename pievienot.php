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

if (
    !isset($_SESSION['Liet_ID'])
) {
    header("Location: index.php");
    exit;
}

$stmt = $pdo->query("
    SELECT z.Nosaukums, z.Teksts, l.Vards, z.Izveidots, z.Bilde, z.Svarigums
    FROM zinas z
    JOIN lietotaji l ON z.Liet_ID = l.ID
    ORDER BY z.Izveidots DESC
");
$posts = $stmt->fetchAll();

$kategorijas = ['Lietotāju ziņas'];

$Perm = isset($_SESSION['Loma']) && in_array($_SESSION['Loma'], ['Darbinieks', 'Administrators']);

if ($Perm) {
    $kategorijas = array_merge($kategorijas, [
        'Latvijā',
        'Sports',
        'Politika',
        'Ārzmēs'
    ]);
}
?>
<!DOCTYPE html>
<html lang="lv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Ziņojumi</title>

    <link href="https://cdn.jsdelivr.net/npm/mdb-ui-kit@9.2.0/css/mdb.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" />
</head>

<body>

  <nav class="navbar navbar-light bg-light sticky-top">
    <div class="container-fluid">

      <a class="navbar-brand" href="#">Logo</a>

      <ul class="navbar-nav flex-row gap-4 d-none d-md-flex position-absolute start-50 translate-middle-x">
        <li class="nav-item">
          <a class="nav-link active" href="index.php">Jaunākais</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="latvija.php">Latvijā</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="sports.php">Sports</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="politika.php">Politika</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="arzemes.php">Ārzemēs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="lietotaju_zinas.php">Lietotāju ziņas</a>
        </li>
      </ul>

      <button class="navbar-toggler d-md-none" type="button" data-mdb-collapse-init data-mdb-target="#navbarMenu"
        aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation" style="z-index:9999;">
        <i class="fas fa-bars"></i>
      </button>

    </div>
  </nav>

  <!-- mobilais menu -->
  <div class="collapse fullscreen-menu d-md-none" id="navbarMenu">
    <ul class="navbar-nav text-center mt-5">
      <li class="nav-item"><a class="nav-link active" href="#">Sākums</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Kategorija1</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Kategorija2</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Kategorija3</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Kategorija4</a></li>
    </ul>
  </div>
  <!-- mobilais menu -->

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
                    <h2>Pievienot ziņu</h2>
                </div>

                <div class="card-body text-center">
                    <form action="pievienot1.php" method="post">

                        <div class="form-outline mb-4" data-mdb-input-initialized="true" data-mdb-input-init="">
                            <input type="text" class="form-control" name="nosaukums" required="">
                            <label class="form-label" for="nosaukums" style="margin-left: 0px;">Nosaukums</label>
                            <div class="form-notch">
                                <div class="form-notch-leading" style="width: 9px;"></div>
                                <div class="form-notch-middle" style="width: 112px;"></div>
                                <div class="form-notch-trailing"></div>
                            </div>
                        </div>

                        <div class="form-outline mb-4" data-mdb-input-initialized="true" data-mdb-input-init="">
                            <input type="text" class="form-control" name="teksts" required="">
                            <label class="form-label" for="teksts" style="margin-left: 0px;">Teksts</label>
                            <div class="form-notch">
                                <div class="form-notch-leading" style="width: 9px;"></div>
                                <div class="form-notch-middle" style="width: 91.2px;"></div>
                                <div class="form-notch-trailing"></div>
                            </div>
                        </div>

                        <div class="form-outline mb-4" data-mdb-input-initialized="true" data-mdb-input-init="">
                            <input type="text" class="form-control" name="bilde" required="">
                            <label class="form-label" for="bilde" style="margin-left: 0px;">Bilde</label>
                            <div class="form-notch">
                                <div class="form-notch-leading" style="width: 9px;"></div>
                                <div class="form-notch-middle" style="width: 125.6px;"></div>
                                <div class="form-notch-trailing"></div>
                            </div>
                        </div>

                        <select class="form-select mb-4" name="kategorija" required>
                            <option value="">Kategorija</option>
                            <?php foreach ($kategorijas as $kat): ?>
                                <option value="<?= $kat ?>"><?= $kat ?></option>
                            <?php endforeach; ?>
                        </select>

                        <select class="form-select" name="svarigums" id="account" required="">
                            <option value="">Svarigums</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                        </select>

                        <button type="submit" class="btn btn-primary">Saglabāt</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <script src="https://cdn.jsdelivr.net/npm/mdb-ui-kit@9.2.0/js/mdb.umd.min.js"></script>
</body>

</html>