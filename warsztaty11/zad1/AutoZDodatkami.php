<?php

class AutoZDodatkami extends NoweAuto {

    public $alarm;
    public $radio;
    public $klimatyzacja;

    public function __construct($modelAuta, $cenaWEuro, $kursEuro,$alarm, $radio, $klimatyzacja) {
        parent::__construct($modelAuta, $cenaWEuro, $kursEuro);
        $this->alarm = $alarm;
        $this->radio = $radio;
        $this->klimatyzacja = $klimatyzacja;
    }

    public function obliczCene() {
        return ($this->cenaWEuro+$this->alarm + $this->radio + $this->klimatyzacja) * $this->kursEuro . " PLN";
    }

}