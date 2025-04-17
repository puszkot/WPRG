<head>
    <meta charset="UTF-8">
    <title>Zadanie 3</title>
    <link rel="stylesheet" href="warszaty8.css">
</head>
<body>
<form method="POST" action="zad4.php">
    <label for="input"></label>
    <input name="input" id="input" autocomplete="off">
    <button type="submit">send</button>
</form>
<div class="result">
<?php
if (isset($_POST['input'])) {
    $str = $_POST['input'];
    $str = preg_replace('/[^aeiou]/i', '', $str);
    echo strlen($str);
}
?>
</div>
</body>
