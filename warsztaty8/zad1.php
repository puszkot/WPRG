<head>
    <meta charset="UTF-8">
    <title>Zadanie 1</title>
    <link rel="stylesheet" href="warszaty8.css">
</head>
<body>
<form method="POST" action="zad1.php">
    <label for="input"></label>
    <input name="input" id="input" autocomplete="off">
    <button type="submit">send</button>
</form>
<div class="result">
<?php
if((isset($_POST["input"]))){
    $string = $_POST['input'];
    echo strtoupper($string)."<br>";
    echo strtolower($string)."<br>";
    echo ucfirst(strtolower($string))."<br>";
    echo ucwords(strtolower($string));
}
?>
</div>
</body>

