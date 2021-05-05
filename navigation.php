<?php
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
                <li class="nav-item">
                    <a class="nav-link" href="felhasznalok.php">Felhasználók</a>
                </li>'
                
                ;
                
                if (isset($_SESSION['felhasznalo'])) {
                    $felhasznalo = unserialize($_SESSION['felhasznalo']);
                    echo '<li style="margin-left: auto"><a class="nav-link" href="logout.php">' . $felhasznalo->getNev() . '</a></li>';
                }
                else if (isset($_SESSION['ceg'])) {
                    $ceg = unserialize($_SESSION['ceg']);
                    echo '<li style="margin-left: auto"><a class="nav-link" href="logout.php">' . $ceg->getNev() . '</a></li>';
                } 
                else {
                    echo '<li style="margin-left: auto"><a class="nav-link" href="login.php">Bejelentkezés</a></li>';
                }
                echo '
            </ul>
        </div>
    </div>
</nav>';
?>