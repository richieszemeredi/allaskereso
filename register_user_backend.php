<?php
session_start();

require_once "db/Database.php";
require_once "dao/FelhasznaloDAOImpl.php";

// initializing variables
$username = "";
$email    = "";
$errors = array();

$db = Database::getInstance()->getConnection();
$felhasznaloDAO = new FelhasznaloDAOImpl();


if (isset($_POST['reg_user'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];
    $oneletrajz = $_POST['oneletrajz'];
    $date = $_POST['szul_date'];

    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
    if (empty($date)) { array_push($errors, "A születési dátum kötelező"); }

    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    if ($felhasznaloDAO->felhasznaloExists($username)) {
        array_push($errors, "Username already exists");
    }

    if ($felhasznaloDAO->felhasznaloExists($email)) {
        array_push($errors, "email already exists");
    }

    if (count($errors) == 0) {
        $password = md5($password_1);

        $felhasznalo = new Felhasznalo($username, $email, $password, $oneletrajz, $date);

        $felhasznalo = $felhasznaloDAO->createFelhasznalo($felhasznalo);

        if ($felhasznalo) {
            $_SESSION['felhasznalo'] = serialize($felhasznalo);
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
        }
    }
}

