<?php
    session_start();
    require_once "model/Felhasznalo.php";
    require_once "model/Ceg.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Álláskereső</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav w-100">
                <li class="nav-item">
                    <a class="nav-link active" href="allasok.php">Állások</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cegek.php">Cégek</a>
                </li>
                <?php
                if (isset($_SESSION['felhasznalo'])) {
                    $felhasznalo = unserialize($_SESSION['felhasznalo']);
                    echo '<li style="margin-left: auto"><a class="nav-link" href="logout.php">' . $felhasznalo->getNev() . '</a></li>';
                }
                else if (isset($_SESSION['ceg'])) {
                    $ceg = unserialize($_SESSION['ceg']);
                    echo '<li style="margin-left: auto"><a class="nav-link" href="logout.php">' . $ceg->getNev() . '</a></li>';
                } 
                else {
                    echo '<li style="margin-left: auto"><a class="nav-link" href="login.php">Bejelentkezés</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container">

<h1>Üdvözüljük álláskereső oldalunkon!</h1>
<p>Válogasson kedve szerint a meghirdetett állások listájából!<br>
Nálunk csak ellenörzött vállalkozások hirdetnek!
</p>
<p>Ammenyiben szeretne állásra jelentkezni, vagy
új állást meghirdetni kérjük jelentkezzen be!</p>
</div>
</body>
</html>