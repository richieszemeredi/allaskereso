<?php

require_once "AllasDAO.php";
require_once "model/Allas.php";
require_once "model/Ceg.php";
require_once "model/AllasTipus.php";
require_once "model/Varos.php";
require_once "model/Kovetelmeny.php";

class AllasDAOImpl implements AllasDAO
{

    private $db;
    private $conn;
    private $selectAllasSQL =  'SELECT DISTINCT allasok.allas_id AS ALLASID,
                                    allasok.allas_nev AS ALLASNEV, 
                                    TO_CHAR(allasok.ervenyessegi_ido, \'YYYY/MM/DD\') AS ERVENYESSEGIIDO,
                                    allastipus.TIPUS_ID AS TIPUSID, 
                                    ALLASTIPUS.TIPUS_NEV AS TIPUSNEV,
                                    VAROS.VAROS_ID AS VAROSID, 
                                    VAROS.VAROS_NEV AS VAROSNEV, 
                                    KOVETELMENYEK.KOV_ID AS KOVID, 
                                    KOVETELMENYEK.KOV_NEV AS KOVNEV,
                                    CEG.CEG_ID AS CEGID, 
                                    CEG.CEG_NEV AS CEGNEV,
                                    CEG.CEG_EMAIL AS CEGEMAIL,
                                    CEG.CEG_JELSZO AS CEGJELSZO
                                FROM ALLASOK
                                    LEFT JOIN (SELECT VANTIPUS.ALLAS_ID AS ALLAS_ID, ALLASTIPUS.TIPUS_ID AS TIPUS_ID, ALLASTIPUS.TIPUS_NEV AS TIPUS_NEV FROM VANTIPUS LEFT JOIN ALLASTIPUS ON VANTIPUS.TIPUS_ID = ALLASTIPUS.TIPUS_ID) ALLASTIPUS
                                        ON allastipus.allas_id = ALLASOK.ALLAS_ID
                                    LEFT JOIN (SELECT ELOFORDUL.ALLAS_ID AS ALLAS_ID, VAROSOK.VAROS_ID AS VAROS_ID, VAROSOK.VAROSNEV AS VAROS_NEV FROM ELOFORDUL LEFT JOIN VAROSOK ON ELOFORDUL.VAROS_ID = VAROSOK.VAROS_ID) VAROS
                                        ON VAROS.allas_id = ALLASOK.ALLAS_ID
                                    LEFT JOIN (SELECT FELTETELE.ALLAS_ID AS ALLAS_ID, KOVETELMENYEK.KOV_ID AS KOV_ID, KOVETELMENYEK.KOV_NEV AS KOV_NEV FROM FELTETELE LEFT JOIN KOVETELMENYEK ON FELTETELE.KOV_ID = KOVETELMENYEK.KOV_ID) KOVETELMENYEK
                                        ON KOVETELMENYEK.allas_id = ALLASOK.ALLAS_ID
                                    LEFT JOIN (SELECT MEGHIRDET.ALLAS_ID AS ALLAS_ID, CEG.CEG_ID AS CEG_ID, CEG.CEG_NEV AS CEG_NEV, CEG.CEG_EMAIL as CEG_EMAIL, CEG.CEG_JELSZO AS CEG_JELSZO FROM MEGHIRDET LEFT JOIN CEG ON MEGHIRDET.CEG_ID = CEG.CEG_ID) CEG
                                        ON CEG.allas_id = ALLASOK.ALLAS_ID';

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->conn = $this->db->getConnection();
    }

    public function createAllas(Allas $allas): Allas | bool
    {
        $allasSQL = "INSERT INTO ALLASOK(ALLAS_NEV, ERVENYESSEGI_IDO)
                VALUES (:nev, TO_TIMESTAMP(:ido, 'YYYY/MM/DD')) RETURNING ALLAS_ID INTO :allasID";
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
        return true;
    }

    private function saveAllasElofordulas(Allas $allas): bool {
        $allasID = $allas->getId();
        $varos = $allas->getVaros();
        if ($varos == null) return true;
        $varosID = $varos->getId();
        $allasVarosSQL = "INSERT INTO ELOFORDUL(ALLAS_ID, VAROS_ID) VALUES (:allasID, :varosID)";
        $varosParsed = oci_parse($this->conn, $allasVarosSQL);
        oci_bind_by_name($varosParsed, "allasID", $allasID);
        oci_bind_by_name($varosParsed, "varosID", $varosID);
        return oci_execute($varosParsed);
    }

    private function saveAllasTipus(Allas $allas): bool {
        $allasTipus = $allas->getAllastipus();
        if ($allasTipus == null) return true;
        $allasID = $allas->getId();
        $allasTipusID = $allasTipus->getId();
        $allasTipusSQL = "INSERT INTO VANTIPUS(ALLAS_ID, TIPUS_ID)
                VALUES (:allasID, :tipusID)";
        $tipusParsed = oci_parse($this->conn, $allasTipusSQL);
        oci_bind_by_name($tipusParsed, "allasID", $allasID);
        oci_bind_by_name($tipusParsed, "tipusID", $allasTipusID);
        return oci_execute($tipusParsed);
    }

    public function getAllas(int $id): Allas | bool
    {
        $parsed = oci_parse($this->conn, $this->selectAllasSQL . ' WHERE ALLASOK.ALLAS_ID = ' . $id);
        oci_execute($parsed);
        $result = oci_fetch_array($parsed);
        if (!$result) {
            return false;
        }
        return $this->createAllasFromResultArray($result);
    }

    public function getAllAllas(): array
    {
        $parsed = oci_parse($this->conn, $this->selectAllasSQL);
        oci_execute($parsed);
        $resultArray = [];
        oci_fetch_all($parsed, $resultArray, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);

        $allasok = [];

        foreach ($resultArray as $result) {
            array_push($allasok, $this->createAllasFromResultArray($result));
        }
        return $allasok;
    }

    private function createAllasFromResultArray(array $resultArr): Allas {
        $allasID = $resultArr['ALLASID'];
        $allasNev = $resultArr['ALLASNEV'];
        $ervenyessegiIdo = $resultArr['ERVENYESSEGIIDO'];

        $allas = new Allas($allasNev, $ervenyessegiIdo, null, null, null, $allasID);

        if ($this->hasTipus($resultArr)) {
            $allas->setAllastipus(new AllasTipus($resultArr['TIPUSNEV'], $resultArr['TIPUSID']));
        }
        if ($this->hasCeg($resultArr)) {
            $allas->setHirdeto(new Ceg($resultArr['CEGNEV'],$resultArr['CEGEMAIL'], $resultArr['CEGJELSZO'], $resultArr['CEGID']));
        }
        if($this->hasVaros($resultArr)) {
            $allas->setVaros(new Varos($resultArr['VAROSID'], $resultArr['VAROSNEV']));
        }
        if($this->hasKovetelmeny($resultArr)) {
            $allas->setKovetelmeny(new Kovetelmeny($resultArr['KOVID'], $resultArr['KOVNEV']));
        }

        return $allas;
    }

    private function hasTipus(array $resultArr): bool {
        return isset($resultArr['TIPUSID']);
    }

    private function hasKovetelmeny(array $resultArr): bool {
        return isset($resultArr['KOVID']);
    }

    private function hasVaros(array $resultArr): bool {
        return isset($resultArr['VAROSID']);
    }

    private function hasCeg(array $resultArr): bool {
        return isset($resultArr['CEGID']);
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