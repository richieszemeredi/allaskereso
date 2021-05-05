<?php

require_once 'VarosDAO.php';

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

    public function getVaros(int|string $iranyitoSzamVagyNev): Varos | bool {
        $parsed = oci_parse($this->conn, $this->getVarosSQL." WHERE VAROS_ID = :id OR VAROSNEV = :nev OR IRANYITOSZAM = :szam");
        oci_bind_by_name($parsed, 'id', $iranyitoSzamVagyNev);
        oci_bind_by_name($parsed, 'nev', $iranyitoSzamVagyNev);
        oci_bind_by_name($parsed, 'szam', $iranyitoSzamVagyNev);
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
        $iranyitoSzam = $result['IRANYITOSZAM'];
        return new Varos($varosID, $varosNev, $iranyitoSzam);
    }
}