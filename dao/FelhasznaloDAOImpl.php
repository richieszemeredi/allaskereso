<?php

require_once "db/Database.php";
require_once "dao/FelhasznaloDAO.php";
require_once "model/Felhasznalo.php";

class FelhasznaloDAOImpl implements FelhasznaloDAO
{

    private $db;
    private $conn;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->conn = $this->db->getConnection();
    }


    public function createFelhasznalo(Felhasznalo $felhasznalo): Felhasznalo|bool
    {
        $sql = "INSERT INTO FELHASZNALO(FELHASZNALO_NEV, FELHASZNALO_EMAIL, FELHASZNALO_JELSZO, ONELETRAJZ_URL, SZUL_DATUM)
                VALUES (:nev, :email, :pw, :oneletrajz, TO_TIMESTAMP(:szul, 'YY-MM-DD')) RETURNING FELHASZNALO_ID INTO :id";
        $parsed = oci_parse($this->conn, $sql);

        $nev = $felhasznalo->getNev();
        $email = $felhasznalo->getEmail();
        $pw = $felhasznalo->getHashedJelszo();
        $oneletrajz = $felhasznalo->getOneletrajz();
        $szuldatum = strval($felhasznalo->getSzulDatum());

        oci_bind_by_name($parsed, "id", $id);
        oci_bind_by_name($parsed, "nev", $nev);
        oci_bind_by_name($parsed, "email", $email);
        oci_bind_by_name($parsed, "pw", $pw);
        oci_bind_by_name($parsed, "oneletrajz", $oneletrajz);
        oci_bind_by_name($parsed, "szul", $szuldatum);

        $result = oci_execute($parsed);
        if ($result) {
            $felhasznalo->setId($id);
            return $felhasznalo;
        } else {
            return false;
        }
    }

    public function getFelhasznalo(int|string $id): Felhasznalo | bool
    {
        if (is_int($id)) {
            $sql = 'SELECT * FROM Felhasznalo WHERE Felhasznalo_ID = '.$id;
        } else {
            $sql = 'SELECT * FROM Felhasznalo WHERE FELHASZNALO_NEV = \''.$id.'\'';
        }

        $parsed = oci_parse($this->conn, $sql);
        oci_execute($parsed);
        $result = oci_fetch_array($parsed);
        if (!$result) {
            return false;
        }
        return new Felhasznalo($result['FELHASZNALO_NEV'], $result['FELHASZNALO_EMAIL'], $result['FELHASZNALO_JELSZO'], $result['ONELETRAJZ_URL'], $result['SZUL_DATUM'], $result['FELHASZNALO_ID']);
    }

    public function getAllFelhasznalo(): array | bool
    {
        $sql = 'SELECT * FROM Felhasznalo';
        $parsed = oci_parse($this->conn, $sql);
        oci_execute($parsed);
        $resultArray = [];
        oci_fetch_all($parsed, $resultArray, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);

        if (!$resultArray) {
            return false;
        }

        $felhasznalok = [];

        foreach ($resultArray as $result) {
            $felhasznalo = new Felhasznalo($result['FELHASZNALO_NEV'], $result['FELHASZNALO_EMAIL'], $result['FELHASZNALO_JELSZO'], $result['ONELETRAJZ_URL'], $result['SZUL_DATUM'], $result['FELHASZNALO_ID']);
            $felhasznalok[$felhasznalo->getId()] = $felhasznalo;
        }
        return $felhasznalok;
    }

    public function updateFelhasznalo(int $id, Felhasznalo $felhasznalo): bool
    {
        // TODO: Implement updateFelhasznalo() method.
    }

    public function removeFelhasznalo(int $id): bool
    {
        // TODO: Implement removeFelhasznalo() method.
    }

    public function felhasznaloExists(string $email_or_name): bool
    {
        $sql = "SELECT * FROM FELHASZNALO WHERE FELHASZNALO_NEV = '$email_or_name' OR FELHASZNALO_EMAIL = '$email_or_name'";
        $parsed = oci_parse($this->conn, $sql);
        oci_execute($parsed);
        $rowNum = oci_num_rows($parsed);
        if ($rowNum > 0) {
            return true;
        }
        return false;
    }
}