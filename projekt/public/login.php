<?php
session_start();
require_once "../db/db.php";

$login = $_POST['login'] ?? null;
$haslo = $_POST['haslo'] ?? null;
$message = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (empty($login) || empty($haslo)) {
        $message = "Uzupełnij wszystkie pola!";
    } else {
        /* @var $pdo */
        $stmt = $pdo->prepare("SELECT * FROM uzytkownicy WHERE login = ?");
        $stmt->execute([$login]);
        $user = $stmt->fetch();

        if ($user && password_verify($haslo, $user['haslo'])) {
            $_SESSION['login'] = $login;
            $_SESSION['rola'] = $user['rola'];
            $_SESSION['nazwa'] = $user['nazwa'];
            $_SESSION['id'] = $user['id'];

            $token = bin2hex(random_bytes(16));
            $stmt = $pdo->prepare("UPDATE uzytkownicy SET token = ? WHERE login = ?");
            $stmt->execute([$token, $login]);
            setcookie("zapamietaj_mnie", $token, time() + 86400 * 30, "/");

            header('Location: index.php');
            exit();
        } else {
            $message = "Nieprawidłowy login lub haslo!";
        }
    }
}

?>

<?php include ("../includes/header.php"); ?>

<h1>Logowanie</h1>

<?php if (!empty($message)): ?>
    <p><?=htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="POST" action="login.php">
    <label>Login: <input type="text" name="login"></label><br>
    <label>Haslo: <input type="password" name="haslo"></label><br>
    <button type="submit">Zaloguj się</button>
    <p>Nie masz konta? <a class="no_account" href="register.php" style="color: black">Zarejestruj się</a></p>
</form>



<?php include ("../includes/footer.php"); ?>
