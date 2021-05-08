<?php

require_once $_SERVER['DOCUMENT_ROOT']. '/db/Database.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/dao/AllasTipusDAO.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/model/AllasTipus.php';

class AllasTipusDAOImpl implements AllasTipusDAO
{

    private $db;
    private $conn;
    private $getTipusSQL = 'SELECT TIPUS_ID, TIPUS_NEV FROM ALLASTIPUS';

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->conn = $this->db->getConnection();
    }

    public function getAllasTipus($idVagyNev): AllasTipus|bool
    {
        $parsed = oci_parse($this->conn, $this->getTipusSQL." WHERE TIPUS_ID = :id OR TIPUS_NEV = :nev");
        oci_bind_by_name($parsed, 'id', $idVagyNev);
        oci_bind_by_name($parsed, 'nev', $idVagyNev);
        oci_execute($parsed);
        $tipusResult = oci_fetch_array($parsed);
        if ($tipusResult) {
            return $this->createTipusFromResult($tipusResult);
        }
        return false;
    }

    public function getAllAllasTipus(): array
    {
        $parsed = oci_parse($this->conn, $this->getTipusSQL);
        oci_execute($parsed);
        $tipusResult = [];
        oci_fetch_all($parsed, $tipusResult, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);
        $tipusok = [];

        foreach ($tipusResult as $result) {
            array_push($tipusok, $this->createTipusFromResult($result));
        }

        return $tipusok;
    }

    private function createTipusFromResult($result) : AllasTipus {
        $tipusID = $result['TIPUS_ID'];
        $tipusNev = $result['TIPUS_NEV'];
        return new AllasTipus($tipusNev, $tipusID);
    }
}