<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dzest_zinu'])) {

    $zinas_id = (int)$_POST['dzest_zinu'];

    $stmt = $pdo->prepare("SELECT Liet_ID FROM zinas WHERE ID = ?");
    $stmt->execute([$zinas_id]);
    $zina = $stmt->fetch();

    if ($zina && isset($_SESSION['Liet_ID'])) {

        if (($_SESSION['Liet_ID'] == $zina['Liet_ID']) || ($_SESSION['Loma'] === 'Darbinieks' && $category === 'lietotaju_zinas') || $_SESSION['Loma'] === 'Administrators') {

            $stmt = $pdo->prepare("DELETE FROM atsauksmes WHERE Zinas_ID = ?");
            $stmt->execute([$zinas_id]);

            $stmt = $pdo->prepare("DELETE FROM zinas WHERE ID = ?");
            $stmt->execute([$zinas_id]);
        }
    }

    $_SESSION['positive_alert_text'] = 'Ziņa tika dzēsta!';

    header("Location: ".$_SERVER['REQUEST_URI']);
    exit;
}

function navbar($num = null, $kat = null) {
    echo '
    <nav class="navbar navbar-light bg-light sticky-top shadow-4-strong" style="z-index:999;">
      <div class="container-fluid" id="nav-ul-links">

        <a class="navbar-brand me-0" href="index.php"><img src="LZ logo.png" style="height: 20px;"></a>
        
        <ul class="navbar-nav flex-row gap-4 d-none d-md-flex justify-content-center" style="height:40px; width:90%;">
        <form method="GET" action="index.php" style="width:30%;">
            <div class="input-group">
                <div class="form-outline" data-mdb-input-init>
                    <input type="search" id="form1" class="form-control" value="'.($_GET['meklet_zinas'] ?? '').'" name="meklet_zinas" />
                    <label class="form-label" for="form1">Meklēt ziņas</label>
                </div>
                <button type="submit" class="btn btn-primary" data-mdb-ripple-init>
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>

        
          <li class="nav-item"><a class="nav-link" href="index.php" style="color: rgb(0 0 0 / 90%) !important;">Jaunākais</a></li>
          <li class="nav-item"><a class="nav-link" href="latvija.php" style="color: rgb(0 0 0 / 90%) !important;">Latvijā</a></li>
          <li class="nav-item"><a class="nav-link" href="laika_zinas.php" style="color: rgb(0 0 0 / 90%) !important;">Laika ziņas</a></li>
          <li class="nav-item"><a class="nav-link" href="sports.php" style="color: rgb(0 0 0 / 90%) !important;">Sports</a></li>
          <li class="nav-item"><a class="nav-link" href="politika.php" style="color: rgb(0 0 0 / 90%) !important;">Politika</a></li>
          <li class="nav-item"><a class="nav-link" href="arzemes.php" style="color: rgb(0 0 0 / 90%) !important;">Ārzemēs</a></li>
          <li class="nav-item"><a class="nav-link" href="lietotaju_zinas.php" style="color: rgb(0 0 0 / 90%) !important;">Lietotāju ziņas</a></li>
        </ul>
    ';

    echo '<button class="btn m-0 p-0" type="button" data-mdb-collapse-init data-mdb-target="#sidenav"
        aria-expanded="false" aria-controls="sidenav" style="z-index: 9; box-shadow: none; opacity: 1;">
        <i class="fas fa-bars" style="color: rgb(0, 0, 0); font-size: 28px;"></i>
    </button>

    ';

    echo '</div>';

    echo '
        <div class="container-fluid d-flex" id="mobile-nav-ul-links">

        <a class="navbar-brand me-0" href="index.php"><img src="LZ logo.png" style="height: 20px;"></a>
        <button class="navbar-toggler" type="button"
          data-mdb-collapse-init
          data-mdb-target="#navbarMenu"
          aria-controls="navbarMenu"
          aria-expanded="false"
          aria-label="Toggle navigation"
          style="z-index:9999;">
          <i class="fas fa-bars" style="color: rgb(0, 0, 0); font-size: 28px;"></i>
        </button>

      </div>
    </nav>


<!-- Sidebar -->
<div id="sidenav" class="collapse position-fixed top-0 end-0 h-100 sidenav-animated shadow-6-strong" style="width: 394px; z-index: 10; font-size: 18px; overflow-y: auto; background-color: white;">
  <div class="list-group list-group-flush mx-3" style="margin-top: 100px;">';
    if (
        (isset($_SESSION['Liet_ID']) && in_array($_SESSION['Loma'], ['Darbinieks', 'Administrators'])) 
        || ($kat === "lietotaju_zinas" && isset($_SESSION['Liet_ID']))
    ) {
        echo '<a href="pievienot.php" class="btn btn-success mb-3">Pievienot ziņu</a>';
    }
    if ($num === 1) {
      echo '<button type="button" class="btn btn-primary mb-3" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#tērzētava">Tērzētava</button>';
    }
    if (!isset($_SESSION['Vards'])) {
        echo '
            <a href="register.php" class="btn btn-warning mb-3">Reģistrācija</a>
            <a href="login.php" class="btn btn-success mb-3">Pieslēgties</a>
        ';
    } else {
        echo '
            <a href="index.php?savas_zinas=1" class="btn btn-warning mb-3">Manas ziņas</a>';
                if (!isset($_SESSION['Abonements'])) {
                echo '<a href="abonementi.php" class="btn btn-info mb-3">Abonements</a>';
                }
            echo '
            <a href="logout.php" style="font-weight:bold;" class="btn btn-outline-danger mb-3"><i class="fa-solid fa-arrow-right-from-bracket"></i> Iziet</a>
        ';
    }
    echo '
  </div>
</div>
<!-- Sidebar -->


    <!-- mobile menu -->
    <div class="collapse fullscreen-menu" id="navbarMenu">
      <ul class="navbar-nav text-center mt-5 pt-4">
        <li class="nav-item" style="line-height: 0.4;"><a class="nav-link" style="font-size:20px;" href="index.php" style="color: rgb(0 0 0 / 80%) !important;">Jaunākais</a></li>
        <li class="nav-item" style="line-height: 0.4;"><a class="nav-link" style="font-size:20px;" href="latvija.php" style="color: rgb(0 0 0 / 80%) !important;">Latvijā</a></li>
        <li class="nav-item" style="line-height: 0.4;"><a class="nav-link" style="font-size:20px;" href="laika_zinas.php" style="color: rgb(0 0 0 / 80%) !important;">Laika ziņas</a></li>
        <li class="nav-item" style="line-height: 0.4;"><a class="nav-link" style="font-size:20px;" href="sports.php" style="color: rgb(0 0 0 / 80%) !important;">Sports</a></li>
        <li class="nav-item" style="line-height: 0.4;"><a class="nav-link" style="font-size:20px;" href="politika.php" style="color: rgb(0 0 0 / 80%) !important;">Politika</a></li>
        <li class="nav-item" style="line-height: 0.4;"><a class="nav-link" style="font-size:20px;" href="arzemes.php" style="color: rgb(0 0 0 / 80%) !important;">Ārzemēs</a></li>
        <li class="nav-item" style="line-height: 0.4;"><a class="nav-link" style="font-size:20px;" href="lietotaju_zinas.php" style="color: rgb(0 0 0 / 80%) !important;">Lietotāju ziņas</a></li>
        
        <div class="row mt-2 d-flex justify-content-center">
            <form method="GET" action="index.php" class="mb-0" style="width:70%;">
                <div class="input-group">
                    <div class="form-outline" data-mdb-input-init>
                        <input type="search" id="form1" class="form-control" value="'.($_GET['meklet_zinas'] ?? '').'" name="meklet_zinas" />
                    <label class="form-label" for="form1">Meklēt ziņas</label>
                    </div>
                    <button type="submit" class="btn btn-primary" data-mdb-ripple-init>
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        </ul>

      <div class="text-center mt-4">
      ';

    if (isset($_SESSION['Vards'])) {
      if (
        (isset($_SESSION['Liet_ID']) && in_array($_SESSION['Loma'], ['Darbinieks', 'Administrators'])) 
        || ($kat === "lietotaju_zinas" && isset($_SESSION['Liet_ID']))
    ) {
        echo '<p class="mb-2"><a href="pievienot.php" class="btn btn-success" style="width:50%;">Pievienot ziņu</a></p>';
    }
    } else {
        echo '
            <a href="register.php" class="btn btn-warning mb-2" style="width:50%;">Reģistrācija</a><br>
            <a href="login.php" class="btn btn-success mb-2" style="width:50%;">Pieslēgties</a>
        ';
    }

    if ($num === 1) {
        echo'<button type="button" class="btn btn-primary mb-2" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#tērzētava" style="width:50%;">Tērzētava</button>';
    }

    if (isset($_SESSION['Vards'])) {
        echo '
            <p class="mb-2"><a href="index.php?savas_zinas=1" class="btn btn-warning" style="width:50%;">Manas ziņas</a></p>';
            if (!isset($_SESSION['Abonements'])) {
                echo '<p class="mb-2"><a href="abonementi.php" class="btn btn-info" style="width:50%;">Abonements</a></p>';
            }
        echo '
            <p class="mb-2"><a href="logout.php" style="font-weight:bold; width:50%;" class="btn btn-outline-danger"><i class="fa-solid fa-arrow-right-from-bracket"></i> Iziet</a></p>
        ';
    }

    echo '
      </div>
    </div>
    <!-- mobile menu -->
    ';
}

