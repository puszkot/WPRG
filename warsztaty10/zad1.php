<?php

$visits = 0;

if(isset($_GET['reset'])){
    setcookie('visits', "", time() - 3600);
    header("Location:zad1.php");
    exit();
}

if(isset($_COOKIE["visits"])){
    $visits = (int)$_COOKIE["visits"] + 1;
} else {
    $visits = 1;
}

setcookie('visits',$visits,time()+3600);

if ($visits > 10) {
    $message = "Wyswietlono strone wiecej niz 10 razy";
} else {
    $message = "Wyswietlono strone $visits razy";
}

?>
<head>
    <link href="warszaty10.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Zadanie 1</title>
</head>
<body>
<div class="result">
    <h1>Witaj na stronie!</h1>
    <p><?php echo $message; ?></p>

<form method="get" action="zad1.php">
    <button type="submit" name="reset">Resetuj licznik</button>
</form>
</div>
</body>