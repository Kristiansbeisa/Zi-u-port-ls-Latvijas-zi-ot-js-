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

  <?php
        navbar();
    ?>

  <?php
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Ziņa netika atrasta");
}

$id = (int)$_GET['id'];

// Atsauksmes dzēšana
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dzest_atsauksmi'])) {

    $atsauksmes_id = (int)$_POST['dzest_atsauksmi'];

    $stmt = $pdo->prepare("SELECT a.Liet_ID, z.Liet_ID as zinas_Liet_ID FROM atsauksmes a
    JOIN zinas z ON z.ID = a.Zinas_ID
    WHERE a.ID = ?");
    $stmt->execute([$atsauksmes_id]);
    $atsauksme = $stmt->fetch();

    if ($atsauksme && isset($_SESSION['Liet_ID']) && ($_SESSION['Liet_ID'] === $atsauksme['Liet_ID'] || $_SESSION['Loma'] === 'Darbinieks' || $_SESSION['Loma'] === 'Administrators' || $_SESSION['Liet_ID'] === $atsauksme['zinas_Liet_ID'])) {
      $stmt = $pdo->prepare("DELETE FROM atsauksmes WHERE ID = ?");
      $stmt->execute([$atsauksmes_id]);
    }

    header("Location: zina.php?id=" . $id);
    exit;
}
// Atsauksmes dzēšana

// Atsauksmes pievienošana
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['teksts'])) {

    $teksts = trim($_POST['teksts']);
    $liet_id = $_SESSION['Liet_ID'] ?? 0;

    if (!empty($teksts)) {

        $stmt = $pdo->prepare("INSERT INTO atsauksmes (Liet_ID, Zinas_ID, teksts, izveidots)
                               VALUES (?, ?, ?, NOW())");
        $stmt->execute([$liet_id, $id, $teksts]);

        header("Location: zina.php?id=" . $id);
        exit;
    }
}
// Atsauksmes pievienošana

$stmt = $pdo->prepare("SELECT Nosaukums, Teksts, Bilde, Izveidots, Kategorija 
                        FROM zinas 
                        WHERE ID = ?");
$stmt->execute([$id]);
$zina = $stmt->fetch(); 

if (!$zina) {
    die("Ziņa neeksistē");
}
?>

<!-- Lapas saturs !-->
  <div class="container mt-5 pt-5">

    <div class="container mt-5 mb-5" style="width:70%;">
            <h1 class="text-center text-black">
                <?= htmlspecialchars($zina['Nosaukums']) ?>
            </h1>
            <h6 class="d-flex justify-content-between">
                <span>
                    <?= htmlspecialchars($zina['Kategorija']) ?>
                </span>
                <span class="mt-2"><em>
                    <?= htmlspecialchars($zina['Izveidots']) ?>
                </em></span>
            </h6>

        <?php if (!empty($zina['Bilde'])): ?>
        <img src="<?= htmlspecialchars($zina['Bilde']) ?>" style="width:100%;">
        <?php endif; ?>
    </div>
    
    <div class="container" style="width:80%;">
        <div class="text-black">
        <?= nl2br(htmlspecialchars($zina['Teksts'])) ?>
        </div>
    </div>

    <!-- Atsauksmes !-->
    <?php
$stmt = $pdo->prepare("SELECT a.ID as atsauksmesID, a.Liet_ID, a.Zinas_ID, a.teksts, a.izveidots, z.Liet_ID as zinas_Liet_ID,
                      l.*
                       FROM atsauksmes a
                       JOIN lietotaji l ON l.ID = a.Liet_ID
                       JOIN zinas z ON z.ID = a.Zinas_ID
                       WHERE a.Zinas_ID = ?
                       ORDER BY a.izveidots DESC");
$stmt->execute([$id]);
$atsauksmes = $stmt->fetchAll();
?>

<div class="container mt-5" style="width:80%;">
    <h3>Atsauksmes (<?= count($atsauksmes) ?>)</h3>

    <?php if ($atsauksmes): ?>
        <?php foreach ($atsauksmes as $a): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="mb-1">
                        <?= htmlspecialchars($a['Vards']) ?>
                    </h6>
                    <small class="text-muted">
                        <?= htmlspecialchars($a['izveidots']) ?>
                    </small>
                    <p class="mt-2">
                        <?= nl2br(htmlspecialchars($a['teksts'])) ?>
                    </p>

                    <?php
           

if (isset($_SESSION['Liet_ID']) && ($_SESSION['Liet_ID'] === $a['Liet_ID'] || $_SESSION['Loma'] === 'Darbinieks' || $_SESSION['Loma'] === 'Administrators' || $_SESSION['Liet_ID'] === $a['zinas_Liet_ID'])):
?>
    <form method="post" class="mt-2"
          onsubmit="return confirm('Vai tiešām vēlaties dzēst atsauksmi?');">
        <input type="hidden" name="dzest_atsauksmi"
               value="<?= $a['atsauksmesID'] ?>">
        <button type="submit"
                class="btn btn-sm btn-danger">
            Dzēst
        </button>
    </form>
<?php endif; ?>

                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Ziņai nav atsauksmju.</p>
    <?php endif; ?>
</div>
<?php if (isset($_SESSION['Liet_ID'])): ?>
<div class="container mt-4 mb-5" style="width:80%;">
    <h4>Pievienot atsauksmi</h4>

    <form method="post">
        <div class="mb-3">
            <textarea name="teksts" class="form-control" rows="4"
                placeholder="Raksti savu atsauksmi" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">
            Pievienot
        </button>
    </form>
</div>
<?php else: ?>
  <p><a href="login.php">Piesakies kontā</a>, lai pievienotu atsauksmi!</p>
<?php endif; ?>
  <!-- Atsauksmes !-->

  </div>
<!-- Lapas saturs !-->

  <?php if (isset($_SESSION['Vards'])): ?>
  <p>
    <a href="logout.php">Iziet</a>
  </p>
  <?php else: ?>
  <p><a href="register.php">Reģistrācija</a> | <a href="login.php">Pieslēgties</a></p>
  <?php endif; ?>

  <script src="https://cdn.jsdelivr.net/npm/mdb-ui-kit@9.2.0/js/mdb.umd.min.js"></script>
</body>

</html>