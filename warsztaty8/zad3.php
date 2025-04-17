<head>
    <meta charset="UTF-8">
    <title>Zadanie 3</title>
    <link rel="stylesheet" href="warszaty8.css">
</head>
<body>
<form method="POST" action="zad3.php">
    <label for="input"></label>
    <input name="input" id="input" autocomplete="off">

    <label for="dropdown"></label>
    <select id="dropdown" name="dropdown">
        <option value="1">Odwrocenie ciągu znaków</option>
        <option value="2">Zmaiana liter na wielkie</option>
        <option value="3">Zmiana liter na małe</option>
        <option value="4">Liczenie liczby znaków</option>
        <option value="5">Usuwanie białych znaków</option>
    </select>
    <button type="submit">Wykonaj</button>
</form>
<div class="result">
<?php
$option = 0;

if(isset($_POST['input']) && isset($_POST['dropdown'])){
$string = $_POST['input'];
$option = $_POST['dropdown'];
}

switch ($option){
    case 1:
        echo strrev($string);
        break;
    case 2:
        echo strtoupper($string);
        break;
    case 3:
        echo strtolower($string);
        break;
    case 4:
        echo strlen($string);
        break;
    case 5:
        echo trim($string);
        break;
}
?>
</div>
</body>
