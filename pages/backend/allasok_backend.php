<?php

if (isset($_POST['allas_jelentkezes'])) {
    $allasID = $_POST['allasID'];
    $allasDAO = new AllasDAOImpl();
    $allas = $allasDAO->getAllas($allasID);
    if (AuthController::getInstance()->isFelhasznaloLoggedIn()) {
        $allasController = AllasController::getInstance();
        $user = AuthController::getInstance()->getCurrentFelhasznalo();
        if (!$allasController->hasJelentkezes($allas, $user)) {
            $allasController->allasJelentkezes($allas, $user);
            header('location: /pages/allasok.php');
        } else {
            alert("Erre az állásra már jelentkeztél!");
        }
    } else {
        alert("Nem vagy bejelentkezve!");
    }

}

function alert($message) {
    echo "<script>alert('$message');</script>";
}