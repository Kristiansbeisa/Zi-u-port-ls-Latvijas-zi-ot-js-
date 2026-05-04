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
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("
        SELECT z.Nosaukums, z.Teksts, l.Vards, z.Izveidots, z.Bilde, z.Svarigums, z.ID, z.Kategorija
        FROM zinas z
        JOIN lietotaji l ON z.Liet_ID = l.ID
        WHERE z.ID = :id
        ORDER BY z.Izveidots DESC
    ");

    $stmt->execute(['id' => $id]);

    $post = $stmt->fetch();

} else {
    $stmt = $pdo->query("
        SELECT z.Nosaukums, z.Teksts, l.Vards, z.Izveidots, z.Bilde, z.Svarigums
        FROM zinas z
        JOIN lietotaji l ON z.Liet_ID = l.ID
        ORDER BY z.Izveidots DESC
    ");
    $posts = $stmt->fetchAll();
}


$kategorijas = ['Lietotāju ziņas'];

$Perm = isset($_SESSION['Loma']) && in_array($_SESSION['Loma'], ['Darbinieks', 'Administrators']);

if ($Perm) {
    $kategorijas = array_merge($kategorijas, [
        'Latvijā',
        'Laika ziņas',
        'Sports',
        'Politika',
        'Ārzemēs'
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
                    <h2>Pievienot ziņu</h2>
                </div>

                <div class="card-body text-center">
                    <form action="pievienot1.php" method="post" enctype="multipart/form-data">

                    <?php if (isset($_GET['id'])): ?>
                        <input type="hidden" name="id" value="<?= (int)$_GET['id'] ?>">
                        <input type="hidden" name="old_bilde" value="<?= htmlspecialchars($post['Bilde']) ?>">
                    <?php endif; ?>

                        <div class="form-outline mb-4" data-mdb-input-initialized="true" data-mdb-input-init="">
                            <input type="text" class="form-control" name="nosaukums" value="<?= isset($post['Nosaukums']) ? htmlspecialchars($post['Nosaukums']) : '' ?>" required="">
                            <label class="form-label" for="nosaukums" style="margin-left: 0px;">Nosaukums</label>
                            <div class="form-notch">
                                <div class="form-notch-leading" style="width: 9px;"></div>
                                <div class="form-notch-middle" style="width: 112px;"></div>
                                <div class="form-notch-trailing"></div>
                            </div>
                        </div>

                        <div class="form-outline mb-4" data-mdb-input-initialized="true" data-mdb-input-init="">
                            <input type="text" class="form-control" name="teksts" value="<?= isset($post['Nosaukums']) ? htmlspecialchars($post['Teksts']) : '' ?>" required="">
                            <label class="form-label" for="teksts" style="margin-left: 0px;">Teksts</label>
                            <div class="form-notch">
                                <div class="form-notch-leading" style="width: 9px;"></div>
                                <div class="form-notch-middle" style="width: 91.2px;"></div>
                                <div class="form-notch-trailing"></div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Izvēlies bildi</label>
                                <input type="file" name="file" class="form-control" <?= !isset($_GET['id']) ? 'required' : '' ?>>
                                <?php if (isset($post['Bilde']) && !empty($post['Bilde'])) { ?>
                                    <p>Pašreizējā bilde: <?= basename($post['Bilde']) ?></p>
                                <?php } ?>
                            </div>
                            <div class="col-md-6">
                                <select class="form-select mb-4" name="kategorija" required>
                                    <option value="">Kategorija</option>
                                    <?php foreach ($kategorijas as $kat): ?>
                                        <option value="<?= htmlspecialchars($kat) ?>" <?= (isset($post['Kategorija']) && $post['Kategorija'] == $kat) ? 'selected' : '' ?>><?= htmlspecialchars($kat) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <?php if($Perm): ?>
                        <select class="form-select mb-5" name="svarigums" id="account" value="<?= htmlspecialchars($post['Svarigums']) ?>" required="">
                            <option value="">Svarigums</option>
                            <option value="0" <?= (isset($post['Svarigums']) && $post['Svarigums'] == 0) ? 'selected' : '' ?>>0</option>
                            <option value="1" <?= (isset($post['Svarigums']) && $post['Svarigums'] == 1) ? 'selected' : '' ?>>1</option>
                        </select>
                        <?php endif; ?>

                        <button type="submit" class="btn btn-primary">Saglabāt</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <script src="https://cdn.jsdelivr.net/npm/mdb-ui-kit@9.2.0/js/mdb.umd.min.js"></script>
</body>

</html>