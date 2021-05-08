<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
<?php

require_once $_SERVER['DOCUMENT_ROOT']. '/pages/navigation.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/pages/backend/login_user_backend.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/pages/backend/login_ceg_backend.php';

?>
<div class="container pt-5">
    <div class="row">
        <div class="col-sm">
            <h2>Bejelentkezés álláskeresőként</h2>
            <form autocomplete="off" action="login.php" method ="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Felhasználónév</label>
                    <input type="text" class="form-control" name="username" autocomplete="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Jelszó</label>
                    <input type="password" class="form-control" name="password" autocomplete="new-password">
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
            <form autocomplete="off" action="login.php" method ="post">
                <div class="mb-3">
                    <label for="ceg-email" class="form-label">Email</label>
                    <input id="ceg-email" type="email" class="form-control" name="ceg-email" autocomplete="ceg-email">
                </div>
                <div class="mb-3">
                    <label for="ceg-pw" class="form-label">Jelszó</label>
                    <input id="ceg-pw" type="password" class="form-control" name="ceg-pw" autocomplete="new-password">
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
<div class="container text-center mt-5">
    <?php include('errors.php'); ?>
</div>
</body>
</html>