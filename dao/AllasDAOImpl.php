<?php

require_once "AllasDAO.php";
require_once "model/Allas.php";
require_once "model/Ceg.php";
require_once "model/AllasTipus.php";
require_once "model/Varos.php";

class AllasDAOImpl implements AllasDAO
{

    private $db;
    private $conn;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->conn = $this->db->getConnection();
    }

    public function createAllas(Allas $allas): Allas | bool
    {
        $allasSQL = "INSERT INTO ALLASOK(ALLAS_NEV, ERVENYESSEGI_IDO)
                VALUES (:nev, TO_TIMESTAMP(:ido, 'YY-MM-DD')) RETURNING ALLAS_ID INTO :allasID";
        $allasNev = $allas->getNev();
        $ido = $allas->getErvenyessegiIdo();
        $allasParsed = oci_parse($this->conn, $allasSQL);
        oci_bind_by_name($allasParsed, "nev", $allasNev);
        oci_bind_by_name($allasParsed, "ido", $ido);
        oci_bind_by_name($allasParsed, "allasID", $allasID);
        $allasResult = oci_execute($allasParsed);

        if ($allasResult) {
            $allas->setId($allasID);
            $tipusResult = $this->saveAllasTipus($allas);
            $varosResult = $this->saveAllasElofordulas($allas);
            $hirdetoResult = $this->saveAllasHirdeto($allas);
            if ($tipusResult && $varosResult && $hirdetoResult) {
                return $allas;
            }
        }
        return false;
    }

    private function saveAllasHirdeto(Allas $allas): bool {
        $hirdeto = $allas->getHirdeto();
        if ($hirdeto) {
            $allasID = $allas->getId();
            $hirdetoID = $hirdeto->getId();
            $hirdetoSQL = 'INSERT INTO MEGHIRDET(ALLAS_ID, CEG_ID) VALUES (:allasID, :cegID)';
            $hirdetoParsed = oci_parse($this->conn, $hirdetoSQL);
            oci_bind_by_name($hirdetoParsed, "allasID", $allasID);
            oci_bind_by_name($hirdetoParsed, "cegID", $hirdetoID);
            return oci_execute($hirdetoParsed);
        }
        return false;
    }

    private function saveAllasElofordulas(Allas $allas): bool {
        $allasID = $allas->getId();
        $allasVarosok = $allas->getVarosok();
        $successfull = 0;
        foreach ($allasVarosok as $varos) {
            $varosID = $varos->getId();
            $allasVarosSQL = "INSERT INTO ELOFORDUL(ALLAS_ID, VAROS_ID)
                VALUES (:allasID, :varosID)";
            $varosParsed = oci_parse($this->conn, $allasVarosSQL);
            oci_bind_by_name($varosParsed, "allasID", $allasID);
            oci_bind_by_name($varosParsed, "varosID", $varosID);
            if (oci_execute($varosParsed)) {
                $successfull++;
            }
        }
        return $successfull == count($allasVarosok);
    }

    private function saveAllasTipus(Allas $allas): bool {
        $allasTipus = $allas->getAllastipus();
        $allasID = $allas->getId();
        $allasTipusID = $allasTipus->getId();
        $allasTipusSQL = "INSERT INTO VANTIPUS(ALLAS_ID, TIPUS_ID)
                VALUES (:allasID, :tipusID)";
        $tipusParsed = oci_parse($this->conn, $allasTipusSQL);
        oci_bind_by_name($tipusParsed, "allasID", $allasID);
        oci_bind_by_name($tipusParsed, "tipusID", $allasTipusID);
        return oci_execute($tipusParsed);
    }

    public function getAllas(int $id): Allas
    {
        // TODO: Implement getAllas() method.
    }

    public function getAllAllas(): array
    {
        // TODO: Implement getAllAllas() method.
    }

    public function updateAllas(int $id, Allas $allas): bool
    {
        // TODO: Implement updateAllas() method.
    }

    public function removeAllas(int $id): bool
    {
        // TODO: Implement removeAllas() method.
    }

    public function allasExists(int $id): bool
    {
        // TODO: Implement allasExists() method.
    }
}