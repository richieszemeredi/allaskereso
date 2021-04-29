<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title>Főoldal</title>
</head>
<body>
<ul>
    <li><a href="index.php">Főoldal</a></li>
    <li><a href="allasok.php">Állások</a></li>
    <li><a class="active" href="cegek.php">Cégek</a></li>
    <?php
    if (isset($_SESSION['felhasznalo'])) {
        $felhasznalo = unserialize($_SESSION['felhasznalo']);
        echo '<li style="float:right"><a href="logout.php">'.$felhasznalo->getNev().'</a></li>';
    } else {
        echo '<li style="float:right"><a href="login.php">Bejelentkezés</a></li>';
    }
    ?>
</ul>
</body>
</html>