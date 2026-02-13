<?php
require 'conf.php';
require 'log.php';

if (!isset($_SESSION['Liet_ID'])) {
    header("Location: login.php");
    exit;
}

$darbiba = $_POST['darbiba'] ?? $_GET['darbiba'] ?? '';

/* Pievienot */
if ($darbiba === 'pievienot') {
    check_csrf($_POST['csrf_token'] ?? ''); //csrf tokens
    $stmt = $pdo->prepare("
        INSERT INTO zinas (Liet_ID, Kat_ID, Nosaukums, Teksts, Izveidots)
        VALUES (:liet_id, :kat_id, :nosaukums, :teksts, NOW())
    ");
    $stmt->execute([
        ':liet_id'=>$_SESSION['Liet_ID'],
        ':kat_id'=>intval($_POST['kat_id']),
        ':nosaukums'=>trim($_POST['nosaukums']),
        ':teksts'=>trim($_POST['teksts'])
    ]);
    header("Location: index.php");
    exit;
}

/* Rediģēt */
if ($darbiba === 'rediget' && isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM zinas WHERE ID = :id AND Liet_ID = :liet_id");
    $stmt->execute([':id'=>intval($_GET['id']), ':liet_id'=>$_SESSION['Liet_ID']]);
    $z = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$z) die("Nav tiesību vai ziņa neeksistē");

    ?>
    <h2>Rediģēt ziņu</h2>
    <form method="post">
        <input type="hidden" name="darbiba" value="saglabat">
        <input type="hidden" name="id" value="<?php echo $z['ID']; ?>">
        Nosaukums:<br>
        <input type="text" name="nosaukums" value="<?php echo htmlspecialchars($z['Nosaukums']); ?>" required><br>
        Teksts:<br>
        <textarea name="teksts" required><?php echo htmlspecialchars($z['Teksts']); ?></textarea><br>
        Kategorija:<br>
        <select name="kat_id">
            <option value="2" <?php if ($z['Kat_ID']==2) echo 'selected'; ?>>Paziņojums</option>
            <option value="3" <?php if ($z['Kat_ID']==3) echo 'selected'; ?>>Jaunums</option>
            <option value="4" <?php if ($z['Kat_ID']==4) echo 'selected'; ?>>Brīdinājums</option>
            <option value="5" <?php if ($z['Kat_ID']==5) echo 'selected'; ?>>Cits</option>
        </select><br>
        <button type="submit">Saglabāt</button>
    </form>
    <p><a href="index.php">Atpakaļ</a></p>
    <?php
    exit;
}

if ($darbiba === 'saglabat' && isset($_POST['id'])) {
    check_csrf($_POST['csrf_token'] ?? ''); //csrf tokens
    $stmt = $pdo->prepare("
        UPDATE zinas SET Nosaukums = :nosaukums, Teksts = :teksts, Kat_ID = :kat_id, Atjauninats = NOW()
        WHERE ID = :id AND Liet_ID = :liet_id
    ");
    $stmt->execute([
        ':nosaukums'=>trim($_POST['nosaukums']),
        ':teksts'=>trim($_POST['teksts']),
        ':kat_id'=>intval($_POST['kat_id']),
        ':id'=>intval($_POST['id']),
        ':liet_id'=>$_SESSION['Liet_ID']
    ]);
    header("Location: index.php");
    exit;
}

/* Dzēst */
if ($darbiba === 'dzest' && isset($_POST['id'])) {
    check_csrf($_POST['csrf_token'] ?? ''); //csrf tokens
    $stmt = $pdo->prepare("DELETE FROM zinas WHERE ID = :id AND Liet_ID = :liet_id");
    $stmt->execute([
        ':id'=>intval($_POST['id']),
        ':liet_id'=>$_SESSION['Liet_ID']
    ]);
    header("Location: index.php");
    exit;
}

header("Location: index.php");
exit;