function show_zinas($posts) {
  ?>
  <div class="container mt-5">
    <div class="row">
        <?php if (isset($_GET['savas_zinas'])): ?>
            <h1 class="text-center text-black mb-5">Manas ziņas</h1>
        <?php endif; ?>
    </div>
        <div class="row">
            <?php
$featuredIds = [];
$featuredCount = 0;

foreach ($posts as $post):
    if ($post['Svarigums'] == 1 && $featuredCount < 2):
        $featuredCount++;
        $featuredIds[] = $post['Izveidots'];
?>
            <div class="col-lg-6 d-flex mb-4">
                <div class="card border border-white h-100 w-100 shadow-0">

                    <a href="zina.php?id=<?= $post['ID'] ?>">
                        <div class="big-card-img-format">
                            <img src="<?= htmlspecialchars($post['Bilde']) ?>" class="card-img-top">
                        </div>
                    </a>

                    <div class="card-body">
                        <a href="zina.php?id=<?= $post['ID'] ?>" class="text-dark">
                            <h3 class="text-center mb-4">
                                <?= htmlspecialchars($post['Nosaukums']) ?>
                            </h3>
                        </a>
                        <h6 class="text-end">
                            <?= htmlspecialchars($post['Izveidots']) ?>
                        </h6>
                        <?php
                          if (isset($_SESSION['Liet_ID']) &&
                            ($_SESSION['Liet_ID'] == $post['Liet_ID'] || ($_SESSION['Loma'] === 'Darbinieks' && $post['Kategorija'] === 'Lietotāju ziņas') || $_SESSION['Loma'] === 'Administrators')):
                            ?>
                            <div class="d-flex justify-content-end gap-3">
                                <form class="text-end" method="post" onsubmit="return confirm('Vai tiešām dzēst šo ziņu?');">
                                    <input type="hidden" name="dzest_zinu" value="<?= $post['ID'] ?>">
                                    <button type="submit" class="btn btn-sm btn-danger mt-2">Dzēst</button>
                                </form>
                                <form class="text-end" method="get" action="pievienot.php">
                                    <input type="hidden" name="id" value="<?= $post['ID'] ?>">
                                    <button type="submit" class="btn btn-sm btn-primary mt-2">Rediģēt</button>
                                </form>
                            </div>
                          <?php endif; ?>
                    </div>

                </div>
            </div>
            <?php
    endif;
endforeach;
?>
        </div>

        <div class="row">
            <?php
$shownFeatured = 0;

foreach ($posts as $post):

    if ($post['Svarigums'] == 1 && $shownFeatured < 2) {
        $shownFeatured++;
        continue;
    }
?>
            <div class="col-lg-4 d-flex mb-4">
                <div class="card border border-white h-100 w-100 shadow-0">

                    <a href="zina.php?id=<?= $post['ID'] ?>">
                        <div class="small-card-img-format">
                            <img src="<?= htmlspecialchars($post['Bilde']) ?>" class="card-img-top">
                        </div>
                    </a>

                    <div class="card-body">
                        <a href="zina.php?id=<?= $post['ID'] ?>" class="text-dark">
                            <h4 class="text-center mb-4">
                                <?= htmlspecialchars($post['Nosaukums']) ?>
                            </h4>
                        </a>
                        <h6 class="text-end">
                            <?= htmlspecialchars($post['Izveidots']) ?>
                        </h6>
                        <?php
                          if (isset($_SESSION['Liet_ID']) &&
                            ($_SESSION['Liet_ID'] == $post['Liet_ID'] || ($_SESSION['Loma'] === 'Darbinieks' && $post['Kategorija'] === 'Lietotāju ziņas') || $_SESSION['Loma'] === 'Administrators')):
                            ?>
                            <div class="d-flex justify-content-end gap-3">
                                <form class="text-end" method="post" onsubmit="return confirm('Vai tiešām dzēst šo ziņu?');">
                                    <input type="hidden" name="dzest_zinu" value="<?= $post['ID'] ?>">
                                    <button type="submit" class="btn btn-sm btn-danger mt-2">Dzēst</button>
                                </form>
                                <form class="text-end" method="get" action="pievienot.php">
                                    <input type="hidden" name="id" value="<?= $post['ID'] ?>">
                                    <button type="submit" class="btn btn-sm btn-primary mt-2">Rediģēt</button>
                                </form>
                            </div>
                          <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
    <?php
}

