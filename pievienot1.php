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
$bilde     = $_POST['bilde'] ?? '';
$kategorija    = $_POST['kategorija'] ?? '';
$svarigums = $_POST['svarigums'] ?? 0;

if (!$Perm && $kategorija !== 'Lietotāju ziņas') {
    header("Location: index.php");
    exit;
}

if (!$nosaukums || !$teksts || !$kategorija) {
    die("Aizpildi visus laukus");
}

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

header("Location: index.php");
exit;