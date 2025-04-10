<?php
function mnozenieMacierzy($A,$B) {
    $rows1 = count($A);
    $cols1 = count($A[0]);
    $rows2 = count($B);
    $cols2 = count($B[0]);

    if ($cols1 != $rows2)
    {
        echo "Zły rozmiar macierzy!";
        return;
    }

    $C = [];
    for ($i = 0; $i < $rows1; $i++)
    {
        $C[$i] = [];
        for ($j = 0; $j < $cols2; $j++)
        {
            $C[$i][$j] = 0;
            for ($k = 0; $k < $cols1; $k++){
                $C[$i][$j] += $A[$i][$k] * $B[$k][$j];
            }
        }
    }
    for ($i = 0; $i < $rows1; $i++) {
        for ($j = 0; $j < $cols2; $j++)
            echo $C[$i][$j] . " ";
        echo "<br>";
    }
}


$A = [
    [1, 2],
    [3, 4],
];

$B = [
    [4, 3],
    [2, 1]
];

$C = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
];

$D = [
    [21, 3],
    [6, 4],
    [5, 1]
];

$E = [
    [1]
];

$F = [
    [1, 5],
    [2, 6]
];

mnozenieMacierzy($A, $B);
echo "<br>";
mnozenieMacierzy($C, $D);
echo "<br>";
mnozenieMacierzy($E, $F);
