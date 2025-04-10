<?php

function printPrimes($start, $stop) {
    echo $start . ", " . $stop . ": ";
    if ($start > $stop) {
        $temp = $stop;
        $stop = $start;
        $start = $temp;
    }

    if (is_numeric($start) && is_numeric($stop)) {
        if ($start > 0 && $stop > 0) {
                $start = ceil($start);
                $stop = floor($stop);
                for ($i = $start; $i <= $stop; $i++) {
                    for ($j = 2; $j < $i; $j++) {
                        if ($i % $j == 0) {
                            break;
                        }
                        else {
                            if ($i-1 == $j) {
                                echo $i . " ";
                            }
                        }

                }
            }
        }
        else {
            echo "Start or stop must be positive number!";
        }
    }
    else {
        echo "Start or stop must be numeric!";
    }
    echo "<br>";
}
printPrimes(5, 10);
printPrimes(10, 5);
printPrimes(5.5, 10);
printPrimes(-5, 10);
printPrimes("prime", 10);
