<?php
function znak($A, $n) {
    if ($n > count($A)) {
        echo "Błąd<br>";
        return;
    }
    array_splice($A, $n, 0, "$");
    for ($i = 0; $i < count($A); $i++) {
        echo $A[$i] . ", ";
    }
    echo "<br>";
}

$A = [1,2,3,4,5,6,7,8,9];
znak($A, 6);
znak($A, 100);