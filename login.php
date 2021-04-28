<!DOCTYPE html>
<?php include('login_backend.php') ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="loginstyles.css">
</head>
<body>
<ul>
    <li><a href="Main.html">Főoldal</a></li>
    <li><a href="#jobs">Állások</a></li>
    <li><a href="#inc">Cégek</a></li>
    <li style="float:right"><a class="active" href="#login">Login</a></li>
</ul>
<h3>Bejelentkezés</h3>
<form action="login.php" method ="post">
    <div class="imgcontainer">
        <img src="img_avatar.png" alt="Avatar" class="avatar">
    </div>
    <div class="container">
        <?php include('errors.php'); ?>
        <label for="username"><b>Felhasználónév</b></label><br>
        <input type="text" placeholder="Írja be a felhasználónevét" name="username" required>
        <br>
        <label for="password"><b>Jelszó</b></label><br>
        <input type="password" placeholder="Adja meg a jelszavát" name="password" required>

        <button type="submit" name="login_user"><b>Bejelentkezés</b></button>
        <label>
            <button id="reg"><a href="register.php">Regisztráció</a></button>
        </label>
    </div>
</form>
</body>
</html>