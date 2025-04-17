<?php
function prosty($a, $b, $operator){
    if ($operator == "dodawanie"){
        return $a+$b;
    }
    if ($operator == "odejmowanie"){
        return $a - $b;
    }
    if ($operator == "mnozenie"){
        return $a * $b;
    }
    if ($operator == "dzielenie"){
        if ($b == 0){
            return "nie dziel przez zero";
        }
        else {
            return $a / $b;
        }
    }
}

function zaawansowany($a, $operator){

    if (in_array($operator, ["cos", "sin", "tg", "bintodec", "dectobin", "dectohex"])) {
        if (!is_numeric($a)) {
            return "podaj poprawną liczbę!";
        }
    }
    if ($operator == "cos"){
        return cos($a);
    }
    if ($operator == "sin"){
        return sin($a);
    }
    if ($operator == "tg"){
        return tan($a);
    }
    if ($operator == "bintodec"){
        if (!preg_match('/^[0-1]+$/', $a)) {
            return "podaj poprawną liczbę binarną (0-1)";
        }
        else
        return base_convert($a, 2, 10);
    }
    if ($operator == "dectobin"){
        return base_convert($a, 10, 2);
    }
    if ($operator == "dectohex"){
        return base_convert($a, 10, 16);
    }
    if ($operator == "hextodec"){
        if (!preg_match('/^[0-9a-fA-F]+$/', $a)) {
            return "podaj poprawną liczbę szesnastkową (0-9, a-f)";
        }
        else
        return base_convert($a, 16, 10);
    }
}

$wynik = "";

if (isset($_POST['prosty'])) {
    $a = $_POST["liczba1"];
    $b = $_POST["liczba2"];
    if ($a == ''){
        $a = 0;
    }
    if ($b == ''){
        $b = 0;
    }
    $operator = $_POST["operator1"];
    $wynik = "Wynik kalkulatora prostego to: " . prosty($a, $b, $operator);
}

if (isset($_POST['zaawansowany'])) {
    $a = $_POST["liczba3"];
    if ($a == ''){
        $a = 0;
    }
    $operator = $_POST["operator2"];
    $wynik = "Wynik kalkulatora zaawansowanego to: " . zaawansowany($a, $operator);
}
?>

<head>
    <style>
        body {
            font-family: sans-serif;
            background-color: #eee;
            padding: 50px;
            text-align: center;
            color: #333;
        }

        p {
            width: fit-content;
            font-size: 18px;
            margin: 10px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
        }

        a {
            text-decoration: none;
            background-color: #333;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
        }

        a:hover {
            background-color: #777;
            transition: 0.3s;
        }
    </style>

</head>
<body>
<p><?php echo $wynik?></p>
<a href="zad5.html">Wroc na strone</a>
</body>



