<?php


class Varos
{
    private ?int $id;
    private string $nev;
    private int $iranyitoszam;

    /**
     * Varos constructor.
     * @param int|null $id
     * @param string $nev
     * @param int $iranyitoszam
     */
    public function __construct(?int $id, string $nev, int $iranyitoszam)
    {
        $this->id = $id;
        $this->nev = $nev;
        $this->iranyitoszam = $iranyitoszam;
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

    /**
     * @return int
     */
    public function getIranyitoszam(): int
    {
        return $this->iranyitoszam;
    }

    /**
     * @param int $iranyitoszam
     */
    public function setIranyitoszam(int $iranyitoszam): void
    {
        $this->iranyitoszam = $iranyitoszam;
    }

    public function isValid(): bool {
        return $this->getId() == null;
    }

}