<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dzest_zinu'])) {

    $zinas_id = (int)$_POST['dzest_zinu'];

    $stmt = $pdo->prepare("SELECT Liet_ID FROM zinas WHERE ID = ?");
    $stmt->execute([$zinas_id]);
    $zina = $stmt->fetch();

    if ($zina && isset($_SESSION['Liet_ID'])) {

        if (($_SESSION['Liet_ID'] == $zina['Liet_ID']) || ($_SESSION['Loma'] === 'Darbinieks' || $_SESSION['Loma'] === 'Administrators')) {

            $stmt = $pdo->prepare("DELETE FROM atsauksmes WHERE Zinas_ID = ?");
            $stmt->execute([$zinas_id]);

            $stmt = $pdo->prepare("DELETE FROM zinas WHERE ID = ?");
            $stmt->execute([$zinas_id]);
        }
    }

    header("Location: ".$_SERVER['REQUEST_URI']);
    exit;
}

function navbar($num = null, $kat = null) {
    echo '
    <nav class="navbar navbar-light bg-light sticky-top">
      <div class="container-fluid">

        <a class="navbar-brand" href="index.php">Logo</a>

        <ul class="navbar-nav flex-row gap-4 d-none d-md-flex">
          <li class="nav-item"><a class="nav-link" href="index.php">Jaunākais</a></li>
          <li class="nav-item"><a class="nav-link" href="latvija.php">Latvijā</a></li>
          <li class="nav-item"><a class="nav-link" href="laika_zinas.php">Laika ziņas</a></li>
          <li class="nav-item"><a class="nav-link" href="sports.php">Sports</a></li>
          <li class="nav-item"><a class="nav-link" href="politika.php">Politika</a></li>
          <li class="nav-item"><a class="nav-link" href="arzemes.php">Ārzemēs</a></li>
          <li class="nav-item"><a class="nav-link" href="lietotaju_zinas.php">Lietotāju ziņas</a></li>
        </ul>
    ';

    echo '<div class="d-none d-md-flex align-items-center gap-2">';

    if (
        (isset($_SESSION['Liet_ID']) && in_array($_SESSION['Loma'], ['Darbinieks', 'Administrators'])) 
        || ($kat === "lietotaju_zinas" && isset($_SESSION['Liet_ID']))
    ) {
        echo '<a href="pievienot.php" class="btn d-md-flex">Pievienot</a>';
    }
    if ($num === 1) {
      echo '<button type="button" class="btn btn-primary" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#tērzētava">Tērzētava</button>';
    }
    if (isset($_SESSION['Vards'])) {
        echo '
            <span>'.htmlspecialchars($_SESSION['Vards']).'</span>
            <a href="logout.php" class="btn btn-outline-danger btn-sm">Iziet</a>
        ';
    } else {
        echo '
            <a href="register.php" class="btn btn-outline-secondary btn-sm">Reģistrācija</a>
            <a href="login.php" class="btn btn-primary btn-sm">Pieslēgties</a>
        ';
    }

    echo '</div>';

    echo '
        <button class="navbar-toggler d-md-none" type="button"
          data-mdb-collapse-init
          data-mdb-target="#navbarMenu"
          aria-controls="navbarMenu"
          aria-expanded="false"
          aria-label="Toggle navigation"
          style="z-index:9999;">
          <i class="fas fa-bars"></i>
        </button>

      </div>
    </nav>

    <!-- mobile menu -->
    <div class="collapse fullscreen-menu d-md-none" id="navbarMenu">
      <ul class="navbar-nav text-center mt-5">
        <li class="nav-item"><a class="nav-link" style="font-size:20px;" href="index.php">Jaunākais</a></li>
        <li class="nav-item"><a class="nav-link" style="font-size:20px;" href="latvija.php">Latvijā</a></li>
        <li class="nav-item"><a class="nav-link" style="font-size:20px;" href="laika_zinas.php">Laika ziņas</a></li>
        <li class="nav-item"><a class="nav-link" style="font-size:20px;" href="sports.php">Sports</a></li>
        <li class="nav-item"><a class="nav-link" style="font-size:20px;" href="politika.php">Politika</a></li>
        <li class="nav-item"><a class="nav-link" style="font-size:20px;" href="arzemes.php">Ārzemēs</a></li>
        <li class="nav-item"><a class="nav-link" style="font-size:20px;" href="lietotaju_zinas.php">Lietotāju ziņas</a></li>
      </ul>

      <div class="text-center mt-4">
      ';
      if ($num === 1) {
        echo'<button type="button" class="btn btn-primary mb-2" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#tērzētava">Tērzētava</button>';
      }
      echo'
    ';

    if (isset($_SESSION['Vards'])) {
      if (
        (isset($_SESSION['Liet_ID']) && in_array($_SESSION['Loma'], ['Darbinieks', 'Administrators'])) 
        || ($kat === "lietotaju_zinas" && isset($_SESSION['Liet_ID']))
    ) {
        echo '<p><a href="pievienot.php" class="btn">Pievienot</a></p>';
    }
        echo '
            <p><a href="logout.php" class="btn btn-outline-danger">Iziet</a></p>
        ';
    } else {
        echo '
            <a href="register.php" class="btn btn-outline-secondary mb-2">Reģistrācija</a><br>
            <a href="login.php" class="btn btn-primary">Pieslēgties</a>
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
                            ($_SESSION['Liet_ID'] == $post['Liet_ID'] || $_SESSION['Loma'] === 'Darbinieks' || $_SESSION['Loma'] === 'Administrators')):
                            ?>
                            <form class="text-end" method="post" onsubmit="return confirm('Vai tiešām dzēst šo ziņu?');">
                              <input type="hidden" name="dzest_zinu" value="<?= $post['ID'] ?>">
                              <button type="submit" class="btn btn-sm btn-danger mt-2">Dzēst</button>
                            </form>
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
                            ($_SESSION['Liet_ID'] == $post['Liet_ID'] || $_SESSION['Loma'] === 'Darbinieks' || $_SESSION['Loma'] === 'Administrators')):
                            ?>
                            <form class="text-end" method="post" onsubmit="return confirm('Vai tiešām dzēst šo ziņu?');">
                              <input type="hidden" name="dzest_zinu" value="<?= $post['ID'] ?>">
                              <button type="submit" class="btn btn-sm btn-danger mt-2">Dzēst</button>
                            </form>
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
?>