<?php

require_once 'navigation.php';
require_once 'dao/CegDAOImpl.php';

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
</div>
