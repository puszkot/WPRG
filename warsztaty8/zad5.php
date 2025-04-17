<head>
    <meta charset="UTF-8">
    <title>Zadanie 3</title>
    <link rel="stylesheet" href="warszaty8.css">
</head>
<body>
<form method="POST" action="zad5.php">
    <label for="input"></label>
    <input name="input" id="input" autocomplete="off">
    <button type="submit">send</button>
</form>
<div class="result">
<?php
if (isset($_POST['input'])) {
    if (is_numeric($_POST['input'])) {
        $string = $_POST['input'];
        $string = preg_replace('/^[^.]*\./', '', $string);
        echo strlen($string);
    } else
        echo "Podaj liczbe zmiennoprzecinkową";
}
?>
</div>
</body>

