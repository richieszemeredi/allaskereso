<?php


interface CegDAO
{

    /**
     * @param $ceg Ceg ID nélküli felhasználó, akit a DB-be próbálunk menteni.
     * @return Ceg|bool Az ID-vel frissitett objektumot adja vissza, vagy false-t ha sikertelen
     * az adatbázisba való mentés.
     */
    public function createCeg(Ceg $ceg) : Ceg | bool;

    /**
     * @param $id int A lekérendő felhasználó ID-je
     * @return Ceg|bool A lekért felhasználó, vagy false-t ha nem találtuk meg.
     */
    public function getCeg(int $id) : Ceg | bool;

    /**
     * @return array|bool Vissza adja az összes felhasználót
     */

    public function getAllCeg(): array | bool;

    /**
     * @param $id int A frissitendő felhasználó ID-je
     * @param $ceg Ceg A frissitett felhasználó objektuma
     * @return bool Igaz ha sikeres, hamis ha nem.
     */
    public function updateCeg(int $id, Ceg $ceg) : bool;

    /**
     * @param int $id A törlendő felhasználó ID-je
     * @return bool Igaz, ha sikeres, hamis ha nem.
     */
    public function removeCeg(int $id) : bool;

    public function cegExists(string $email_or_name) : bool;

}