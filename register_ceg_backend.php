<?php
session_start();

require_once "db/Database.php";
require_once "dao/CegDAOImpl.php";

// initializing variables
$username = "";
$email    = "";
$errors = array();

$db = Database::getInstance()->getConnection();
$cegDAO = new CegDAOImpl();


if (isset($_POST['reg_user'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];

    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }

    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    if ($cegDAO->cegExists($username)) {
        array_push($errors, "Username already exists");
    }

    if ($cegDAO->cegExists($email)) {
        array_push($errors, "email already exists");
    }

    if (count($errors) == 0) {
        $password = md5($password_1);

        $ceg = new Ceg($username, $email, $password, $oneletrajz, $date);

        $ceg = $cegDAO->createCeg($ceg);

        if ($ceg) {
            $_SESSION['ceg'] = serialize($ceg);
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
        }
    }
}

