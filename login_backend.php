<?php
session_start();
require_once "dao/FelhasznaloDAOImpl.php";

$felhasznaloDAO = new FelhasznaloDAOImpl();
$errors = [];

if (isset($_POST['login_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $felhasznalo = $felhasznaloDAO->getFelhasznalo($username);
        if ($felhasznalo && $felhasznalo->isPasswordValid($password)) {
            $_SESSION['felhasznalo'] = serialize($felhasznalo);
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}

?>