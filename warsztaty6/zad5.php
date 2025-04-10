<?php
function isPangram($string) {
    if (!is_string($string)) {
        echo "Parameter must be string!<br>";
        return;
    }

    echo $string . " : ";
    $string = trim($string);
    $string = strtolower($string);
    $string = preg_replace("/[^a-z]/", "", $string);
    $string = array_unique(str_split($string));
//    sort($string);
//    echo implode("", $string) . "<br>";
    if (count($string) == 26)
        echo "Pangram!<br>";
    else
        echo "Not pangram!<br>";
}

isPangram("The quick brown fox jumps over the lazy dog");
isPangram("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.");