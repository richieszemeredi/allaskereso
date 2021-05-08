<?php

require_once $_SERVER['DOCUMENT_ROOT']. '/pages/navigation.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/pages/backend/cegAdatok_backend.php';

$cegDAO = new CegDAOImpl();
$ceg = null;

if (isset($_GET['cegID'])) {
    $cegID = $_GET['cegID'];
    $ceg = $cegDAO->getCeg($cegID);
} else {
    if (isset($_SESSION['ceg'])) {
        $ceg = unserialize($_SESSION['ceg']);
    }
}

$readonly = !isset($_GET['edit']) || !$ceg || !AuthController::getInstance()->isCegLoggedIn() || $ceg->getId() != AuthController::getInstance()->getCurrentCeg()->getId();

?>

<div class="container">
    <h2>Cég adatai</h2>
    <form method="post">
        <input type="hidden" name="cegID" value="<?php echo $ceg->getId() ?>">
        <div class="mb-3">
            <label class="form-label" for="cegNev">Cég neve</label>
            <input <?php if ($readonly) echo 'disabled'?> class="form-control" type="text" id="cegNev" name="cegNev" autocomplete="cegNev" value="<?php echo $ceg->getNev() ?>">
        </div>
        <div class="mb-3">
            <label class="form-label" for="cegMail">Cég e-mail címe</label>
            <input <?php if ($readonly) echo 'disabled'?> class="form-control" type="email" id="cegMail" autocomplete="cegMail" name="cegMail" value="<?php echo $ceg->getEmail() ?>">
        </div>
        <div <?php if ($readonly) echo 'style="display:none"'?> class="mb-3">
            <input class="btn btn-success" type="submit" name="ceg_modositas" value="Mentés">
        </div>
    </form>
    <form method="get">
        <div <?php if (!$readonly) echo 'style="display:none"'?> class="mb-3">
            <input type="hidden" name="edit" value="">
            <button class="btn btn-secondary" type="submit">Szerkesztés</button>
        </div>
    </form>
    <?php
    require_once 'errors.php';
    buildAllasTable($ceg);
    ?>
</div>

<?php

function buildAllasTable(Ceg $ceg)
{
$jelentkezesek = AllasController::getInstance()->getCegAllasJelentkezesek($ceg);
echo '
<div class="container">
    <div class="text-center">
        Állásra jelentkezők
    </div>
    <table class="table table-hover">
        <tr>
            <td scope="col">Állás ID</td>
            <td scope="col">Állás név</td>
            <td scope="col">Jelentkező ID</td>
            <td scope="col">Jelentkező Neve</td>
            <td scope="col">Önéletrajz URL</td>
            <td scope="col"></td>
        </tr>';
        /** @var AllasJelentkezes $jelentkezes */
        foreach ($jelentkezesek as $jelentkezes) {
            $user = $jelentkezes->getJelentkezo();
            $allas = $jelentkezes->getAllas();
            echo '<tr>';
                echo '<td>' . $allas->getId() . '</td>';
                echo '<td>' . $allas->getNev() . '</td>';
                echo '<td>' . $user->getId() . '</td>';
                echo '<td>' . $user->getNev() . '</td>';
                echo '<td>' . getOneletrajz($user) . '</td>';
                echo '<td>' .getTorles($user, $allas). '</td>';
                echo '</tr>';
        }
        echo '</table>';
    echo '</div>';
}

function getOneletrajz(Felhasznalo $user) {
    $oneletrajz = $user->getOneletrajz();
    if (empty($oneletrajz) || 1 >= strlen($oneletrajz)) {
        return "Nincs";
    }
    return $user->getOneletrajz();
}
function getTorles(Felhasznalo $user, Allas $allas): string
{
    if (AuthController::getInstance()->isCegLoggedIn()) {
        $currCeg = AuthController::getInstance()->getCurrentCeg();
        if ($currCeg->getId() == $allas->getHirdeto()->getId()) {
            return '
                <form method="post">
                    <input name="allasID" type="hidden" value="' . $allas->getId() . '">
                    <input name="userID" type="hidden" value="' . $user->getId() . '">
                    <input value="Törlés" type="submit" name="jelentkezes_torles" class="btn btn-danger btn-sm rounded-0 fa fa-edit">
                    <input value="Elfogadás" type="submit" name="jelentkezes_torles" class="btn btn-success btn-sm rounded-0 fa fa-edit">
                </form>
              ';
        }
    }
    return '';
}