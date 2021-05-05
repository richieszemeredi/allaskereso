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
    require_once "dao/FelhasznaloDAOImpl.php";

    $conn = Database::getInstance()->getConnection();
    buildFelhasznaloTable();

    function buildFelhasznaloTable()
    {
        $felhasznaloDAO = new FelhasznaloDAOImpl();

        $emptyString = "none";

        $felhasznalok = $felhasznaloDAO->getAllFelhasznalo();
        echo '<table class="table table-hover">
        <th>
            <tr>
                <td scope="col">Felhasznalo ID</td>
                <td scope="col">Felhasznalo név</td>
            </tr>
        </th>';
        foreach ($felhasznalok as $felhasznalo) {
            echo '<tr>';
            echo '<td scope="row">' . $felhasznalo->getId() . '</td>';
            echo '<td>' . $felhasznalo->getNev() . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }

    ?>

</div>
</body>
</html>