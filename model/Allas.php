<?php


class Allas
{
    private ?int $id;
    private ?string $nev;
    private $ervenyessegi_ido;
    private AllasTipus $allastipus;
    private $varosok;
    private ?Ceg $hirdeto;

    /**
     * Allas constructor.
     * @param int|null $id
     * @param string|null $nev
     * @param $ervenyessegi_ido
     */
    public function __construct(?string $nev, $ervenyessegi_ido, AllasTipus $allastipus, ?Ceg $hirdeto, $varosok = null, ?int $id = null)
    {
        $this->id = $id;
        $this->nev = $nev;
        $this->ervenyessegi_ido = $ervenyessegi_ido;
        $this->allastipus = $allastipus;
        $this->varosok = $varosok;
        $this->hirdeto = $hirdeto;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getNev(): ?string
    {
        return $this->nev;
    }

    /**
     * @param string|null $nev
     */
    public function setNev(?string $nev): void
    {
        $this->nev = $nev;
    }

    /**
     * @return mixed
     */
    public function getErvenyessegiIdo()
    {
        return $this->ervenyessegi_ido;
    }

    /**
     * @param mixed $ervenyessegi_ido
     */
    public function setErvenyessegiIdo($ervenyessegi_ido): void
    {
        $this->ervenyessegi_ido = $ervenyessegi_ido;
    }

    public function getAllastipus(): AllasTipus
    {
        return $this->allastipus;
    }

    public function setAllastipus($allastipus): void
    {
        $this->allastipus = $allastipus;
    }

    public function isValid(): bool {
        return $this->getId() == null;
    }

    /**
     * @return mixed|null
     */
    public function getVarosok(): mixed
    {
        return $this->varosok;
    }

    /**
     * @param mixed|null $varosok
     */
    public function setVarosok(mixed $varosok): void
    {
        $this->varosok = $varosok;
    }

    /**
     * @return Ceg|null
     */
    public function getHirdeto(): ?Ceg
    {
        return $this->hirdeto;
    }

    /**
     * @param Ceg|null $hirdeto
     */
    public function setHirdeto(?Ceg $hirdeto): void
    {
        $this->hirdeto = $hirdeto;
    }



}