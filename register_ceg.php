<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
                    <a class="nav-link" href="allasok.php">Állások</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cegek.php">Cégek</a>
                </li>
                <?php
                if (isset($_SESSION['felhasznalo'])) {
                    $felhasznalo = unserialize($_SESSION['felhasznalo']);
                    echo '<li style="margin-left: auto"><a class="nav-link" href="logout.php">'.$felhasznalo->getNev().'</a></li>';
                } else {
                    echo '<li style="margin-left: auto"><a class="nav-link" href="login.php">Bejelentkezés</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
<h2>Regisztráció cégként</h2>
<form method="post" action="register_ceg_backend.php">
    <?php include('errors.php'); ?>
    <div class="mb-3">
        <label class="form-label" for="nev">Név</label>
        <input class="form-control" type="text" name="username" value="">
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input  class="form-control" type="email" name="email" value="">
    </div>
    <div class="mb-3">
        <label class="form-label">Jelszó</label>
        <input   class="form-control" type="password" name="password_1">
    </div>
    <div class="mb-3">
        <label class="form-label">Jelszó megerősítése</label>
        <input  class="form-control" type="password" name="password_2">
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-primary" name="reg_ceg">Regisztráció</button>
    </div>
    <p>
        Már regisztrált? 
    </p>
    <a class="btn btn-secondary" href="login.php">Bejelentkezés</a>
</form>
</div>
</body>
</html>
