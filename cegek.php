<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<?php include 'navigation.php'; ?>
<div class="container">

<?php

    require_once "db/Database.php";
    require_once "dao/CegDAOImpl.php";

    $conn = Database::getInstance()->getConnection();
    buildCegTable();

    function buildCegTable()
    {
        $cegDAO = new CegDAOImpl();
        $cegek = $cegDAO->getAllCeg();

        $isLoggedIn = AuthController::getInstance()->isCegLoggedIn();
        $currentCeg = AuthController::getInstance()->getCurrentCeg();

        echo '<table id="table" class="table table-hover text-center">
            <tr>
                <td scope="col">Cég ID</td>
                <td scope="col">Cég név</td>
                <td scope="col"></td>
            </tr>';
        /** @var Ceg $ceg */
        foreach ($cegek as $ceg) {
            echo '<tr>';
            echo '<td>' . $ceg->getId() . '</td>';
            echo '<td>' . $ceg->getNev() . '</td>';
            echo '<td>';
            if ($isLoggedIn && ($currentCeg->getId() == $ceg->getId()))
                echo '<a href="cegAdatok.php?cegID='.$ceg->getId().'" class="btn btn-success btn-sm rounded-0" type="button"><i class="fa fa-edit"></i></a>
                      <a href="cegAdatok.php?cegID='.$ceg->getId().'" class="btn btn-danger btn-sm rounded-0" type="button"><i class="fa fa-trash"></i></a>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }

    ?>

</div>
</body>
</html>