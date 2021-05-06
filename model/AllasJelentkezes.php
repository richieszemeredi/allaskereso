<?php


class AllasJelentkezes
{
    private Allas $allas;
    private Felhasznalo $jelentkezo;

    /**
     * AllasJelentkezes constructor.
     * @param Allas $allas
     * @param Felhasznalo $jelentkezo
     */
    public function __construct(Allas $allas, Felhasznalo $jelentkezo)
    {
        $this->allas = $allas;
        $this->jelentkezo = $jelentkezo;
    }

    /**
     * @return Allas
     */
    public function getAllas(): Allas
    {
        return $this->allas;
    }

    /**
     * @return Felhasznalo
     */
    public function getJelentkezo(): Felhasznalo
    {
        return $this->jelentkezo;
    }




}