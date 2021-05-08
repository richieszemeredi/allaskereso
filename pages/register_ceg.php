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
require_once $_SERVER['DOCUMENT_ROOT']. '/pages/backend/register_ceg_backend.php';
?>
<div class="container">
<h2>Regisztráció cégként</h2>
<form method="post">
    <div class="mb-3">
        <label class="form-label" for="cegNev">Név</label>
        <input class="form-control" type="text" id="cegNev" name="cegNev" autocomplete="cegNev" value="">
    </div>
    <div class="mb-3">
        <label class="form-label" for="cegMail">Email</label>
        <input class="form-control" type="email" id="cegMail" autocomplete="cegMail" name="cegMail" value="">
    </div>
    <div class="mb-3">
        <label class="form-label" for="cegPw1">Jelszó</label>
        <input   class="form-control" type="password" autocomplete="cegPw" id="cegPw1" name="cegPw1">
    </div>
    <div class="mb-3">
        <label class="form-label" for="cegPw2">Jelszó megerősítése</label>
        <input  class="form-control" type="password" autocomplete="cegPw" id="cegPw2" name="cegPw2">
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
<?php include('errors.php'); ?>
</body>
</html>
