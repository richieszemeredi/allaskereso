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
<?php require_once $_SERVER['DOCUMENT_ROOT']. '/pages/navigation.php'; ?>
<div class="container">

<?php

    buildFelhasznaloTable();

    function buildFelhasznaloTable()
    {
        $felhasznaloDAO = new FelhasznaloDAOImpl();


        $felhasznalok = $felhasznaloDAO->getAllFelhasznalo();
        echo '<table class="table table-hover">
        <tr>
            <td scope="col">Felhasznalo ID</td>
            <td scope="col">Felhasznalo név</td>
        </tr>';
        if ($felhasznalok) {
            foreach ($felhasznalok as $felhasznalo) {
                echo '<tr>';
                echo '<td>' . $felhasznalo->getId() . '</td>';
                echo '<td>' . $felhasznalo->getNev() . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        }
    }
    ?>

</div>
</body>
</html>