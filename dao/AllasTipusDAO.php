<?php


interface AllasTipusDAO
{

    public function getAllasTipus($idVagyNev): AllasTipus | bool;
    public function getAllAllasTipus(): array;

}