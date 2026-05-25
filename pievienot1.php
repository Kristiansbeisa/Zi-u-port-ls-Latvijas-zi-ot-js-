<?php
require 'conf.php';
require 'log.php';

if (!isset($_SESSION['Liet_ID'])) {
    header("Location: index.php");
    exit;
}

$kategorija = $_POST['kategorija'] ?? '';

$Perm = in_array($_SESSION['Loma'], ['Darbinieks', 'Administrators']);

$liet_id = $_SESSION['Liet_ID'] ?? 1;

$nosaukums = $_POST['nosaukums'] ?? '';
$teksts = $_POST['teksts'] ?? '';
$maksasteksts = $_POST['maksas_teksts'] ?? null;
$kategorija    = $_POST['kategorija'] ?? '';
$svarigums = $_POST['svarigums'] ?? 0;
$id = $_POST['id'] ?? null;
$bilde = $_POST['old_bilde'] ?? null;

$galleryPath = null;
$oldBilde = $_POST['old_bilde'] ?? null;
$oldGalerija = $_POST['old_galerija'] ?? null;

// faila saglabāšana
if (isset($_FILES["file"]) && $_FILES["file"]["error"] === UPLOAD_ERR_OK) {

    $fileName = basename($_FILES["file"]["name"]);

    // JA IR VECA BILDE → izmanto esošo mapi
    if (!empty($oldBilde)) {
        $fullPath = dirname($oldBilde); // mape no esošā faila
    } 
    // JA NAV VECA BILDE → veido jaunu mapi
    else {
        $baseDir = "bildes/";

        $folderName = $nosaukums;
        $counter = 1;

        while (file_exists($baseDir . $folderName)) {
            $folderName = $nosaukums . "_" . $counter;
            $counter++;
        }

        $fullPath = $baseDir . $folderName;
        mkdir($fullPath, 0777, true);
    }

    $bilde = $fullPath . "/" . $fileName;

    move_uploaded_file($_FILES["file"]["tmp_name"], $bilde);
}

// faila saglabāšana

// GALERIJAS FAILU SAGLABĀŠANA
$galerijaFaili = [];

if (empty($oldGalerija)) {
        $galleryPath = $fullPath . "/galerija";
} else {
    $galleryPath = $oldGalerija;
}

if (isset($_FILES['galerija']) && !empty($_FILES['galerija']['name'][0])) {

    // izveido galerijas mapi, ja nav
    if (!is_dir($galleryPath)) {
        mkdir($galleryPath, 0777, true);
    }

    // cikls cauri visiem failiem
    foreach ($_FILES['galerija']['name'] as $key => $fileName) {

        // izlaiž tukšus failus
        if ($_FILES['galerija']['error'][$key] !== UPLOAD_ERR_OK) {
            continue;
        }

        $tmpName = $_FILES['galerija']['tmp_name'][$key];

        // drošs faila nosaukums
        $safeName = basename($fileName);

        // pilnais ceļš
        $targetFile = $galleryPath . "/" . $safeName;

        // saglabā failu
        if (move_uploaded_file($tmpName, $targetFile)) {
            $galerijaFaili[] = $targetFile;
        }
    }
}

if (isset($_POST['delete_gallery']) && isset($_POST['id'])) { 
    $id = (int)$_POST['id']; 
    $file = basename($_POST['delete_gallery']); 
    $stmt = $pdo->prepare(" SELECT Galerija FROM zinas WHERE ID = ? "); 
    $stmt->execute([$id]); $post = $stmt->fetch(); 
    if ($post && !empty($post['Galerija'])) { 
        $fullFilePath = $post['Galerija'] . '/' . $file; 
        if (file_exists($fullFilePath)) { 
            unlink($fullFilePath); 
        } 
    } exit; 
}

if (!$Perm && $kategorija !== 'Lietotāju ziņas') {
    header("Location: index.php");
    exit;
}

if (!$nosaukums || !$teksts || !$kategorija) {
    die("Aizpildi visus laukus");
}

if ($id) {

    // UPDATE
    $stmt = $pdo->prepare("
        UPDATE zinas 
        SET Kategorija = ?, 
            Nosaukums = ?, 
            Teksts = ?, 
            Maksas_Teksts = ?,
            Bilde = ?, 
            Galerija = ?,
            Svarigums = ?
        WHERE ID = ?
    ");

    $stmt->execute([
        $kategorija,
        $nosaukums,
        $teksts,
        $maksasteksts,
        $bilde,
        $oldGalerija,
        $svarigums,
        $id
    ]);
    $_SESSION['positive_alert_text'] = 'Jūsu ziņa tika veiksmīgi rediģēta!';

} else {

    // INSERT
    $stmt = $pdo->prepare("
        INSERT INTO zinas 
        (Liet_ID, Kategorija, Nosaukums, Teksts, Maksas_Teksts, Bilde, Galerija, Svarigums)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $liet_id,
        $kategorija,
        $nosaukums,
        $teksts,
        $maksasteksts,
        $bilde,
        $galleryPath,
        $svarigums
    ]);
    $_SESSION['positive_alert_text'] = 'Jūsu ziņa tika veiksmīgi izveidota!';
}



header("Location: index.php");
exit;