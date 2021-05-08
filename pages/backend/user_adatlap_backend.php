<?php

$errors = [];
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

if (isset($_POST['user_modositas'])) {
    $userDAO = new FelhasznaloDAOImpl();

    $userID = $_POST['userID'];
    $ujNev = $_POST['userNev'];
    $ujEmail = $_POST['email'];
    $ujURL = $_POST['oneletrajz'];
    $ujSzul = $_POST['szul_date'];
    $user = $userDAO->getFelhasznalo($userID);

    if ($user->getNev() != $ujNev) {
        if ($userDAO->felhasznaloExists($ujNev)) array_push($errors, "Ez a felhasználónév már foglalt");
    }
    if ($user->getEmail() != $ujEmail) {
        if ($userDAO->felhasznaloExists($ujEmail)) array_push($errors, "Ez az e-mail már foglalt");
    }
    if ($user->getSzulDatum() != $ujSzul) {
        if (empty($ujSzul)) array_push($errors, "Kérlek adj meg egy születési dátumot");
    }

    if (count($errors) == 0) {
        $user->setNev($ujNev);
        $user->setEmail($ujEmail);
        $user->setOneletrajz($ujURL);
        $user->setSzulDatum($ujSzul);

        if ($userDAO->updateFelhasznalo($userID, $user)) {
            AuthController::getInstance()->setCurrentFelhasznalo($user);
            header('location: /pages/user_adatlap.php');
        }
    }
}

function alert($message) {
    echo "<script>alert('$message');</script>";
}
