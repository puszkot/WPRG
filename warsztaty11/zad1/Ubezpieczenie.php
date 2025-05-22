<?php
class Ubezpieczenie extends AutoZDodatkami {
    public $wartoscUbezpieczenia;
    public $liczbaLatPosiadaniaSamochodu;

    public function __construct($modelAuta, $cenaWEuro, $kursEuro,$alarm, $radio, $klimatyzacja, $liczbaLatPosiadaniaSamochodu, $wartoscUbezpieczenia)
    {
        parent::__construct($modelAuta, $cenaWEuro, $kursEuro, $alarm, $radio, $klimatyzacja);
        $this->liczbaLatPosiadaniaSamochodu = $liczbaLatPosiadaniaSamochodu;
        $this->wartoscUbezpieczenia = $wartoscUbezpieczenia;
    }

    public function obliczCene() {
        return (($this->cenaWEuro+$this->alarm + $this->radio + $this->klimatyzacja) * $this->kursEuro) * ((100-$this->liczbaLatPosiadaniaSamochodu)/100) * ($this->wartoscUbezpieczenia/100) . " PLN";
    }
}