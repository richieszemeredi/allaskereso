<?php
if (!isset($_SESSION)) {
    session_start();
}

$errors = [];

$db = Database::getInstance()->getConnection();
$felhasznaloDAO = new FelhasznaloDAOImpl();


if (isset($_POST['reg_user'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];
    $oneletrajz = $_POST['oneletrajz'];
    $date = $_POST['szul_date'];

    if (empty($username)) { array_push($errors, "A felhasználónév kötelező"); }
    if (empty($email)) { array_push($errors, "Az e-mail kötelező"); }
    if (empty($password_1)) { array_push($errors, "A jelszó kötelező"); }
    if (empty($date)) { array_push($errors, "A születési dátum kötelező"); }

    if ($password_1 != $password_2) {
        array_push($errors, "A két jelszó nem egyezik!");
    }

    if ($felhasznaloDAO->felhasznaloExists($username)) {
        array_push($errors, "Ez a felhasználónév már létezik");
    }

    if ($felhasznaloDAO->felhasznaloExists($email)) {
        array_push($errors, "Ez az e-mail már létezik");
    }

    if (count($errors) == 0) {
        $password = md5($password_1);

        $felhasznalo = new Felhasznalo($username, $email, $password, $oneletrajz, $date);

        $felhasznalo = $felhasznaloDAO->createFelhasznalo($felhasznalo);

        if ($felhasznalo) {
            $_SESSION['felhasznalo'] = serialize($felhasznalo);
            header('location: /index.php');
        }
    }
}

