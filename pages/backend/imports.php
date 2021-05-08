<?php

//models
require_once $_SERVER['DOCUMENT_ROOT']. '/model/Allas.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/model/AllasJelentkezes.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/model/AllasTipus.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/model/Ceg.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/model/Felhasznalo.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/model/Kovetelmeny.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/model/Varos.php';

//Database
require_once $_SERVER['DOCUMENT_ROOT']. '/db/Database.php';

//controller
require_once $_SERVER['DOCUMENT_ROOT']. '/controller/AllasController.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/controller/AuthController.php';

//DAO
require_once $_SERVER['DOCUMENT_ROOT']. '/dao/AllasDAOImpl.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/dao/AllasTipusDAOImpl.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/dao/CegDAOImpl.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/dao/FelhasznaloDAOImpl.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/dao/VarosDAOImpl.php';
