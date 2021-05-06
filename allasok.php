<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
<?php
session_start();
require_once 'navigation.php';
require_once 'controller/AllasController.php';

?>
<div class="container">
    <?php

    require_once "db/Database.php";
    require_once "dao/FelhasznaloDAOImpl.php";
    require_once "dao/AllasDAOImpl.php";
    require_once 'allasok_backend.php';

    $conn = Database::getInstance()->getConnection();
    buildAllasTable();

    function buildAllasTable()
    {
        $allasDAO = new AllasDAOImpl();

        $emptyString = "none";

        $allasok = $allasDAO->getAllAllas();
        echo '<table class="table table-hover">
        <th>
            <tr>
                <td scope="col">Állás név</td>
                <td scope="col">Érvényességi idő</td>
                <td scope="col">Város neve</td>
                <td scope="col">Hirdető neve</td>
                <td></td>
            </tr>
        </th>';
        /** @var Allas $allas */
        foreach ($allasok as $allas) {
            echo '<tr>';
            echo '<td>' . $allas->getNev() . '</td>';
            echo '<td>' . $allas->getErvenyessegiIdo() . '</td>';
            echo '<td>' . ((!is_null($allas->getVaros())) ? $allas->getVaros()->getNev() : $emptyString) . '</td>';
            echo '<td>' . ((!is_null($allas->getHirdeto())) ? $allas->getHirdeto()->getNev() : $emptyString) . '</td>';
            echo '<td>' .getJelentkezes($allas). '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }

    function getJelentkezes(Allas $allas) {
        if (AuthController::getInstance()->isFelhasznaloLoggedIn()) {
            $user = AuthController::getInstance()->getCurrentFelhasznalo();
            if (!AllasController::getInstance()->hasJelentkezes($allas, $user)) {
                return '
                <form method="post">
                    <input name="allasID" type="hidden" value="'.$allas->getId().'">
                    <input value="Jelentkezés" type="submit" name="allas_jelentkezes" class="btn btn-success btn-sm rounded-0 fa fa-edit">
                </form>
              ';
            }
        }
        return '';
    }

    ?>
</div>
</body>
</html>