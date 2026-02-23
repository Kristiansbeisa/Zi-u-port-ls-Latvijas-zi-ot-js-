<?php
$category = 'lietotaju_zinas';
include 'conf.php';
include 'funkcijas.php';

$stmt = $pdo->query("
    SELECT z.Nosaukums, z.Teksts, l.Vards, z.Izveidots, z.Bilde, z.Svarigums, z.Kategorija, z.ID, z.Liet_ID
    FROM zinas z
    JOIN lietotaji l ON z.Liet_ID = l.ID
    WHERE Kategorija = 'Lietotāju ziņas'
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
    <link href="dizains.css" rel="stylesheet" />
</head>

<body>

    <?php
        navbar(1, "lietotaju_zinas");
        show_zinas($posts);
        show_terzetava();
    ?>

    <script src="https://cdn.jsdelivr.net/npm/mdb-ui-kit@9.2.0/js/mdb.umd.min.js"></script>
</body>

</html>