<?php

require_once "dao/AllasDAOImpl.php";
require_once 'controller/AllasController.php';

if (isset($_POST['jelentkezes_torles'])) {
    $allasID = $_POST['allasID'];
    $allasDAO = new AllasDAOImpl();
    $allas = $allasDAO->getAllas($allasID);
    if (AuthController::getInstance()->isFelhasznaloLoggedIn()) {
        $allasController = AllasController::getInstance();
        $user = AuthController::getInstance()->getCurrentFelhasznalo();
        if ($allasController->hasJelentkezes($allas, $user)) {
            $allasController->allasJelentkezesTorles($allas, $user);
            header('location: user_adatlap.php');
        } else {
            alert("Erre az állásra nincs jelentkezésed!");
        }
    } else {
        alert("Nem vagy bejelentkezve!");
    }

}

function alert($message) {
    echo "<script>alert('$message');</script>";
}
