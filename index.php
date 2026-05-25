<?php

$category = 'jaunakais';
?>
<?php
include 'conf.php';
include 'funkcijas.php';

if (isset($_GET['savas_zinas'])) {

    $stmt = $pdo->prepare("
        SELECT z.ID, z.Nosaukums, z.Teksts, l.Vards, z.Liet_ID,
               z.Izveidots, z.Bilde, z.Svarigums, z.Kategorija
        FROM zinas z
        JOIN lietotaji l ON z.Liet_ID = l.ID
        WHERE z.Liet_ID = ?
        ORDER BY z.Izveidots DESC
    ");

    $stmt->execute([$_SESSION['Liet_ID']]);

} elseif (isset($_GET['meklet_zinas'])) {
    $meklet = trim($_GET['meklet_zinas']);

    $stmt = $pdo->prepare("
    SELECT z.ID, z.Nosaukums, z.Teksts, l.Vards, z.Liet_ID,
           z.Izveidots, z.Bilde, z.Svarigums, z.Kategorija
    FROM zinas z
    JOIN lietotaji l ON z.Liet_ID = l.ID
    WHERE z.Kategorija <> 'Lietotāju ziņas'
    AND z.Nosaukums LIKE ?
    ORDER BY z.Izveidots DESC
    ");

    $stmt->execute(["%$meklet%"]);
} 
else {
    $stmt = $pdo->query("
    SELECT z.ID, z.Nosaukums, z.Teksts, l.Vards, z.Liet_ID,
           z.Izveidots, z.Bilde, z.Svarigums, z.Kategorija
    FROM zinas z
    JOIN lietotaji l ON z.Liet_ID = l.ID
    WHERE z.Kategorija <> 'Lietotāju ziņas'
    ORDER BY z.Izveidots DESC
");
}

$posts = $stmt->fetchAll();

if (empty($posts)) {
    $_SESSION['negative_alert_text'] = 'Netika atrasta neviena ziņa!';
    header("Location: index.php");
    exit();
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
        navbar(1);
        if (!empty($posts)) {
            show_zinas($posts);
        } else {
            header("Location: index.php");
        }
        show_terzetava();

        if (isset($_SESSION['positive_alert_text'])) {
            positive_alert('index', $_SESSION['positive_alert_text']);
            unset($_SESSION['positive_alert_text']);
        }

        if (isset($_SESSION['negative_alert_text'])) {
            negative_alert('index', $_SESSION['negative_alert_text']);
            unset($_SESSION['negative_alert_text']);
        }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/mdb-ui-kit@9.2.0/js/mdb.umd.min.js"></script>
    <script src="js/mdb.min.js"></script>
</body>

</html>