function show_terzetava() {
  ?>
<div class="modal fade" id="tērzētava" tabindex="-1" aria-labelledby="tērzētavalabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="height:90%;">
      <div class="modal-header">
        <h5 class="modal-title" id="tērzētavalabel">Tērzētava</h5>
        <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="terzetava" style="overflow-Y: auto;">
        
      </div>
      <div class="modal-footer">
        <div class="row w-100">
            <?php if (
    isset($_SESSION['Liet_ID'])
): ?>
            <div class="col-9">
                <div class="form-outline mb-4" data-mdb-input-initialized="true" data-mdb-input-init="">
                    <input id="tzina" type="text" class="form-control" name="terzetava" required="">
                    <label class="form-label" for="terzetava" style="margin-left: 0px;">Ievadi tekstu</label>
                    <div class="form-notch">
                        <div class="form-notch-leading" style="width: 9px;"></div>
                        <div class="form-notch-middle" style="width: 112px;"></div>
                        <div class="form-notch-trailing"></div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <button class="btn btn-success" onclick="sendtzina()">Sūtīt</button>
            </div>
            <?php else: ?>
                <div class="col-12">
                    <h5 class="text-center"><a href="login.php">Piesakies kontā</a>, lai sūtītu ziņas!</h5>
                </div>
            <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
}

