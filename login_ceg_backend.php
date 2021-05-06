<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once "dao/CegDAOImpl.php";
require_once "dao/CegDAO.php";

$cegDAO = new CegDAOImpl();

if (isset($_POST['login_ceg'])) {
    $email = $_POST['ceg-email'];
    $password = $_POST['ceg-pw'];


    if (empty($email)) {
        array_push($errors, "Az e-mail kötelező");
    }
    if (empty($password)) {
        array_push($errors, "A jelszó kötelező");
    }
    if (count($errors) == 0) {
        $password = md5($password);
        $ceg = $cegDAO->getCeg($email);
        if ($ceg && $ceg->isPasswordValid($password)) {
            AuthController::getInstance()->setCurrentCeg($ceg);
            header('location: index.php');
        } else {
            array_push($errors, "Rossz e-mail/jelszó kombináció");
        }
    }
}

