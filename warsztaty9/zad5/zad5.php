<?php
$ip = $_SERVER['REMOTE_ADDR'];

$ipArray = file("zablokuj.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

if(isset($_POST['zablokuj'])) {
    if (!in_array($ip, $ipArray)) {
        file_put_contents('zablokuj.txt', $ip . PHP_EOL, FILE_APPEND);
        $ipArray[] = $ip;
    }
}

if(isset($_POST['odblokuj'])) {
    if (in_array($ip, $ipArray)) {
        $ipArray = array_diff($ipArray, array($ip));

        file_put_contents('zablokuj.txt', implode(PHP_EOL, $ipArray) . PHP_EOL);
    }
}



if (in_array($ip, $ipArray)) {
    include "zad5_strona2.php";
} else {
    include "zad5_strona1.php";
}
?>