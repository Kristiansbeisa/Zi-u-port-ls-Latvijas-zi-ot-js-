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

    if ($atsauksme && isset($_SESSION['Liet_ID']) && ($_SESSION['Liet_ID'] == $atsauksme['Liet_ID'] || $_SESSION['Loma'] === 'Darbinieks' || $_SESSION['Loma'] === 'Administrators' || $_SESSION['Liet_ID'] == $atsauksme['zinas_Liet_ID'])) {
      $stmt = $pdo->prepare("DELETE FROM atsauksmes WHERE ID = ?");
      $stmt->execute([$atsauksmes_id]);
    }

    $_SESSION['negative_alert_text'] = 'Atsauksme tika dzēsta!';

    header("Location: zina.php?id=" . $id);
    exit;
}
// Atsauksmes dzēšana

// Atsauksmes rediģēšana
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rediget_atsauksmi'])) {

    $atsauksmes_id = (int)$_POST['rediget_atsauksmi'];
    $teksts = $_POST['red_ats_input'];

    $stmt = $pdo->prepare("SELECT a.Liet_ID, z.Liet_ID as zinas_Liet_ID FROM atsauksmes a
    JOIN zinas z ON z.ID = a.Zinas_ID
    WHERE a.ID = ?");
    $stmt->execute([$atsauksmes_id]);
    $atsauksme = $stmt->fetch();

    if ($atsauksme && isset($_SESSION['Liet_ID']) && ($_SESSION['Liet_ID'] == $atsauksme['Liet_ID'])) {
        $stmt = $pdo->prepare("UPDATE atsauksmes SET teksts = ? WHERE ID = ?");
        $stmt->execute([$teksts, $atsauksmes_id]);
    }

    $_SESSION['positive_alert_text'] = 'Jūsu atsauksme tika rediģēta!';

    header("Location: zina.php?id=" . $id);
    exit;
}
// Atsauksmes rediģēšana

