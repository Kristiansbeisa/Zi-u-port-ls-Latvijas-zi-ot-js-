<?php
$host = "localhost";
$db   = "beisadb";
$user = "root";   
$pass = "";      
//pieslēgums pie MySQL
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("DB connection failed: " . $e->getMessage());
}

session_start();

// CSRF token
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

function check_csrf($token) {
    if (!hash_equals($_SESSION['csrf_token'], $token)) {
        die("CSRF aizliegts!");
    }
}

?>

<?php

$conn = new mysqli("localhost", "root", "", "beisadb");
if ($conn->connect_error) die("DB kļūda");

// Ziņas sūta
if (isset($_POST['action']) && $_POST['action'] == 'send') {

    $lietotajs = $_SESSION['Liet_ID'];
    $message = trim($_POST['message']);

    if ($message != '') {
        $stmt = $conn->prepare("INSERT INTO terzetavas_zinas (category, Liet_ID, teksts) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $category, $lietotajs, $message);
        $stmt->execute();
    }

    exit;
}
// Ziņas sūta

// Ziņas ielādē
if (isset($_GET['action']) && $_GET['action'] == 'load') {

    $stmt = $conn->prepare("SELECT
                            t.*,
                            l.*
                            FROM terzetavas_zinas t
                            JOIN lietotaji l ON t.Liet_ID = l.ID
                            WHERE category = ?
                            ORDER BY t.id DESC
                            LIMIT 15");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        echo "<p>
                <strong>" . htmlspecialchars($row['Vards']) . ":</strong>
                <span style='word-wrap: break-word;
    overflow-wrap: break-word;
    word-break: break-word;'>" . htmlspecialchars($row['teksts']) . "</span>
                <br><small class='text-muted'>{$row['izveidots']}</small>
              </p>";
    }

    exit;
}
// Ziņas ielādē
?>


<script>
function ieladettzinas() {
    fetch(window.location.pathname + "?action=load")
        .then(res => res.text())
        .then(data => {
            document.getElementById("terzetava").innerHTML = data;
        });
}

function sendtzina() { 
    let message = document.getElementById("tzina").value; 
    
    fetch(window.location.pathname, { 
        method: "POST", 
        headers: { "Content-Type": "application/x-www-form-urlencoded" 

    }, 
        body: "action=send&message=" + 
        encodeURIComponent(message) 
    }) 
    .then(() => { 
        document.getElementById("tzina").value = ""; 
        ieladettzinas(); 
    }); 
}

ieladettzinas();
setInterval(ieladettzinas, 1000);
</script>