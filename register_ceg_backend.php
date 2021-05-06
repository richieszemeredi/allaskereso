<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once "db/Database.php";
require_once "dao/CegDAOImpl.php";

$errors = array();

$db = Database::getInstance()->getConnection();
$cegDAO = new CegDAOImpl();


if (isset($_POST['reg_ceg'])) {

    $cegNev = $_POST['cegNev'];
    $email = $_POST['cegMail'];
    $password_1 = $_POST['cegPw1'];
    $password_2 = $_POST['cegPw2'];

    if (empty($cegNev)) { array_push($errors, "Az név az kötelező"); }
    if (empty($email)) { array_push($errors, "Az e-mail az kötelező"); }
    if (empty($password_1)) { array_push($errors, "A jelszó az kötelező"); }

    if ($password_1 != $password_2) {
        array_push($errors, "Nem egyezik a két jelszó");
    }

    if ($cegDAO->cegExists($cegNev)) {
        array_push($errors, "Ez a cég név már használatban van");
    }

    if ($cegDAO->cegExists($email)) {
        array_push($errors, "Ez az e-mail már használatban van");
    }

    if (count($errors) == 0) {
        $password = md5($password_1);

        $ceg = new Ceg($cegNev, $email, $password);

        $ceg = $cegDAO->createCeg($ceg);

        if ($ceg) {
            $_SESSION['ceg'] = serialize($ceg);
            header('location: index.php');
        }
    }
}

