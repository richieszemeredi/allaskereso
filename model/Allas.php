<?php


class Allas
{
    private ?int $id;
    private ?string $nev;
    private $ervenyessegi_ido;
    private ?AllasTipus $allastipus;
    private $varos;
    private ?Ceg $hirdeto;
    private ?Kovetelmeny $kovetelmeny;

    /**
     * Allas constructor.
     * @param int|null $id
     * @param string|null $nev
     * @param $ervenyessegi_ido
     */
    public function __construct(?string $nev, $ervenyessegi_ido, ?AllasTipus $allastipus, ?Ceg $hirdeto, $varos = null, ?int $id = null)
    {
        $this->id = $id;
        $this->nev = $nev;
        $this->ervenyessegi_ido = $ervenyessegi_ido;
        $this->allastipus = $allastipus;
        $this->varos = $varos;
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
     * @return Varos
     */
    public function getVaros(): Varos | null
    {
        return $this->varos;
    }

    /**
     * @param Varos $varos
     */
    public function setVaros(Varos $varos): void
    {
        $this->varos = $varos;
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

    /**
     * @return Kovetelmeny|null
     */
    public function getKovetelmeny(): ?Kovetelmeny
    {
        return $this->kovetelmeny;
    }

    /**
     * @param Kovetelmeny|null $kovetelmeny
     */
    public function setKovetelmeny(?Kovetelmeny $kovetelmeny): void
    {
        $this->kovetelmeny = $kovetelmeny;
    }

}