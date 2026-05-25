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
        SELECT z.Nosaukums, z.Teksts, z.Maksas_Teksts, l.Vards, z.Izveidots, z.Bilde, z.Svarigums, z.ID, z.Kategorija, z.Galerija
        FROM zinas z
        JOIN lietotaji l ON z.Liet_ID = l.ID
        WHERE z.ID = :id
        ORDER BY z.Izveidots DESC
    ");

    $stmt->execute(['id' => $id]);

    $post = $stmt->fetch();

} else {
    $stmt = $pdo->query("
        SELECT z.Nosaukums, z.Teksts, z.Maksas_Teksts, l.Vards, z.Izveidots, z.Bilde, z.Svarigums, z.Galerija
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
    <link href="dizains.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>

  <?php
        navbar();
    ?>

    <div class="container mt-5">

        <div class="row">
            <div class="col-lg-8 mb-4">
            <div class="card shadow-6-strong">
                <div class="card-header text-center">
                    <h2>Pievienot ziņu</h2>
                </div>

                <div class="card-body text-center">
                    <form id="pievienot_forma" action="pievienot1.php" method="post" enctype="multipart/form-data" novalidate>

                    <?php form_negative_alert('pievienot_forma', 'pievienot_alert', 'Lūdzu aizpildiet visus obligātos laukus!')?>

                    <?php if (isset($_GET['id'])): ?>
                        <input type="hidden" name="id" value="<?= (int)$_GET['id'] ?>">
                        <input type="hidden" name="old_bilde" value="<?= htmlspecialchars($post['Bilde']) ?>">
                        <input type="hidden" name="old_galerija" value="<?= htmlspecialchars($post['Galerija']) ?>">
                    <?php endif; ?>

                        <div class="form-outline mb-4" data-mdb-input-initialized="true" data-mdb-input-init="">
                            <input type="text" class="form-control" name="nosaukums" value="<?= isset($post['Nosaukums']) ? htmlspecialchars($post['Nosaukums']) : '' ?>" required="">
                            <label class="form-label" for="nosaukums" style="margin-left: 0px;">Nosaukums*</label>
                            <div class="form-notch">
                                <div class="form-notch-leading" style="width: 9px;"></div>
                                <div class="form-notch-middle" style="width: 112px;"></div>
                                <div class="form-notch-trailing"></div>
                            </div>
                        </div>

                        <div class="form-outline mb-4" data-mdb-input-initialized="true" data-mdb-input-init="">
                            <textarea class="form-control" name="teksts" rows="4" required=""><?= isset($post['Teksts']) ? htmlspecialchars($post['Teksts']) : '' ?></textarea>
                            <label class="form-label" for="teksts" style="margin-left: 0px;">Teksts*</label>
                            <div class="form-notch">
                                <div class="form-notch-leading" style="width: 9px;"></div>
                                <div class="form-notch-middle" style="width: 91.2px;"></div>
                                <div class="form-notch-trailing"></div>
                            </div>
                        </div>

                        <?php if ($Perm): ?>
                        <div class="form-outline mb-4" data-mdb-input-initialized="true" data-mdb-input-init="">
                            <textarea class="form-control" name="maksas_teksts" rows="4"><?= isset($post['Maksas_Teksts']) ? htmlspecialchars($post['Maksas_Teksts']) : '' ?></textarea>
                            <label class="form-label" for="maksas_teksts" style="margin-left: 0px;">Maksas teksts</label>
                            <div class="form-notch">
                                <div class="form-notch-leading" style="width: 9px;"></div>
                                <div class="form-notch-middle" style="width: 91.2px;"></div>
                                <div class="form-notch-trailing"></div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="row mb-4">
                            <div class="col-md-5 mb-4">
                                <label class="form-label">Galvenais attēls*</label>
                                <input type="file" name="file" class="form-control" <?= !isset($_GET['id']) ? 'required' : '' ?> style="height:37px;">
                                <?php if (isset($post['Bilde']) && !empty($post['Bilde'])) { ?>
                                    <p>Pašreizējais attēls <?= basename($post['Bilde']) ?></p>
                                <?php } ?>
                            </div>
                            <div class="col-md-5 mb-4">
                                <label class="form-label">Kategorija*</label>
                                <select class="form-select" name="kategorija" required style="height:37px;">
                                    <option value=""></option>
                                    <?php foreach ($kategorijas as $kat): ?>
                                        <option value="<?= htmlspecialchars($kat) ?>" <?= (isset($post['Kategorija']) && $post['Kategorija'] == $kat) ? 'selected' : '' ?>><?= htmlspecialchars($kat) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?php if($Perm): ?>
                                <div class="col-md-2">
                                    <label class="form-label">Svarīgums*</label>
                                    <select class="form-select" name="svarigums" id="account" value="<?= htmlspecialchars($post['Svarigums']) ?>" required="" style="height:37px;">
                                        <option value=""></option>
                                        <option value="0" <?= (isset($post['Svarigums']) && $post['Svarigums'] == 0) ? 'selected' : '' ?>>0</option>
                                        <option value="1" <?= (isset($post['Svarigums']) && $post['Svarigums'] == 1) ? 'selected' : '' ?>>1</option>
                                    </select>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-2"> 
                                <label class="form-label">Galerija</label>
                                <input type="file" name="galerija[]" multiple class="form-control" style="height:37px;"> 
                            </div>
                            <div class="col-md-6">
                                <div id="galleryFiles">
                                <p>Augšupielādētie faili:</p>
                                <?php if (!empty($post['Galerija']) && is_dir($post['Galerija'])) { 
                                    $files = array_diff(scandir($post['Galerija']), ['.', '..']); 
                                    if (!empty($files)) { 
                                        foreach ($files as $file) { 
                                            $filePath = $post['Galerija'] . '/' . $file; ?> 
                                            <div class="d-flex align-items-center justify-content-between mb-2 p-2">
                                                <a href="<?= htmlspecialchars($filePath) ?>" target="_blank" class="text-truncate me-3" style="max-width: 80%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"> <?= htmlspecialchars($file) ?></a> 
                                                <button type="button" class="btn btn-danger btn-sm delete-gallery-file flex-shrink-0" data-file="<?= htmlspecialchars($file) ?>" data-id="<?= (int)$post['ID'] ?>"> Dzēst </button>
                                            </div> <?php 
                                        } 
                                    } else { 
                                        echo '<p class="text-muted">Nav augšupielādētu failu</p>'; 
                                    } 
                                } else { 
                                    echo '<p class="text-muted">Nav augšupielādētu failu</p>'; 
                                } ?> 
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Saglabāt</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card shadow-6-strong">
                <div class="card-header text-center">
                    <h2>Informācija</h2>
                </div>

                <div class="card-body text-center">
                    <p>Ar * ir apzīmēti obligāti aizpildāmie lauki</p>
                    <p>Galerijā attēlus un video kopā var augšupielādēt līdz 40 MB</p>
                </div>
            </div>
            </div>
        </div>
    </div>

    <script> 
    $(document).on('click', '.delete-gallery-file', function () { if (!confirm('Dzēst failu?')) { 
        return; 
    } 
    const file = $(this).data('file'); 
    const id = $(this).data('id'); 
    $.ajax({ 
        url: 'pievienot1.php', 
        type: 'POST', 
        data: { 
            delete_gallery: file, 
            id: id }, 
            success: function () {
                $("#galleryFiles").load( location.href + " #galleryFiles > *" ); 
            }, 
            error: function () { 
                alert('Kļūda dzēšot failu'); 
            } 
        }); 
    }); 
    </script>

        <script src="https://cdn.jsdelivr.net/npm/mdb-ui-kit@9.2.0/js/mdb.umd.min.js"></script>
</body>

</html>