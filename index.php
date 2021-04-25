<?php
    session_start();
    require_once "model/Felhasznalo.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title>Főoldal</title>
</head>
<body>
<ul>
    <li><a class="active" href="index.php">Főoldal</a></li>
    <li><a href="allasok.php">Állások</a></li>
    <li><a href="#inc">Cégek</a></li>
    <?php
    if (isset($_SESSION['felhasznalo'])) {
        $felhasznalo = unserialize($_SESSION['felhasznalo']);
        echo '<li style="float:right"><a href="logout.php">'.$felhasznalo->getNev().'</a></li>';
    } else {
        echo '<li style="float:right"><a href="login.php">Bejelentkezés</a></li>';
    }
    ?>
</ul>
<h1>Üdvözüljük álláskereső oldalunkon!</h1>
<h3>Válogasson kedve szerint a meghirdetett állások listájából!<br>
Nálunk csak ellenörzött vállalkozások hirdetnek!
</h3>
<h2 id="a">Ammenyiben szeretne állásra jelentkezni, vagy
új állást meghirdetni kérjük jelentkezzen be!</h2>
</body>
</html>