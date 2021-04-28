<?php include('register_backend.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration system PHP and MySQL</title>
    <link rel="stylesheet" href="loginstyles.css">
</head>
<body>
<div class="header">
    <h2>Register</h2>
</div>

<form method="post" action="register.php">
    <?php include('errors.php'); ?>
    <div class="input-group">
        <label>Username</label>
        <input type="text" name="username" value="">
    </div>
    <div class="input-group">
        <label>Email</label>
        <input type="email" name="email" value="">
    </div>
    <div class="input-group">
        <label>Password</label>
        <input type="password" name="password_1">
    </div>
    <div class="input-group">
        <label>Confirm password</label>
        <input type="password" name="password_2">
    </div>
    <div class="input-group">
        <label>Születési dátum</label>
        <input type="date" name="szul_date">
    </div>
    <div class="input-group">
        <label>Önéletrajz URL</label>
        <input type="text" name="oneletrajz" value="">
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="reg_user">Register</button>
    </div>
    <p>
        Already a member? <a href="login_backend.php">Sign in</a>
    </p>
</form>
</body>
</html>
