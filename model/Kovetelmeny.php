<?php


class Kovetelmeny
{
    private ?int $kovID;
    private ?string $kovNev;

    /**
     * Kovetelmeny constructor.
     * @param int|null $kovID
     * @param string|null $kovNev
     */
    public function __construct(?int $kovID, ?string $kovNev)
    {
        $this->kovID = $kovID;
        $this->kovNev = $kovNev;
    }

    /**
     * @return int|null
     */
    public function getKovID(): ?int
    {
        return $this->kovID;
    }

    /**
     * @param int|null $kovID
     */
    public function setKovID(?int $kovID): void
    {
        $this->kovID = $kovID;
    }

    /**
     * @return string|null
     */
    public function getKovNev(): ?string
    {
        return $this->kovNev;
    }

    /**
     * @param string|null $kovNev
     */
    public function setKovNev(?string $kovNev): void
    {
        $this->kovNev = $kovNev;
    }
}