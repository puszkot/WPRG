<?php
session_start();

$correct_login = "login";
$correct_password = "password";

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: zad3.php");
    exit();
}

if(!isset($_SESSION['loggedin'])) {
    $_SESSION['loggedin'] = false;
}

if (isset($_POST['login']) && isset($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    if ($login == $correct_login && $password == $correct_password) {
        $_SESSION['loggedin'] = true;
    } else {
        echo "Błedny login lub haslo";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <title>Zadanie 3</title>
</head>
<body>
<div class="result">
<?php if (!$_SESSION['loggedin']): ?>
    <p>Zaloguj się</p>
    <form method="post" action="zad3.php">
        <label for="login">Login</label>
        <input id="login" name="login" required autocomplete="off">
        <label for="password">Hasło</label>
        <input id="password" name="password" type="password" required autocomplete="off">
        <button type="submit">Zaloguj</button>
    </form>
    <?php else: ?>
    <p>Zalogowano pomyslnie</p>
    <form method="GET" action="zad3.php">
        <button name="logout" type="submit">Wyloguj</button>
    </form>
    <?php endif; ?>
</div>
</body>