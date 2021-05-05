
<!DOCTYPE html>
<?php include('addAllas_backend.php'); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
                <?php
                if (isset($_SESSION['felhasznalo'])) {
                    $felhasznalo = unserialize($_SESSION['felhasznalo']);
                    echo '<li style="margin-left: auto"><a class="nav-link" href="logout.php">' . $felhasznalo->getNev() . '</a></li>';
                } else {
                    echo '<li style="margin-left: auto"><a class="nav-link" href="login.php">Bejelentkezés</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <?php include('errors.php'); ?>
    <form action="addAllas_backend.php" method="post">
        <div class="mb-3">
            <label for="allasNev" class="form-label">Állás neve</label>
            <input type="text" class="form-control" id="allasNev" name="allasNev" required>
        </div>
         <div class="mb-3">
            <label for="ervId" class="form-label">Érvényességi idő</label>
            <input type="date" class="form-control" id="ervId" name="ervId">
        </div>
         <div class="mb-3">
            <label for="varosNev" class="form-label">Város neve</label>
            <input type="text" class="form-control" id="varosNev" name="varosNev" required>
        </div>
        <button name="createAllas" type="submit" class="btn btn-primary">Álláshírdetés feladása</button>
    </form>
</div>
</body>
</html>