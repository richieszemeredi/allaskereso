<?php

require_once 'navigation.php';
require_once 'dao/CegDAOImpl.php';
require_once 'controller/AllasController.php';
require_once 'dao/FelhasznaloDAOImpl.php';
require_once 'cegAdatok_backend.php';

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

?>

<div class="container">
    <h2>Cég adatai</h2>
    <form method="post">
        <div class="mb-3">
            <label class="form-label" for="cegNev">Cég neve</label>
            <input class="form-control" type="text" id="cegNev" name="cegNev" autocomplete="cegNev" disabled value="<?php echo $ceg->getNev() ?>">
        </div>
        <div class="mb-3">
            <label class="form-label" for="cegMail">Cég e-mail címe</label>
            <input class="form-control" type="email" id="cegMail" autocomplete="cegMail" name="cegMail" disabled value="<?php echo $ceg->getEmail() ?>">
        </div>
    </form>
    <?php buildAllasTable($ceg); ?>
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
            <td scope="col"></td>
        </tr>';
        /** @var AllasJelentkezes $jelentkezes */
        foreach ($jelentkezesek as $jelentkezes) {
            $user = $jelentkezes->getJelentkezo();
            $allas = $jelentkezes->getAllas();
            echo '<tr>';
                echo '<td scope="row">' . $allas->getId() . '</td>';
                echo '<td>' . $allas->getNev() . '</td>';
                echo '<td>' . $user->getId() . '</td>';
                echo '<td>' . $user->getNev() . '</td>';
                echo '<td>' .getTorles($user, $allas). '</td>';
                echo '</tr>';
        }
        echo '</table>';
    echo '</div>';
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
                </form>
              ';
        }
    }
    return '';
}