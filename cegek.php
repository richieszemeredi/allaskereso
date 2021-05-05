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

        $emptyString = "none";

        $cegek = $cegDAO->getAllCeg();
        echo '<table class="table table-hover">
        <th>
            <tr>
                <td scope="col">Cég ID</td>
                <td scope="col">Cég név</td>
            </tr>
        </th>';
        /** @var Ceg $ceg */
        foreach ($cegek as $ceg) {
            echo '<tr>';
            echo '<td scope="row">' . $ceg->getId() . '</td>';
            echo '<td>' . $ceg->getNev() . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }

    ?>

</div>
</body>
</html>