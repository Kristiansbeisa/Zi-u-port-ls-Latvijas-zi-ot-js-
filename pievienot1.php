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
$teksts    = $_POST['teksts'] ?? '';
$kategorija    = $_POST['kategorija'] ?? '';
$svarigums = $_POST['svarigums'] ?? 0;
$id = $_POST['id'] ?? null;
$bilde = $_POST['old_bilde'] ?? null;

$oldBilde = $_POST['old_bilde'] ?? null;

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
            Bilde = ?, 
            Svarigums = ?
        WHERE ID = ?
    ");

    $stmt->execute([
        $kategorija,
        $nosaukums,
        $teksts,
        $bilde,
        $svarigums,
        $id
    ]);

} else {

    // INSERT
    $stmt = $pdo->prepare("
        INSERT INTO zinas 
        (Liet_ID, Kategorija, Nosaukums, Teksts, Bilde, Svarigums)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $liet_id,
        $kategorija,
        $nosaukums,
        $teksts,
        $bilde,
        $svarigums
    ]);
}

header("Location: index.php");
exit;