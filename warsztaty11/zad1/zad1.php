<?php
require 'NoweAuto.php';
require 'AutoZDodatkami.php';
require 'Ubezpieczenie.php';

$auto1 = new NoweAuto("Model", 1000, 4.1);
echo "Cena nowego auta wynosi: ".$auto1->obliczCene().'<br>';
$auto2 = new AutoZDodatkami("Model", 1000, 4.2, 200,150,300);
echo "Cena auta z dodatkami wynosi: ".$auto2->obliczCene().'<br>';
$auto3 = new Ubezpieczenie("Model", 1000, 4.1, 200, 150,300,10,30);
echo "Cena ubezpieczenia wynosi: ".$auto3->obliczCene();
?>
