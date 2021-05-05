<?php


interface FelhasznaloDAO
{

    /**
     * @param $felhasznalo Felhasznalo ID nélküli felhasználó, akit a DB-be próbálunk menteni.
     * @return Felhasznalo|bool Az ID-vel frissitett objektumot adja vissza, vagy false-t ha sikertelen
     * az adatbázisba való mentés.
     */
    public function createFelhasznalo(Felhasznalo $felhasznalo) : Felhasznalo | bool;

    /**
     * @param $id int A lekérendő felhasználó ID-je
     * @return Felhasznalo|bool A lekért felhasználó, vagy false-t ha nem találtuk meg.
     */
    public function getFelhasznalo(int $id) : Felhasznalo | bool;

    /**
     * @return array|bool Vissza adja az összes felhasználót
     */

    public function getAllFelhasznalo(): array | bool;

    /**
     * @param $id int A frissitendő felhasználó ID-je
     * @param $felhasznalo Felhasznalo A frissitett felhasználó objektuma
     * @return bool Igaz ha sikeres, hamis ha nem.
     */
    public function updateFelhasznalo(int $id, Felhasznalo $felhasznalo) : bool;

    /**
     * @param int $id A törlendő felhasználó ID-je
     * @return bool Igaz, ha sikeres, hamis ha nem.
     */
    public function removeFelhasznalo(int $id) : bool;

    public function felhasznaloExists(string $email_or_name) : bool;

}