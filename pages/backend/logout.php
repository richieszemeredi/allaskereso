<?php

require_once $_SERVER['DOCUMENT_ROOT']. '/pages/navigation.php';

AuthController::getInstance()->logoutCurrentCeg();
AuthController::getInstance()->logOutCurrentFelhasznalo();

header('Location: /index.php');
