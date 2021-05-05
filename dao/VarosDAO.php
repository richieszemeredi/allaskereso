<?php

require_once "model/Varos.php";

interface VarosDAO
{

    public function getVaros(int|string $iranyitoSzamVagyNev): Varos | bool;
    public function getAllVaros() : array;

}