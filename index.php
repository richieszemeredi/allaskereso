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
<?php include 'navigation.php'; ?>

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