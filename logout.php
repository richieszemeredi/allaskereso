<?php
require_once 'controller/AuthController.php';

AuthController::getInstance()->logoutCurrentCeg();
AuthController::getInstance()->logOutCurrentFelhasznalo();

header('Location: index.php');
