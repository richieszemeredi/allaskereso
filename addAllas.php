
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
<?php include 'navigation.php'; ?>
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