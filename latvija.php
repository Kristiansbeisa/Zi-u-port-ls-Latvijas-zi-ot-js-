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
    SELECT z.Nosaukums, z.Teksts, l.Vards, z.Izveidots, z.Bilde, z.Svarigums, z.Kategorija, z.ID
    FROM zinas z
    JOIN lietotaji l ON z.Liet_ID = l.ID
    WHERE Kategorija = 'Latvijā'
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

    <button class="navbar-toggler d-md-none" type="button"
      data-mdb-collapse-init
      data-mdb-target="#navbarMenu"
      aria-controls="navbarMenu"
      aria-expanded="false"
      aria-label="Toggle navigation"
      style="z-index:9999;">
      <i class="fas fa-bars"></i>
    </button>

  </div>
</nav>

<!-- mobile menu -->
<div class="collapse fullscreen-menu d-md-none" id="navbarMenu">
  <ul class="navbar-nav text-center mt-5">
    <li class="nav-item"><a class="nav-link active" href="#">Sākums</a></li>
    <li class="nav-item"><a class="nav-link" href="#">Kategorija1</a></li>
    <li class="nav-item"><a class="nav-link" href="#">Kategorija2</a></li>
    <li class="nav-item"><a class="nav-link" href="#">Kategorija3</a></li>
    <li class="nav-item"><a class="nav-link" href="#">Kategorija4</a></li>
  </ul>
</div>

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
            <?php
$featuredIds = [];
$featuredCount = 0;

foreach ($posts as $post):
    if ($post['Kategorija'] == "Latvijā" && $post['Svarigums'] == 1 && $featuredCount < 2):
        $featuredCount++;
        $featuredIds[] = $post['Izveidots'];
?>
            <div class="col-lg-6 d-flex mb-4">
                <div class="card border border-white h-100 w-100 shadow-0">

                    <a href="zina.php?id=<?= $post['ID'] ?>">
                        <div class="big-card-img-format">
                            <img src="<?= htmlspecialchars($post['Bilde']) ?>" class="card-img-top">
                        </div>
                    </a>

                    <div class="card-body">
                        <a href="zina.php?id=<?= $post['ID'] ?>" class="text-decoration-none text-dark">
                            <h3 class="text-center mb-4">
                                <?= htmlspecialchars($post['Nosaukums']) ?>
                            </h3>
                        </a>
                        <h6 class="text-end">
                            <?= htmlspecialchars($post['Izveidots']) ?>
                        </h6>
                    </div>

                </div>
            </div>
            <?php
    endif;
endforeach;
?>
        </div>

        <div class="row">
            <?php
$shownFeatured = 0;

foreach ($posts as $post):

    if ($post['Kategorija'] == "Latvijā" && $post['Svarigums'] == 1 && $shownFeatured < 2) {
        $shownFeatured++;
        continue;
    }
?>
            <div class="col-lg-4 d-flex mb-4">
                <div class="card border border-white h-100 w-100 shadow-0">

                    <a href="zina.php?id=<?= $post['ID'] ?>">
                        <div class="small-card-img-format">
                            <img src="<?= htmlspecialchars($post['Bilde']) ?>" class="card-img-top">
                        </div>
                    </a>

                    <div class="card-body">
                        <a href="zina.php?id=<?= $post['ID'] ?>" class="text-decoration-none text-dark">
                            <h4 class="text-center mb-4">
                                <?= htmlspecialchars($post['Nosaukums']) ?>
                            </h4>
                        </a>
                        <h6 class="text-end">
                            <?= htmlspecialchars($post['Izveidots']) ?>
                        </h6>
                    </div>

                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>

    <style>
        .small-card-img-format {
            width: 100%;
            height: 220px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .small-card-img-format img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            border-radius: 0.5rem;
        }

        .big-card-img-format {
            width: 100%;
            height: 350px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .big-card-img-format img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            border-radius: 0.5rem;
        }
    </style>

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