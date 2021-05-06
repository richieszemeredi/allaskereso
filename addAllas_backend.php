<?php

$errors = [];

require_once "db/Database.php";
require_once "dao/AllasDAOImpl.php";
require_once "dao/VarosDAOImpl.php";
require_once "dao/AllasTipusDAOImpl.php";

if (isset($_POST['createAllas'])) {
    $varosDAO = new VarosDAOImpl();
    $allasTipusDAO = new AllasTipusDAOImpl();
    $allasNev = $_POST['allasNev'];
    $ervenyessegi_ido = $_POST['ervId'];

    $varosID = $_POST['varosNev'];
    $varos = $varosDAO->getVaros($varosID);

    $allasTipusID = $_POST['allasTipus'];
    $allasTipus = $allasTipusDAO->getAllasTipus($allasTipusID);

    $ceg = null;

    if (!isset($_SESSION['ceg'])) {
        array_push($errors, "Nem cég-ként vagy bejelentkezve!");
    } else {
        $ceg = unserialize($_SESSION['ceg']);
        if (!$ceg) {
            array_push($errors, "Valami hiba történt a cég adatok beolvasásánál.");
        }
    }

    if (!$allasTipus) {
        array_push($errors, "Érvényetelen állás típus");
    }

     if (!$varos) {
         array_push($errors, "Érvényetelen város");
     }

    if (count($errors) == 0) {
        $allas = new Allas($allasNev, $ervenyessegi_ido, $allasTipus, $ceg, $varos);

        $allasDAO = new AllasDAOImpl();

        if (!$allasDAO->createAllas($allas)) {
            array_push($errors, "Sikertelen mentés");
        }
    }
}
