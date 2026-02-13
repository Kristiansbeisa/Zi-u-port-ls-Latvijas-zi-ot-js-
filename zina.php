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

$stmt = $pdo->query("
    SELECT z.Nosaukums, z.Teksts, l.Vards, z.Izveidots, z.Bilde, z.Svarigums, z.Kategorija
    FROM zinas z
    JOIN lietotaji l ON z.Liet_ID = l.ID
    ORDER BY z.Izveidots DESC
");
$posts = $stmt->fetchAll();
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

      <?php if (
    isset($_SESSION['Liet_ID']) &&
    in_array($_SESSION['Loma'], ['Darbinieks', 'Administrators'])
): ?>
      <a href="pievienot.php" class="btn d-none d-md-flex">Pievienot</a>
      <?php endif; ?>

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

  <?php
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Ziņa nav atrasta");
}

$id = (int)$_GET['id'];

$stmt = $pdo->prepare("SELECT Nosaukums, Teksts, Bilde, Izveidots, Kategorija 
                        FROM zinas 
                        WHERE ID = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();

if (!$post) {
    die("Ziņa neeksistē");
}
?>

<!-- Lapas saturs !-->
  <div class="container mt-5 pt-5">

    <div class="container mt-5 mb-5" style="width:70%;">
            <h1 class="text-center text-black">
                <?= htmlspecialchars($post['Nosaukums']) ?>
            </h1>
            <h6 class="d-flex justify-content-between">
                <span>
                    <?= htmlspecialchars($post['Kategorija']) ?>
                </span>
                <span class="mt-2"><em>
                    <?= htmlspecialchars($post['Izveidots']) ?>
                </em></span>
            </h6>

        <?php if (!empty($post['Bilde'])): ?>
        <img src="<?= htmlspecialchars($post['Bilde']) ?>" style="width:100%;">
        <?php endif; ?>
    </div>
    
    <div class="container" style="width:80%;">
        <div class="text-black">
        <?= nl2br(htmlspecialchars($post['Teksts'])) ?>
        </div>
    </div>
  </div>
<!-- Lapas saturs !-->

  <?php if (isset($_SESSION['Vards'])): ?>
  <p>Sveiks,
    <?php echo htmlspecialchars($_SESSION['Vards']); ?>!
    <a href="logout.php">Iziet</a>
  </p>
  <?php else: ?>
  <p><a href="register.php">Reģistrācija</a> | <a href="login.php">Pieslēgties</a></p>
  <?php endif; ?>

  <script src="https://cdn.jsdelivr.net/npm/mdb-ui-kit@9.2.0/js/mdb.umd.min.js"></script>
</body>

</html>