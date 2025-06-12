<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../db/db.php";

if(!isset($_SESSION['login'])){
    header("Location: ../public/index.php");
    exit();
}
/* @var $pdo */
$stmt = $pdo->prepare("SELECT u.id, u.nazwa FROM uzytkownicy u WHERE u.rola = 'autor' or u.rola = 'admin'");
$stmt->execute();
$odbiorcy = $stmt->fetchAll();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $tytul = $_POST['tytul'];
    $tresc = $_POST['tresc'];
    $odbiorca = $_POST['odbiorca'];

    if(isset($tytul) && isset($tresc) && isset($odbiorca)){
        $stmt = $pdo->prepare("SELECT nazwa, email FROM uzytkownicy WHERE id=?");
        $stmt->execute([$_SESSION['id']]);
        $user = $stmt->fetch();

        if($user){
            $stmt = $pdo->prepare("INSERT INTO wiadomosci (nazwa, email,tresc,temat,odbiorca_ID) VALUES (?, ?,?,?,?)");
            $stmt->execute([
                    $user['nazwa'],
                    $user['email'],
                    $tresc,
                    $tytul,
                    $odbiorca,
            ]);
            $message = "Wiadomosc zostala wyslana";
        } else {
            $message = "Musisz byc zalogowany";
        }
    } else {
        $message = "Musisz wypełnic wszystkie pola.";
    }
}


?>
<?php include ("../includes/header.php"); ?>

<?php if(!empty($message)): ?>
<?= htmlspecialchars($message) ?>
<?php endif; ?>

<form method="POST" action="kontakt.php">
    <label>Tytuł:<br><input type="text" name="tytul" required></label><br>
    <label>Treść:<br><textarea name="tresc" rows="20" cols="50" required></textarea></label><br>
    <label>Odbiorca:<br>
        <select name="odbiorca" required>
            <option value="">Wybierz odbiorce</option>
            <?php foreach ($odbiorcy as $o): ?>
                <option value="<?= $o['id'] ?>"><?= htmlspecialchars($o['nazwa']) ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>

    <button type="submit">Wyślij wiadomość</button>
</form>

<?php include ("../includes/footer.php"); ?>

