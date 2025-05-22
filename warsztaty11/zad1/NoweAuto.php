<?php

class NoweAuto
{
    public $modelAuta;
    public $cenaWEuro;
    public $kursEuro;

    function __construct($modelAuta, $cenaWEuro, $kursEuro)
    {
        $this->modelAuta = $modelAuta;
        $this->cenaWEuro = $cenaWEuro;
        $this->kursEuro = $kursEuro;
    }

    function obliczCene()
    {
        return $this->cenaWEuro * $this->kursEuro . " PLN";
    }
}