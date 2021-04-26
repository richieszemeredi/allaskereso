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
$allasDAO = new AllasDAOImpl();

$allas = new Allas("test", "1998-07-31", new AllasTipus("tesztTipus", 1), new Ceg("hehexd", 1), [new Varos(1, "Izsák", 6070)]);

$allasDAO->createAllas($allas);

echo '<h2>Dummy lekerdezes: </h2>';
echo '<table border="0">';


//// -- lekerdezzuk a tabla tartalmat
$stid = oci_parse($conn, 'SELECT * FROM DUAL');

oci_execute($stid);

//// -- eloszor csak az oszlopneveket kerem le
$nfields = oci_num_fields($stid);
echo '<tr>';
for ($i = 1; $i<=$nfields; $i++){
    $field = oci_field_name($stid, $i);
    echo '<td>' . $field . '</td>';
}
echo '</tr>';

//// -- ujra vegrehajtom a lekerdezest, es kiiratom a sorokat
oci_execute($stid);

while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    echo '<tr>';
    foreach ($row as $item) {
        echo '<td>' . $item . '</td>';
    }
    echo '</tr>';
}
echo '</table>';

oci_close($conn);


?>
</body>
</html>