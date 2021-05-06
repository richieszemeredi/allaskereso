<?php

require_once "dao/AllasDAOImpl.php";
require_once "dao/FelhasznaloDAOImpl.php";
require_once "dao/CegDAOImpl.php";
require_once 'controller/AllasController.php';
$errors = [];
if (isset($_POST['jelentkezes_torles'])) {
    $allasID = $_POST['allasID'];
    $userID = $_POST['userID'];
    $allasDAO = new AllasDAOImpl();
    $userDAO = new FelhasznaloDAOImpl();
    $allas = $allasDAO->getAllas($allasID);
    $user = $userDAO->getFelhasznalo($userID);
    if (AuthController::getInstance()->isCegLoggedIn()) {
        $allasController = AllasController::getInstance();
        if ($allasController->hasJelentkezes($allas, $user)) {
            $allasController->allasJelentkezesTorles($allas, $user);
            header('location: cegAdatok.php');
        } else {
            alert("Erre az állásra nincs ennek a személynek jelentkezése!");
        }
    } else {
        alert("Nem vagy bejelentkezve!");
    }
}

if (isset($_POST['ceg_modositas'])) {
    $cegDAO = new CegDAOImpl();

    $cegID = $_POST['cegID'];
    $ujNev = $_POST['cegNev'];
    $ujEmail = $_POST['cegMail'];

    $ceg = $cegDAO->getCeg($cegID);

    if ($ceg->getNev() != $ujNev) {
        if ($cegDAO->cegExists($ujNev)) array_push($errors, "Ez a név már foglalt!");
    }
    if ($ceg->getEmail() != $ujEmail) {
        if ($cegDAO->cegExists($ujEmail)) array_push($errors, "Ez az e-mail már foglalt");
    }

    if (count($errors) == 0) {
        $ceg->setNev($ujNev);
        $ceg->setEmail($ujEmail);
        $cegDAO->updateCeg($cegID, $ceg);
        AuthController::getInstance()->setCurrentCeg($ceg);
        header('location: cegAdatok.php');
    }
}

function alert($message) {
    echo "<script>alert('$message');</script>";
}