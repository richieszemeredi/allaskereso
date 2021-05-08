<?php

require_once $_SERVER['DOCUMENT_ROOT']. '/db/Database.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/dao/VarosDAO.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/model/Varos.php';

class VarosDAOImpl implements VarosDAO
{

    private $db;
    private $conn;
    private $getVarosSQL = 'SELECT * FROM VAROSOK';

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->conn = $this->db->getConnection();
    }

    public function getVaros($idVagyNev): Varos | bool {
        $getVaros = $this->getVarosSQL.' WHERE VAROSNEV = :nev OR VAROS_ID = :id';
        $parsed = oci_parse($this->conn, $getVaros);

        // Kicsit butus a bind, azt ha nem szám az input akkor itt dob egy csunya warningot
        if (is_numeric($idVagyNev)) {
            oci_bind_by_name($parsed, 'id', $idVagyNev);
        } else {
            $i = 0;
            oci_bind_by_name($parsed, 'id', $i);
        }

        oci_bind_by_name($parsed, 'nev', $idVagyNev);
        oci_execute($parsed);
        $varosResult = oci_fetch_array($parsed);
        if ($varosResult) {
            return $this->createVarosFromResult($varosResult);
        }
        return false;
    }

    public function getAllVaros(): array {
        $parsed = oci_parse($this->conn, $this->getVarosSQL);
        oci_execute($parsed);
        $varosResult = oci_fetch_array($parsed);
        $varosok = [];

        foreach ($varosResult as $result) {
            array_push($varosok, $this->createVarosFromResult($result));
        }

        return $varosok;
    }

    private function createVarosFromResult($result) : Varos {
        $varosID = $result['VAROS_ID'];
        $varosNev = $result['VAROSNEV'];
        return new Varos($varosID, $varosNev);
    }
}