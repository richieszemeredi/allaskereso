<?php


class Varos
{
    private ?int $id;
    private string $nev;

    /**
     * Varos constructor.
     * @param int|null $id
     * @param string $nev
     */
    public function __construct(?int $id, string $nev)
    {
        $this->id = $id;
        $this->nev = $nev;
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
     * @return string
     */
    public function getNev(): string
    {
        return $this->nev;
    }

    /**
     * @param string $nev
     */
    public function setNev(string $nev): void
    {
        $this->nev = $nev;
    }

    public function isValid(): bool {
        return $this->getId() == null;
    }

}