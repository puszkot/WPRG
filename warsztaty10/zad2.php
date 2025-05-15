<?php

$message = "";
$voted = false;

if (isset($_POST['vote']) && isset($_POST['odp'])) {
    setcookie('vote', true, time() + (86400 * 30), "/");
    header('Location: zad2.php');
    exit();
}

if (isset($_COOKIE['vote'])) {
    $voted = true;
    $message = "Juz oddales glos";
}

if (isset($_POST['reset'])) {
    setcookie('vote', '', time() - 3600, "/");
    header('Location: zad2.php');
    exit();
}
?>

<head>
    <meta charset="UTF-8">
    <title>Zadanie 2</title>
</head>
<body>
<div class="result">

    <p>Wybierz kolor:</p>
<?php if (!$voted): ?>
    <form method="POST" action="zad2.php">
        <input type="radio" name="odp" id="1" required>
        <label for="1">Czerwony</label><br>
        <input type="radio" name="odp" id="2">
        <label for="2">Niebieski</label><br>
        <input type="radio" name="odp" id="3">
        <label for="3">Żółty</label><br>
        <button type="submit" name="vote">Wyslij odpowiedz</button>
    </form>
    <?php else: echo $message;?>
    <form method="post" action="zad2.php">
        <button type="submit" name="reset">Zaglosuj jeszcze raz</button>
    </form>
    <?php endif; ?>
</div>
</body>