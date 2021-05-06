<?php

require_once 'navigation.php';
require_once 'dao/CegDAOImpl.php';
require_once 'dao/FelhasznaloDAOImpl.php';
require_once 'controller/AllasController.php';
require_once 'user_adatlap_backend.php';

$cegDAO = new CegDAOImpl();
$userDAO = new FelhasznaloDAOImpl();
$ceg = null;
$user = null;

if (isset($_GET['userID'])) {
    $userID = $_GET['userID'];
    $user = $userDAO->getFelhasznalo($userID);
} else {
    if (AuthController::getInstance()->isFelhasznaloLoggedIn()) {
        $user = AuthController::getInstance()->getCurrentFelhasznalo();
    }
}

?>

<div class="container">
    <h2><?php if ($user) echo $user->getNev(); else echo "Senki" ?> adatlapja</h2>
    <form method="post" action="register_user.php">
        <div class="mb-3">
            <label class="form-label" for="nev">Név</label>
            <input disabled class="form-control" type="text" name="username" value="<?php if ($user) echo $user->getNev() ?>">
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input disabled class="form-control" type="email" name="email" value="<?php if ($user) echo $user->getEmail() ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Önéletrajt URL</label>
            <input disabled class="form-control" type="text" name="oneletrajz" value="<?php if ($user) echo $user->getOneletrajz() ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Születési dátum</label>
            <input disabled class="form-control" type="date" name="szul_date" value="<?php if ($user) echo $user->getSzulDatum() ?>">
        </div>
    </form>
</div>

<?php
if ($user)
    buildAllasTable($user);

function buildAllasTable(Felhasznalo $user)
{
    $jelentkezesek = AllasController::getInstance()->getAllasJelentkezesek($user);
    $emptyString = "None";
    echo '
<div class="container">
<div class="text-center">
    Jelentkezett állások
</div>
<table class="table table-hover">
            <tr>
                <td scope="col">Állás ID</td>
                <td scope="col">Állás név</td>
                <td scope="col">Érvényességi idő</td>
                <td scope="col">Város neve</td>
                <td scope="col">Hirdető neve</td>
                <td scope="col"></td>
            </tr>';
    /** @var AllasJelentkezes $jelentkezes */
    foreach ($jelentkezesek as $jelentkezes) {
        $allas = $jelentkezes->getAllas();
        echo '<tr>';
        echo '<td scope="row">' . $allas->getId() . '</td>';
        echo '<td>' . $allas->getNev() . '</td>';
        echo '<td>' . $allas->getErvenyessegiIdo() . '</td>';
        echo '<td>' . ((!is_null($allas->getVaros())) ? $allas->getVaros()->getNev() : $emptyString) . '</td>';
        echo '<td>' . ((!is_null($allas->getHirdeto())) ? $allas->getHirdeto()->getNev() : $emptyString) . '</td>';
        echo '<td>' .getTorles($user, $allas). '</td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '</div>';
}

function getTorles(Felhasznalo $user, Allas $allas): string
{
    if (AuthController::getInstance()->isFelhasznaloLoggedIn()) {
        $currUser = AuthController::getInstance()->getCurrentFelhasznalo();
        if ($user->getId() == $currUser->getId() && AllasController::getInstance()->hasJelentkezes($allas, $user)) {
            return '
                <form method="post">
                    <input name="allasID" type="hidden" value="'.$allas->getId().'">
                    <input value="Törlés" type="submit" name="jelentkezes_torles" class="btn btn-danger btn-sm rounded-0 fa fa-edit">
                </form>
              ';
        }
    }
    return '';
}