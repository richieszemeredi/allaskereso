<?php

require_once "dao/AllasDAOImpl.php";
require_once "dao/FelhasznaloDAOImpl.php";
require_once 'controller/AllasController.php';

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

function alert($message) {
    echo "<script>alert('$message');</script>";
}