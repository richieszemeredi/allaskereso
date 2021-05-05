<?php

require_once "db/Database.php";
require_once "dao/CegDAO.php";
require_once "model/Ceg.php";

class CegDAOImpl implements CegDAO
{

    private $db;
    private $conn;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->conn = $this->db->getConnection();
    }

    private function bindCeg($parsed, Ceg $ceg) {
        $nev = $ceg->getNev();
        $email = $ceg->getEmail();
        $pw = $ceg->getHashedJelszo();

        oci_bind_by_name($parsed, "nev", $nev);
        oci_bind_by_name($parsed, "email", $email);
        oci_bind_by_name($parsed, "pw", $pw);
    }

    public function createCeg(Ceg $ceg): Ceg|bool
    {
        $sql = "INSERT INTO CEG(CEG_NEV, CEG_EMAIL, CEG_JELSZO)
                VALUES (:nev, :email, :pw) RETURNING CEG_ID INTO :id";
        $parsed = oci_parse($this->conn, $sql);

        $this->bindCeg($parsed, $ceg);

        oci_bind_by_name($parsed, "id", $id);

        $result = oci_execute($parsed);
        if ($result) {
            $ceg->setId($id);
            return $ceg;
        } else {
            return false;
        }
    }

    public function getCeg(int|string $id): Ceg | bool
    {
        if (is_int($id)) {
            $sql = 'SELECT * FROM Ceg WHERE Ceg_ID = '.$id;
        } else {
            $sql = 'SELECT * FROM Ceg WHERE CEG_NEV = \''.$id.'\'';
        }

        $parsed = oci_parse($this->conn, $sql);
        oci_execute($parsed);
        $result = oci_fetch_array($parsed);
        if (!$result) {
            return false;
        }
        return new Ceg($result['CEG_NEV'], $result['CEG_EMAIL'], $result['CEG_JELSZO'],   $result['CEG_ID']);
    }

    public function getAllCeg(): array | bool
    {
        $sql = 'SELECT * FROM Ceg';
        $parsed = oci_parse($this->conn, $sql);
        oci_execute($parsed);
        $resultArray = [];
        oci_fetch_all($parsed, $resultArray, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);

        if (!$resultArray) {
            return false;
        }

        $cegek = [];

        foreach ($resultArray as $result) {
            $ceg = new Ceg($result['CEG_NEV'], $result['CEG_EMAIL'], $result['CEG_JELSZO'], $result['CEG_ID']);
            $cegek[$ceg->getId()] = $ceg;
        }
        return $cegek;
    }

    public function updateCeg(int $id, Ceg $ceg): bool
    {
        $sql = 'UPDATE Ceg SET
                CEG_NEV = :nev,
                CEG_EMAIL = :email,
                CEG_JELSZO = :pw,
                WHERE CEG_ID = :id';

        $parsed = oci_parse($this->conn, $sql);
        $this->bindCeg($parsed, $ceg);
        $id = $ceg->getId();
        oci_bind_by_name($parsed, "id", $id);
        return oci_execute($parsed);
    }

    public function removeCeg(int $id): bool
    {
        $sql = 'DELETE FROM Ceg WHERE CEG_ID = :id';
        $parsed = oci_parse($this->conn, $sql);
        oci_bind_by_name($parsed, "id", $id);
        return oci_execute($parsed);
    }

    public function cegExists(string $email_or_name): bool
    {
        $sql = "SELECT * FROM CEG WHERE CEG_NEV = '$email_or_name' OR CEG_EMAIL = '$email_or_name'";
        $parsed = oci_parse($this->conn, $sql);
        oci_execute($parsed);
        $rowNum = oci_num_rows($parsed);
        if ($rowNum > 0) {
            return true;
        }
        return false;
    }
}