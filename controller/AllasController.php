<?php

require_once 'dao/AllasDAOImpl.php';
require_once 'model/AllasJelentkezes.php';

class AllasController
{
    private static ?AllasController $instance = null;
    private $connection;

    private function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

    public static function getInstance(): AllasController{
        if (self::$instance == null) {
            self::$instance = new AllasController();
        }
        return self::$instance;
    }

    /**
     * @throws Exception
     */

    public function __clone() {
        throw new Exception("Can't clone a singleton");
    }

    public function allasJelentkezes(Allas $allas, Felhasznalo $felhasznalo): bool {
        $sql = 'INSERT INTO JELENTKEZIK(ALLAS_ID, FELHASZNALO_ID) VALUES (:allasID, :userID)';
        $parsed = oci_parse($this->connection, $sql);
        $allasID = $allas->getId();
        $userID = $felhasznalo->getId();
        oci_bind_by_name($parsed, 'allasID', $allasID);
        oci_bind_by_name($parsed, 'userID', $userID);
        return oci_execute($parsed);
    }

    public function allasJelentkezesTorles(Allas $allas, Felhasznalo $felhasznalo): bool {
        $sql = 'DELETE FROM JELENTKEZIK WHERE ALLAS_ID = :allasID AND FELHASZNALO_ID = :userID';
        $parsed = oci_parse($this->connection, $sql);
        $allasID = $allas->getId();
        $userID = $felhasznalo->getId();
        oci_bind_by_name($parsed, 'allasID', $allasID);
        oci_bind_by_name($parsed, 'userID', $userID);
        return oci_execute($parsed);
    }

    public function hasJelentkezes(Allas $allas, Felhasznalo $felhasznalo): bool {
        $sql = 'SELECT * FROM JELENTKEZIK WHERE ALLAS_ID = :allasID AND FELHASZNALO_ID = :userID';
        $parsed = oci_parse($this->connection, $sql);
        $allasID = $allas->getId();
        $userID = $felhasznalo->getId();
        oci_bind_by_name($parsed, 'allasID', $allasID);
        oci_bind_by_name($parsed, 'userID', $userID);
        oci_execute($parsed);
        if (oci_fetch_array($parsed)) {
            return true;
        }
        return false;
    }

    public function getAllasJelentkezesek(Felhasznalo $felhasznalo): array {
        $allasDAO = new AllasDAOImpl();
        $sql = 'SELECT * FROM JELENTKEZIK WHERE FELHASZNALO_ID = :id';
        $parsed = oci_parse($this->connection, $sql);
        $userID = $felhasznalo->getId();
        oci_bind_by_name($parsed, 'id', $userID);
        $jelentkezesResult = [];
        oci_execute($parsed);
        oci_fetch_all($parsed, $jelentkezesResult, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);
        $jelentkezesek = [];
        foreach ($jelentkezesResult as $result) {
            $allasID = $result['ALLAS_ID'];
            $allas = $allasDAO->getAllas($allasID);
            if ($allas) {
                array_push($jelentkezesek, new AllasJelentkezes($allas, $felhasznalo));
            }
        }
        return $jelentkezesek;
    }

}