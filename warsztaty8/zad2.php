<head>
    <meta charset="UTF-8">
    <title>Zadanie 2</title>
    <link rel="stylesheet" href="warszaty8.css">
</head>
<body>
<form method="POST" action="zad2.php">
    <label for="input"></label>
    <input name="input" id="input" autocomplete="off">
    <button type="submit">send</button>
</form>
<div class="result">
<?php

if(isset($_POST["input"])){
    $string = $_POST["input"];
    $string = preg_replace('/[\\\\\/:*?"<>|+\-]/', '', $string);
    echo $string;
}
?>
</div>
</body>