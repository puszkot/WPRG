<?php
function numbers($number) {

    echo $number . ": ";

    if (!is_numeric($number)) {
        echo "Parameter must be numeric!<br>";
        return;
    }

    if ($number < 0) {
        $number = -$number;
    }

    while((float)$number != (int)$number)
        $number*=10;

    while ($number >= 10) {
        $sum = 0;
        while ($number > 0) {
            $sum += $number % 10;
            $number = (int)($number / 10);
        }
        $number = $sum;
    }

    echo $number . "<br>";
}

numbers(5210);
numbers(-5210);
numbers(5210.5);
numbers("numbers");