function rediget_atsauksmi() {
  ?>
<div class="modal fade" id="red_ats_modal" tabindex="-1" aria-labelledby="red_ats_modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="height:90%;">
      <div class="modal-header">
        <h5 class="modal-title" id="red_ats_modal">Rediģēt atsauksmi</h5>
        <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post">
        <input type="hidden" name="rediget_atsauksmi" id="modal_red_ats_id">
      <div class="modal-body" id="modal_red_ats_body" style="overflow-Y: auto;">
        <?php if (isset($_SESSION['Liet_ID'])): ?>
            <div class="form-outline mb-4" data-mdb-input-initialized="true" data-mdb-input-init="">
                <textarea id="red_ats_input" class="form-control" name="red_ats_input" rows="4" required></textarea>
                <label class="form-label" for="red_ats_input" style="margin-left: 0px;">Ievadi tekstu</label>
                <div class="form-notch">
                    <div class="form-notch-leading" style="width: 9px;"></div>
                    <div class="form-notch-middle" style="width: 112px;"></div>
                    <div class="form-notch-trailing"></div>
                </div>
            </div>
            <button class="btn btn-success">Saglabāt</button>
        <?php else: ?>
            <div class="col-12">
                <h5 class="text-center"><a href="login.php">Piesakies kontā!</a></h5>
            </div>
        <?php endif; ?>
      </div>
    </form>
    </div>
  </div>
</div>
<?php
}

