<?php
session_start();

if (isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["email"]) && isset($_POST["password"])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    if (!passwordChecker($_POST["password"])) {
        $_SESSION['message'] = "Hasło musi zawierac 6 znakow, wielka litere, cyfre oraz znak specjalny!";
    } else {
        $_SESSION['message'] = "Zarejestrowano pomyślnie";
        $password = $_POST["password"];
        file_put_contents('registerdata.txt', $firstName . " " . $lastName . "\n" . $email . "\n". $password . "\n", FILE_APPEND | LOCK_EX);
    }

    header("Location: register.php");
    exit;
}
function passwordChecker($password)
{
    if (preg_match("/[0-9]+/", $password) && preg_match("/[A-Z]+/", $password) && preg_match("/[\W\S]+/", $password) && strlen($password) >= 6) {
        return true;
    } else {
        return false;
    }
}

?>

<head>
    <meta charset="UTF-8">
    <title>Zadanie 4</title>
</head>
<body>
<div>
    <p>Witaj! Zarejestruj się</p>
    <form method="POST" action="register.php">
        <label>Imie: <input type="text" name="firstName" required autocomplete="off"></label><br>
        <label>Nazwisko: <input type="text" name="lastName" required autocomplete="off"></label><br>
        <label>Email: <input type="email" name="email" required autocomplete="off"></label><br>
        <label>Hasło: <input type="password" name="password" required autocomplete="off"></label><br>
        <button type="submit">Zarejestruj</button>
    </form>
    <?php
        if (isset($_SESSION['message'])) {
            echo "<p>" . $_SESSION['message'] . "</p>";
        }
    ?>
</div>
</body>