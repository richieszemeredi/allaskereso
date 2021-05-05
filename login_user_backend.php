<?php
session_start();
require_once "dao/FelhasznaloDAOImpl.php";
require_once "dao/FelhasznaloDAO.php";
require_once "errors.php";

$felhasznaloDAO = new FelhasznaloDAOImpl();
$errors = [];

if (isset($_POST['login_user'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];


    if (empty($email)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $felhasznalo = $felhasznaloDAO->getFelhasznalo($email);
        if ($felhasznalo && $felhasznalo->isPasswordValid($password)) {
            $_SESSION['felhasznalo'] = serialize($felhasznalo);
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
        } else {
            array_push($errors, "Wrong username/password combination");
            header('location: login.php');
        }
    }
}

?>