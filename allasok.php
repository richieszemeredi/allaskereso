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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Álláskereső</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav w-100">
                <li class="nav-item">
                    <a class="nav-link active" href="allasok.php">Állások</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cegek.php">Cégek</a>
                </li>
                <?php
                if (isset($_SESSION['felhasznalo'])) {
                    $felhasznalo = unserialize($_SESSION['felhasznalo']);
                    echo '<li style="margin-left: auto"><a class="nav-link" href="logout.php">' . $felhasznalo->getNev() . '</a></li>';
                } else {
                    echo '<li style="margin-left: auto"><a class="nav-link" href="login.php">Bejelentkezés</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
<a class="btn btn-primary" href="addAllas.php">Állás hozzáadása</a>
    <?php

    require_once "db/Database.php";
    require_once "dao/FelhasznaloDAOImpl.php";
    require_once "dao/AllasDAOImpl.php";

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
                <td scope="col">Állás ID</td>
                <td scope="col">Állás név</td>
                <td scope="col">Érvényességi idő</td>
                <td scope="col">Város neve</td>
                <td scope="col">Hirdető neve</td>
            </tr>
        </th>';
        /** @var Allas $allas */
        foreach ($allasok as $allas) {
            echo '<tr>';
            echo '<td scope="row">' . $allas->getId() . '</td>';
            echo '<td>' . $allas->getNev() . '</td>';
            echo '<td>' . $allas->getErvenyessegiIdo() . '</td>';
            echo '<td>' . ((!is_null($allas->getVaros())) ? $allas->getVaros()->getNev() : $emptyString) . '</td>';
            echo '<td>' . ((!is_null($allas->getHirdeto())) ? $allas->getHirdeto()->getNev() : $emptyString) . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }

    ?>
</div>
</body>
</html>