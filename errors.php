<?php
    if (count($errors) > 0) : ?>
    <div class="container text-center mt-5">
        <div class="alert alert-danger">
            <?php foreach ($errors as $error) : ?>
                <p><?php echo $error ?></p>
            <?php endforeach ?>
        </div>
    </div>
<?php  endif ?>
