<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT']. '/pages/backend/imports.php';

echo '
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">Álláskereső</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav w-100">
                <li class="nav-item">
                    <a class="nav-link active" href="/pages/allasok.php">Állások</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pages/cegek.php">Cégek</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pages/felhasznalok.php">Felhasználók</a>
                </li>
                <li style="margin-left: auto" class="nav-item">';

                if (AuthController::getInstance()->isFelhasznaloLoggedIn()) {
                    $felhasznalo = AuthController::getInstance()->getCurrentFelhasznalo();
                    echo '<div class="input-group mr-auto">
                              <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$felhasznalo->getNev().'</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                  <a class="dropdown-item" href="/pages/user_adatlap.php">Adatlap</a>
                                  <a class="dropdown-item" href="/pages/backend/logout.php">Kijelentkezés</a>
                                </div>
                              </div>
                            </div>';
                }
                else if (AuthController::getInstance()->isCegLoggedIn()) {
                    $ceg = AuthController::getInstance()->getCurrentCeg();
                    echo '<div class="input-group mr-auto">
                              <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$ceg->getNev().'</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                  <a class="dropdown-item" href="/pages/cegAdatok.php">Cég adatok</a>
                                  <a class="dropdown-item" href="/pages/addAllas.php">Álláshírdetés feladása</a>
                                  <a class="dropdown-item" href="/pages/logout.php">Kijelentkezés</a>
                                </div>
                              </div>
                            </div>';
                }
                else {
                    echo '<li style="margin-left: auto"><a class="nav-link" href="/pages/login.php">Bejelentkezés</a></li>';
                }
                echo '
                </li>
            </ul>
        </div>
    </div>
</nav>';
?>