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
<div class="container pt-5">
    <?php include('errors.php'); ?>
    <div class="row">
        <div class="col-sm">
            <h2>Bejelentkezés álláskeresőként</h2>
            <form action="login_user_backend.php" method ="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Felhasználónév</label>
                    <input type="text" class="form-control" name="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Jelszó</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <button name="login_user" type="submit" class="btn btn-primary">Bejelentkezés</button>
                <div>
                    <h6>Nincs még regisztrációja?</h6>
                    <a class="btn btn-primary" href="register_user.php" role="button">Regisztráció</a>
                </div>
            </form>
        </div>
        <div class="col-sm">
            <h2>Bejelentkezés cegkent</h2>
            <form action="login_ceg_backend.php" method ="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" name="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Jelszó</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <button name="login_ceg" type="submit" class="btn btn-primary">Bejelentkezés</button>
                <div>
                    <h6>Nincs még regisztrációja?</h6>
                    <a class="btn btn-primary" href="register_ceg.php" role="button">Regisztráció</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>