function positive_alert($alert_id, $teksts = '') {
    
    echo '
    <div 
        id="'.$alert_id.'"
        class="alert alert-success fade position-fixed top-0 start-50 translate-middle-x d-none"
        role="alert"
        style="z-index: 2000; min-width: 300px; text-align:center; opacity: 0.9; margin-top: 80px;"
    >
        '.$teksts.'
    </div>

    <script>
    const alertBox = document.getElementById("'.$alert_id.'");
    alertBox.classList.remove("d-none");
    alertBox.classList.add("show");
    setTimeout(() => { alertBox.classList.remove("show");
    setTimeout(() => { alertBox.classList.add("d-none"); }, 500); }, 5000); 
    </script>
    ';
}

function negative_alert($alert_id, $teksts = '') {
    
    echo '
    <div 
        id="'.$alert_id.'"
        class="alert alert-danger fade position-fixed top-0 start-50 translate-middle-x d-none"
        role="alert"
        style="z-index: 2000; min-width: 300px; text-align:center; opacity: 0.9; margin-top: 80px;"
    >
        '.$teksts.'
    </div>

    <script>
    const alertBox = document.getElementById("'.$alert_id.'");
    alertBox.classList.remove("d-none");
    alertBox.classList.add("show");
    setTimeout(() => { alertBox.classList.remove("show");
    setTimeout(() => { alertBox.classList.add("d-none"); }, 500); }, 5000); 
    </script>
    ';
}

function form_negative_alert($form_id, $alert_id, $teksts = '') {
    
    echo '
    <div 
        id="'.$alert_id.'"
        class="alert alert-danger fade position-fixed top-0 start-50 translate-middle-x d-none"
        role="alert"
        style="z-index: 2000; min-width: 300px; text-align:center; opacity: 0.9; margin-top: 80px;"
    >
        '.$teksts.'
    </div>

    <script>

    const alertBox = document.getElementById("'.$alert_id.'");

    if ("'.$form_id.'" === "login_forma") {
    ';

    if (!empty($teksts)) {

        echo '

        alertBox.classList.remove("d-none");

        setTimeout(() => {
            alertBox.classList.add("show");
        }, 10);

        setTimeout(() => {

            alertBox.classList.remove("show");

            setTimeout(() => {
                alertBox.classList.add("d-none");
            }, 150);

        }, 5000);

        ';
    }

    echo '}

    document.getElementById("'.$form_id.'").addEventListener("submit", function(e) {

        let error = false;

        if ("'.$form_id.'" === "register_forma") {

            const vards = this.elements["Vards"].value.trim();
            const epasts = this.elements["epasts"].value.trim();
            const parole = this.elements["parole"].value;

            const emailRegex = /^[^\\s@]+@[^\\s@]+\\.[^\\s@]+$/;

            if (vards.length < 3 || vards.length > 30) {
                error = true;
            }

            if (!emailRegex.test(epasts)) {
                error = true;
            }

            if (parole.length < 8 || parole.length > 30) {
                error = true;
            }
        }

        if (error || !this.checkValidity()) {

            if(alertBox.innerHTML.trim() === ""){
                alertBox.innerHTML = "Lūdzu aizpildiet visus laukus!";
            }

            e.preventDefault();

            alertBox.classList.remove("d-none");

            setTimeout(() => {
                alertBox.classList.add("show");
            }, 10);

            setTimeout(() => {

                alertBox.classList.remove("show");

                setTimeout(() => {
                    alertBox.classList.add("d-none");
                }, 150);

            }, 5000);

        } else {

            alertBox.classList.remove("show");
            alertBox.classList.add("d-none");

        }

    });

    </script>
    ';
}

?>