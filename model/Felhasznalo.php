<?php


class Felhasznalo
{
    private $id;
    private $nev;
    private $email;
    private $hashed_jelszo;
    private $oneletrajz;
    private $szul_datum;

    /**
     * @param $id positive-int A felhasználó azonositója
     * @param $nev string A felhasználó teljes neve
     * @param $email string A felhasználó e-mail cime
     * @param $hashed_jelszo string A felhasználó hashelt jelszava
     * @param $oneletrajz string A felhasználó önéletrajzára mutató URL
     * @param $szul_datum string A felhasználó születési dátuma
     */
    public function __construct($nev, $email, $hashed_jelszo, $oneletrajz, $szul_datum, $id = null)
    {
        $this->id = $id;
        $this->nev = $nev;
        $this->email = $email;
        $this->hashed_jelszo = $hashed_jelszo;
        $this->setOneletrajz($oneletrajz);
        $this->szul_datum = $szul_datum;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNev(): string
    {
        return $this->nev;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getHashedJelszo(): string
    {
        return $this->hashed_jelszo;
    }

    /**
     * @return string
     */
    public function getOneletrajz(): string
    {
        return $this->oneletrajz;
    }

    /**
     * @return string
     */
    public function getSzulDatum(): string
    {
        return $this->szul_datum;
    }

    public function isValid(): bool {
        return $this->id != null;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $nev
     */
    public function setNev(string $nev): void
    {
        $this->nev = $nev;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @param string $hashed_jelszo
     */
    public function setHashedJelszo(string $hashed_jelszo): void
    {
        $this->hashed_jelszo = $hashed_jelszo;
    }

    /**
     * @param string $oneletrajz
     */
    public function setOneletrajz(string $oneletrajz): void
    {
        if ($oneletrajz == null) $oneletrajz = " ";
        $this->oneletrajz = $oneletrajz;
    }

    /**
     * @param string $szul_datum
     */
    public function setSzulDatum(string $szul_datum): void
    {
        $this->szul_datum = $szul_datum;
    }

    public function isPasswordValid(string $checkPw): bool {
        return $checkPw == $this->hashed_jelszo;
    }

}