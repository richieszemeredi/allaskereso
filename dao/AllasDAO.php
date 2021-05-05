<?php

interface AllasDAO
{
    public function createAllas(Allas $allas): Allas | bool;
    public function getAllas(int $id): Allas | bool;
    public function getAllAllas(): array;
    public function updateAllas(int $id, Allas $allas): bool;
    public function removeAllas(int $id): bool;
    public function allasExists(int $id): bool;
}