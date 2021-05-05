<?php

session_start();

unset($_SESSION['felhasznalo']);
unset($_SESSION['ceg']);

header('Location: index.php');
