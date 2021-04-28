<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title>Főoldal</title>
</head>
<body>
<ul>
    <li><a class="active" href="#home">Főoldal</a></li>
    <li><a href="#jobs">Állások</a></li>
    <li><a href="#inc">Cégek</a></li>
    <li style="float:right"><a href="login.php">Login</a></li>
</ul>
<?php

require_once "db/Database.php";
require_once "dao/FelhasznaloDAOImpl.php";
require_once "dao/AllasDAOImpl.php";

$conn = Database::getInstance()->getConnection();
buildAllasTable();

function buildAllasTable() {
    $allasDAO = new AllasDAOImpl();

    $emptyString = "none";

    $allasok = $allasDAO->getAllAllas();
    echo '<table>
        <th>
            <tr>
                <td>Állás ID</td>
                <td>Állás név</td>
                <td>Érvényességi idő</td>
                <td>Város neve</td>
                <td>Hirdető neve</td>
            </tr>
        </th>';
    /** @var Allas $allas */
    foreach ($allasok as $allas) {
        echo '<tr>';
        echo '<td>'.$allas->getId().'</td>';
        echo '<td>'.$allas->getNev().'</td>';
        echo '<td>'.$allas->getErvenyessegiIdo().'</td>';
        echo '<td>'.((!is_null($allas->getVaros())) ? $allas->getVaros()->getNev() : $emptyString).'</td>';
        echo '<td>'.((!is_null($allas->getHirdeto())) ? $allas->getHirdeto()->getNev() : $emptyString).'</td>';
        echo '</tr>';
    }
}

?>
</body>
</html>