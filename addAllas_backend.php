<?php

$errors = [];

require_once "db/Database.php";
require_once "dao/AllasDAOImpl.php";
require_once "dao/VarosDAOImpl.php";

if (isset($_POST['createAllas'])) {
    $varosDAO = new VarosDAOImpl();

    $allasNev = $_POST['allasNev'];
    $ervenyessegi_ido = $_POST['ervId'];
    $varosID = $_POST['varosNev'];
    $varos = $varosDAO->getVaros($varosID);
    if (!$varos) {
        array_push($errors, "Érvényetelen város");
    }

    if (count($errors) == 0) {
        $allas = new Allas($allasNev, $ervenyessegi_ido, new AllasTipus("teszt", 1), new Ceg("tesztCeg", 1), $varos);

        $allasDAO = new AllasDAOImpl();

        if (!$allasDAO->createAllas($allas)) {
            array_push($errors, "Sikertelen mentés");
        }
    }
}
