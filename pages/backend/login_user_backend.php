<?php
if (!isset($_SESSION)) {
    session_start();
}

$felhasznaloDAO = new FelhasznaloDAOImpl();
$errors = [];

if (isset($_POST['login_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    if (empty($username)) {
        array_push($errors, "A felhasználónév kötelező");
    }
    if (empty($password)) {
        array_push($errors, "A jelszó kötelező");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $felhasznalo = $felhasznaloDAO->getFelhasznalo($username);
        if ($felhasznalo && $felhasznalo->isPasswordValid($password)) {
            AuthController::getInstance()->setCurrentFelhasznalo($felhasznalo);
            header('location: /index.php');
        } else {
            array_push($errors, "Rossz felhasználónév/jelszó kombináció");
        }
    }
}
