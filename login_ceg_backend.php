<?php
session_start();
require_once "dao/CegDAOImpl.php";
require_once "dao/CegDAO.php";
require_once "errors.php";

$cegDAO = new CegDAOImpl();
$errors = [];

if (isset($_POST['login_ceg'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];


    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
    if (count($errors) == 0) {
        $password = md5($password);
        $ceg = $cegDAO->getCeg($email);
        if ($ceg && $ceg->isPasswordValid($password)) {
            $_SESSION['ceg'] = serialize($ceg);
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
        } else {
            array_push($errors, "Wrong username/password combination");
            header('location: login.php');

        }
    }
}

?>