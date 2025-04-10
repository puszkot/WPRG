<?php
function sequences_n($first, $x, $length) {
    if (!is_numeric($first) || !is_numeric($x) || !is_numeric($length)) {
        echo $first . ", " . $x . ", " . $length.": Parameters must be numeric!<br><br>";
        return;
    }

    if ($length < 0) {
        echo $first . ", " . $x . ", " . $length.": N must be positive number!<br><br>";
        return;
    }

    $arithmetic = $first;
    $geometric = $first;

    echo $first . ", " . $x . ", " . $length. ":<br>";

    echo "Arithmetic: ";
    echo $first . ", ";
    for ($i = 1; $i < $length; $i++) {
        $arithmetic += $x;
        echo $arithmetic . ", ";
    }
    echo "<br>";

    echo "Geometric: ";
    echo $first . ", ";
    for ($i = 1; $i < $length; $i++) {
        $geometric *= $x;
        echo $geometric . ", ";
    }
    echo "<br>";

    echo "<br>";
}

sequences_n(5, 2, 10);
sequences_n(5, -2, 10);
sequences_n(-5, 2, 10);
sequences_n(5, 2.5, 5);
sequences_n(5, 2, -10);
sequences_n("start", 2, 10);