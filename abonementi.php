<?php 
require 'vendor/autoload.php';
include 'funkcijas.php';

\Stripe\Stripe::setApiKey('sk_test_51TZFQ0R5idzHA5DAI1KaAQnWAbKg5L8L7sUguWJniMcsWHAGpGyTdwCofvKrKm8Ed2egp7BhmUPPnHZIXdshLIp3008qdkS0pY');

$host = "localhost";
$db = "beisadb"; $user = "root";
$pass = "";
try { 
    $pdo = new PDO( "mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("DB connection failed: " . $e->getMessage());
} 

session_start();

if (!isset($_SESSION['Liet_ID']) || isset($_SESSION['Abonements'])) {
    header("Location: login.php"); exit;
} 

if (isset($_GET['success']) && isset($_SESSION['sub_days'])) {

    $liet_id = $_SESSION['Liet_ID'];
    $dienas = (int)$_SESSION['sub_days'];
    $sakums = date("Y-m-d");
    $beigas = date("Y-m-d", strtotime("+$dienas days"));
    
    $stmt = $pdo->prepare(" INSERT INTO abonementi (Liet_ID, Tips, Sakums, Beigas)
                            VALUES (?, ?, ?, ?) ");
    $stmt->execute([ $liet_id, $dienas.' dienas', $sakums, $beigas ]);

    unset($_SESSION['sub_days']);
    $_SESSION['Abonements'] = $dienas.' dienas';
    $_SESSION['positive_alert_text'] = 'Abonements tika veiksmīgi iegādāts!';
    header("Location: index.php");
} 

if ( $_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'buy_sub' ) { 

    $dienas = (int)$_POST['tips']; 
    $allowed = [30, 90, 180, 360]; 
    
    if (!in_array($dienas, $allowed)) { 
        die("Nederīgs abonements"); 
    } 
    
    $prices = [ 30 => 100,
                90 => 200, 
                180 => 300, 
                360 => 500 
    ]; 
    
    $amount = $prices[$dienas]; 
    $_SESSION['sub_days'] = $dienas; 
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://"; 
    $domain = $protocol . $_SERVER['HTTP_HOST'];
    
    $checkout_session = \Stripe\Checkout\Session::create([ 
        'payment_method_types' => ['card'], 
        'line_items' => [[ 'price_data' => [ 'currency' => 'eur', 
        'product_data' => [ 'name' => "Abonements {$dienas} dienām", ], 
        'unit_amount' => $amount, ], 'quantity' => 1, ]], 
        'mode' => 'payment', 
        'success_url' => $domain . $_SERVER['PHP_SELF'] . '?success=1', 'cancel_url' => $domain . $_SERVER['PHP_SELF'] . '?canceled=1', ]);
        
    header("Location: " . $checkout_session->url);
    exit;
} 
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Abonements</title>

    <link href="https://cdn.jsdelivr.net/npm/mdb-ui-kit@9.2.0/css/mdb.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet"/>
    <link href="dizains.css" rel="stylesheet"/>

</head>

<body>

    <?php navbar(); ?>
    
    <div class="container mt-5" style="max-width:700px;">
        <?php if (isset($successMessage)) : ?>
            <div class="alert alert-success">
                <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_GET['canceled'])) : ?>
            <div class="alert alert-danger">Maksājums tika atcelts.</div>
        <?php endif; ?>
        
        <div class="card shadow-6-strong">
            <div class="card-header text-center">
                <h2>Abonements</h2>
            </div>
            <div class="card-body text-center">
                <form method="POST">
                    <input type="hidden" name="action" value="buy_sub">
                    <select class="form-select mb-4" name="tips">
                        <option value="30"> 30 dienas - 1 EUR </option>
                        <option value="90"> 90 dienas - 2 EUR </option>
                        <option value="180"> 180 dienas - 3 EUR </option>
                        <option value="360"> 360 dienas - 5 EUR </option>
                    </select>
                    <button class="btn btn-primary w-100" type="submit">Pirkt</button>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/mdb-ui-kit@9.2.0/js/mdb.umd.min.js"></script>
</body>
</html>