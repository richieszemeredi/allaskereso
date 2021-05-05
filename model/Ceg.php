<?php


class Ceg
{
    private ?int $id;
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
    public function __construct($nev, $email, $hashed_jelszo, $id = null)
    {
        $this->id = $id;
        $this->nev = $nev;
        $this->email = $email;
        $this->hashed_jelszo = $hashed_jelszo;
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

    

    public function isPasswordValid(string $checkPw): bool {
        return $checkPw == $this->hashed_jelszo;
    }

}