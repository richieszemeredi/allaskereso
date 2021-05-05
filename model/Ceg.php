<?php


class Ceg
{
    private ?int $id;
    private ?string $nev;

    /**
     * Ceg constructor.
     * @param int|null $id
     * @param string|null $nev
     */
    public function __construct(?string $nev, ?int $id = null)
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

    public function isValid(): bool {
        return $this->getId() == null;
    }
}