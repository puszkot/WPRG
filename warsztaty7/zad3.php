<?php
function tablica($a, $b, $c, $d)
{

    if ($c>$d) {
        $temp=$c;
        $c=$d;
        $d=$temp;
    }

    $temp=$c;
    for ($i = $a; $i <= $b; $i++) {
        $A[$i] = $c;
        if($c < $d){
            $c++;
        }
        else
            $c=$temp;
    }
    print_r($A);
}

tablica(1,10,3,1);