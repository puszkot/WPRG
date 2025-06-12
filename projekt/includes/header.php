<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['nazwa']) && isset($_COOKIE["zapamietaj_mnie"])) {
    $token = $_COOKIE["zapamietaj_mnie"];

    /* @var $pdo */
    $stmt = $pdo->prepare("SELECT * FROM uzytkownicy WHERE token = ?");
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['nazwa'] = $user['nazwa'];
        $_SESSION['rola'] = $user['rola'];
        $_SESSION['login'] = $user['login'];
        $_SESSION['id'] = $user['id'];
    } else {
        setcookie("zapamietaj_mnie", "", time() - 86400, "/");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../public/style.css">
    <meta charset="UTF-8">
    <title>Portal informacyjny</title>
</head>
<body>
<header>
    <h1>Portal informacyjny</h1>
    <nav>
        <ul class="nav_left">
            <li><a href="../public/index.php">Strona główna</a></li>
            <li><a href="../public/dzialy.php">Działy</a></li>
            <li><a href="../public/autorzy.php">Autorzy</a></li>
            <li><a href="../public/kontakt.php">Kontakt</a></li>
        </ul>

        <ul class="nav_right">
        <?php if(isset($_SESSION['login']) && isset($_SESSION['nazwa']) && isset($_SESSION['rola'])): ?>
            <?php if($_SESSION['rola'] == 'admin'):?>
                <li><a href="../public/wiadomosci.php">Wiadomosci</li>
                <li><a href="../public/panel.php">Panel</a></li>
                <li><a href="../public/dodaj_artykul.php">Dodaj artykul</a></li>
            <?php elseif($_SESSION['rola'] == 'autor'):?>
                <li><a href="../public/wiadomosci.php">Wiadomosci</li>
                <li><a href="../public/dodaj_artykul.php">Dodaj artykul</a></li>
            <?php endif; ?>
                <li class="welcome">Witaj, <?= htmlspecialchars($_SESSION['nazwa'])?></li>
                <li><a href="../public/logout.php">Wyloguj</a> </li>
            <?php else: ?>
                <li><a href="../public/login.php">Logowanie</a></li>
                <li><a  href="../public/register.php">Rejestracja</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <hr>
</header>
<main>