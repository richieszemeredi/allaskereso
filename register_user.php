<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
<?php include 'navigation.php'; ?>
<div class="container">
<h2>Regisztráció álláskeresőként</h2>
<form method="post" action="register_user_backend.php">
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
        <button type="submit" class="btn btn-primary" name="reg_user">Regisztráció</button>
    </div>
    <p>
        Már regisztrált? 
    </p>
    <a class="btn btn-secondary" href="login.php">Bejelentkezés</a>
</form>
</div>
</body>
</html>