// Atsauksmes pievienošana
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['teksts'])) {

    $teksts = trim($_POST['teksts']);
    $liet_id = $_SESSION['Liet_ID'] ?? 0;

    if (!empty($teksts)) {

        $stmt = $pdo->prepare("INSERT INTO atsauksmes (Liet_ID, Zinas_ID, teksts, izveidots)
                               VALUES (?, ?, ?, NOW())");
        $stmt->execute([$liet_id, $id, $teksts]);

        $_SESSION['positive_alert_text'] = 'Jūsu atsauksme tika pievienota!';

        header("Location: zina.php?id=" . $id);
        exit;
    }
}
// Atsauksmes pievienošana

// Vērtējuma pievienošana
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['vertejums'] === '1') {

    $liet_id = $_SESSION['Liet_ID'];
    $zinas_id = $id;
    $vertejums = $_POST['vertiba'];

    if ($vertejums < 1 || $vertejums > 5) {
        die("Nederīgs vērtējums");
    }

    $stmt = $pdo->prepare("SELECT * FROM zinu_vertejumi 
    WHERE Liet_ID=? AND Zinas_id=?");
    $stmt->execute([$liet_id, $zinas_id]);

    if (!$stmt->fetch()) {
        $stmt = $pdo->prepare("INSERT INTO zinu_vertejumi (Liet_ID, Zinas_id, Vertejums) VALUES (?, ?, ?)");
        $stmt->execute([$liet_id, $zinas_id, $vertejums]);
    }

    $stmt = $pdo->prepare("SELECT AVG(Vertejums) AS avg, COUNT(*) AS count
    FROM zinu_vertejumi
    WHERE Zinas_id = ?
");
$stmt->execute([$zinas_id]);
$dati = $stmt->fetch();

$stmt = $pdo->prepare("UPDATE zinas 
    SET videjais_vertejums = ?, vertejumu_skaits = ?
    WHERE ID = ?
");
$stmt->execute([$dati['avg'], $dati['count'], $zinas_id]);

    $_SESSION['positive_alert_text'] = 'Jūsu vērtējums tika pievienots!';

    header("Location: zina.php?id=" . $zinas_id);
    exit();
}
// Vērtējuma pievienošana


$stmt = $pdo->prepare("SELECT Nosaukums, Teksts, Maksas_Teksts, Bilde, Izveidots, Kategorija, Galerija, videjais_vertejums
                        FROM zinas 
                        WHERE ID = ?");
$stmt->execute([$id]);
$zina = $stmt->fetch();

$userRating = null;
if (isset($_SESSION['Liet_ID'])) {
    $stmt = $pdo->prepare(" SELECT Vertejums 
                            FROM zinu_vertejumi 
                            WHERE Liet_ID = ? 
                            AND Zinas_ID = ? "); 
    $stmt->execute([ $_SESSION['Liet_ID'], $id ]); 
    $userRating = $stmt->fetchColumn(); 
}

if (!$zina) {
    die("Ziņa neeksistē");
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
  <link href="dizains.css" rel="stylesheet" />
</head>

<body>

  <?php
        navbar();

        if (isset($_SESSION['positive_alert_text'])) {
            positive_alert('zina', $_SESSION['positive_alert_text']);
            unset($_SESSION['positive_alert_text']);
        }

        if (isset($_SESSION['negative_alert_text'])) {
            negative_alert('index', $_SESSION['negative_alert_text']);
            unset($_SESSION['negative_alert_text']);
        }
    ?>

<?php rediget_atsauksmi(); ?>
<script>

function openModal(id, teksts) {
    document.getElementById('red_ats_input').value = teksts;
    document.getElementById('modal_red_ats_id').value = id;

    let modal = new mdb.Modal(document.getElementById('red_ats_modal'));
    modal.show();
}
</script>
<!-- Lapas saturs !-->
  <div class="container mt-lg-5 pt-lg-5">

    <div class="container mt-5" id="zinaskonteiners">
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
            <div class="rounded overflow-hidden shadow-sm mt-3" style=" width:100%; max-height:600px; ">
                <img src="<?= htmlspecialchars($zina['Bilde']) ?>" class="img-fluid w-100" style=" max-height:600px; object-fit:cover; display:block; aspect-ratio:16/9;">
            </div>
            <?php endif; ?>
    </div>

    <!-- Vērtējums !-->
    <div class="container d-flex justify-content-between" id="vertejumakonteiners" style="min-height:72px;">
        <div class="row mb-4" style="width:100%;">
    <div class="col-md-6 d-flex justify-content-start align-items-center">
        <?php if (isset($_SESSION['Liet_ID'])):
            if ($userRating !== false && $userRating !== null): ?>
            <p class="text-black me-2 mb-0"> Tavs vērtējums:</p>
        <?php endif; ?>
        <form method="POST">
            <input type="hidden" name="vertejums" value="1">
            <div class="rating">
                <?php for ($i = 5; $i >= 1; $i--): ?>
                    <input type="radio" name="vertiba" value="<?= $i ?>" id="star<?= $i ?>" 
                        <?= ($userRating == $i) ? 'checked' : '' ?> <?= ($userRating !== false && $userRating !== null) ? 'disabled' : '' ?> 
                        <?php if ($userRating === false || $userRating === null): ?> 
                            onclick="this.form.submit()" 
                        <?php endif; ?> > 
                    <label for="star<?= $i ?>"> ★ </label>
                <?php endfor; ?>
            </div>
        </form>
        <?php endif; ?>
    </div>
    <div id="zinasvidvertejums" class="col-md-6 d-flex align-items-center">
        <p class="text-black mb-0">Ziņas vidējais vērtējums: <?= htmlspecialchars($zina['videjais_vertejums']) ?></p>
    </div>
    </div>
                        </div>
    <!-- Vērtējums !-->
    
    <div class="container" id="zinasteksts">
        <div class="text-black">
        <?= nl2br(htmlspecialchars($zina['Teksts'])) ?>
        <?php if (isset($zina['Maksas_Teksts'])): 
            if (isset($_SESSION['Liet_id'])):
                if (isset($_SESSION['Abonements']) || $_SESSION['Loma'] === 'Darbinieks' || $_SESSION['Loma'] === 'Administrators'):?>
                    <?= nl2br(htmlspecialchars($zina['Maksas_Teksts'])) ?>
                <?php else: ?>
                    <p style="margin-bottom: 150px;"><a href="abonementi.php">Iegādājaties abonementu</a>, lai turpinātu lasīt ziņu!</p>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
        </div>
    </div>


    <?php 
    $galleryFiles = []; 
    if (!empty($zina['Galerija']) && is_dir($zina['Galerija'])) { 
        $galleryFiles = array_values(array_diff( scandir($zina['Galerija']), ['.', '..'] )); 
    }
    if (!empty($galleryFiles)): ?> 
        <div class="mt-5 container" style="width:80%;"> 
            <h4 class="mb-3">Galerija</h4> 
            <div class="d-flex gap-3 overflow-auto pb-2" id="galleryScroll">
                <?php foreach ($galleryFiles as $index => $file): $filePath = $zina['Galerija'] . '/' . $file; 
                    $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION)); 
                    $isVideo = in_array($extension, ['mp4', 'webm', 'ogg']); ?> 
                    <div class="flex-shrink-0"> 
                        <?php if ($isVideo): ?> 
                            <video class="gallery-video" src="<?= htmlspecialchars($filePath) ?>" controls style=" width:220px; height:140px; object-fit:cover; border-radius:10px; background:black; "></video> 
                        <?php else: ?>
                            <img src="<?= htmlspecialchars($filePath) ?>" class="gallery-image" data-index="<?= $index ?>" style=" width:220px; height:140px; object-fit:cover; border-radius:10px; cursor:pointer; "> 
                        <?php endif; ?> 
                    </div> 
                <?php endforeach; ?> 
            </div> 
        </div> 
        <!-- MODAL !-->
        <div class="modal fade" id="galleryModal" tabindex="-1" style="max-height:100%; overflow:hidden;">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content border-0">
                    <div class="modal-header text-black d-flex justify-content-between">
                        <h5 class="modal-title" id="galleryModal">Galerija</h5>
                        <div class="d-flex justify-content-between">
                            <div id="fileCounter" class="mx-3 px-3 py-1 bg-dark text-white rounded z-3">1 / 1</div>
                            <button type="button" class="btn-close m-0" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="modal-body position-relative text-center p-0 d-flex align-items-center justify-content-center" style="height:80vh; overflow:hidden;">
                        <button type="button" id="prevImage" class="btn btn-dark position-absolute top-50 start-0 translate-middle-y z-3 p-3"> <i class="fa-solid fa-chevron-down fa-rotate-90" style="font-size:20px;"></i> </button>
                        <button type="button" id="nextImage" class="btn btn-dark position-absolute top-50 end-0 translate-middle-y z-3 p-3"> <i class="fa-solid fa-chevron-down fa-rotate-270" style="font-size:20px;"></i> </button>
                        <img id="modalImage" src="" style="width:100%; height:100%; object-fit:contain; ">
                        <video id="modalVideo" controls style="max-width:100%; max-height:100%; object-fit:contain; display:none;"></video>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const galleryFiles = <?= json_encode(array_values(array_map(function($file) use ($zina) {
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                return [ 'path' => $zina['Galerija'] . '/' . $file, 'isVideo' => in_array($ext, ['mp4', 'webm', 'ogg'])];
            }, $galleryFiles))) ?>;

let currentIndex = 0;

const modalImage = document.getElementById('modalImage');
const modalVideo = document.getElementById('modalVideo');
const fileCounter = document.getElementById('fileCounter');

document.querySelectorAll('.gallery-image, .gallery-video').forEach((item, index) => {

    item.addEventListener('click', function () {

        currentIndex = index;

        showFile();

        const modal = new mdb.Modal(document.getElementById('galleryModal'));

        modal.show();
    });
});

function showFile() {

    const file = galleryFiles[currentIndex];

    if (file.isVideo) {

        modalImage.style.display = 'none';

        modalVideo.style.display = 'block';

        modalVideo.src = file.path;

    } else {

        modalVideo.style.display = 'none';

        modalVideo.pause();

        modalImage.style.display = 'block';

        modalImage.src = file.path;
    }
    fileCounter.innerText = `${currentIndex + 1} / ${galleryFiles.length}`;
}

document.getElementById('prevImage').addEventListener('click', function () {

    currentIndex--;

    if (currentIndex < 0) {
        currentIndex = galleryFiles.length - 1;
    }

    showFile();
});

document.getElementById('nextImage').addEventListener('click', function () {

    currentIndex++;

    if (currentIndex >= galleryFiles.length) {
        currentIndex = 0;
    }

    showFile();
});

</script>
        <script> const galleryScroll = document.getElementById('galleryScroll'); galleryScroll.addEventListener('wheel', function(e) { e.preventDefault(); galleryScroll.scrollLeft += e.deltaY; }); </script>
    <?php endif; ?>



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

<div id="zinasatsauksmes" class="container mt-5">
    <h3 class="text-black">Atsauksmes (<?= count($atsauksmes) ?>)</h3>

    <?php if ($atsauksmes): ?>
        <?php foreach ($atsauksmes as $a): ?>
            <div class="card mb-3 shadow-5-strong">
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
           

if (isset($_SESSION['Liet_ID']) && (($_SESSION['Liet_ID'] == $a['Liet_ID']) || $_SESSION['Loma'] === 'Darbinieks' || $_SESSION['Loma'] === 'Administrators' || $_SESSION['Liet_ID'] == $a['zinas_Liet_ID'])):?>
<div class="d-flex justify-content-start gap-3">
    <form method="post" class="mt-2"
          onsubmit="return confirm('Vai tiešām vēlaties dzēst atsauksmi?');">
        <input type="hidden" name="dzest_atsauksmi"
               value="<?= $a['atsauksmesID'] ?>">
        <button type="submit"
                class="btn btn-sm btn-danger">
            Dzēst
        </button>
    </form>
    <?php if (isset($_SESSION['Liet_ID']) && ($_SESSION['Liet_ID'] == $a['Liet_ID']) && ($_SESSION['Loma'] === 'Darbinieks' || $_SESSION['Loma'] === 'Administrators')):?>
        <div class="mt-2">
            <button class="btn btn-sm btn-primary red-btn" data-id="<?= $a['atsauksmesID'] ?>" data-teksts="<?= htmlspecialchars($a['teksts'], ENT_QUOTES) ?>">Rediģēt</button>
        </div>
    <?php endif; ?>
</div>
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
    <div class="container mt-4 mb-5" style="width:80%;">
        <p style="margin-bottom: 150px;"><a href="login.php">Piesakies kontā</a>, lai pievienotu atsauksmi!</p>
    </div>
<?php endif; ?>
  <!-- Atsauksmes !-->

  </div>
<!-- Lapas saturs !-->

  <script>
    document.querySelectorAll('.red-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        openModal(
            this.dataset.id,
            this.dataset.teksts
        );
    });
});  
  </script>

  <script src="https://cdn.jsdelivr.net/npm/mdb-ui-kit@9.2.0/js/mdb.umd.min.js"></script>
</body>

</html>