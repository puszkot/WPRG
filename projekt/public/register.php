<?php
session_start();
require_once "../db/db.php";

$login = $_POST['login'] ?? null;
$haslo = $_POST['haslo'] ?? null;
$haslo2 = $_POST['haslo2'] ?? null;
$email = $_POST['email'] ?? null;
$nazwa = $_POST['nazwa'] ?? null;
$message = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (!empty($login) && !empty($haslo) && !empty($haslo2) && !empty($email) && !empty($nazwa)) {
        if($haslo === $haslo2){
            /* @var $pdo */
            $stmt = $pdo->prepare("SELECT * FROM uzytkownicy WHERE login = ? OR email = ?");
            $stmt->execute([$login, $email]);
            if (!$stmt->fetch()) {
                $hash = password_hash($haslo, PASSWORD_DEFAULT);
                $stmt = $pdo -> prepare("INSERT INTO uzytkownicy (login, haslo, email, nazwa, rola) VALUES (?, ?, ?, ?, 'uzytkownik')");
                $stmt->execute([$login, $hash, $email, $nazwa]);
                $_SESSION['login'] = $login;
                $_SESSION['nazwa'] = $nazwa;
                $_SESSION['rola'] = 'uzytkownik';
                $_SESSION['id'] = $pdo->lastInsertId();

                $token = bin2hex(random_bytes(16));
                $stmt = $pdo->prepare("UPDATE uzytkownicy SET token = ? WHERE login = ?");
                $stmt->execute([$token, $login]);
                setcookie("zapamietaj_mnie", $token, time() + 86400 * 30, "/");

                header("Location: index.php");
                exit;
            } else {
                $message = "Ten email lub login już istnieje!";
            }
        }
    } else {
        $message = "Uzupełnij wszystkie pola!";
    }
}

?>

<?php include ("../includes/header.php"); ?>

<?php if (!empty($message)): ?>
    <p><?=htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="POST" action="register.php">
    <label>Login: <input type="text" name="login" required></label><br>
    <label>Hasło: <input type="password" name="haslo" required></label><br>
    <label>Potwierdź hasło: <input type="password" name="haslo2" required></label><br>
    <label>Email: <input type="email" name="email" required></label><br>
    <label>Nazwa użytkownika: <input type="text" name="nazwa" required></label><br>
    <button type="submit">Zarejestruj się</button>
    <p>Masz już konto? <a href="login.php" style="color: black">Zaloguj się</a></p>
</form>



<?php include ("../includes/footer.php"); ?>

