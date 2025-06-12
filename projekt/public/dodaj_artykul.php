<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../db/db.php";

if(!isset($_SESSION['rola'])){
    header("Location: ../public/index.php");
    exit();
}

if ($_SESSION['rola'] == 'uzytkownik') {
    header('Location: ../public/index.php');
    exit();
}
/* @var $pdo*/
$stmt = $pdo->query("SELECT id, nazwa FROM dzialy");
$dzialy = $stmt->fetchAll();

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tytul = $_POST['tytul'];
    $tresc = $_POST['tresc'];
    $dzial = $_POST['dzial'];
    $img_url = null;

    if (empty($tytul) || empty($tresc) || empty($dzial)) {
        $message = "Pola nie mogą być puste.";
    } else {
        if(!empty($_FILES['img']['name'])){
            $filename = $_FILES['img']['name'];
            if(move_uploaded_file($_FILES['img']['tmp_name'], "../uploads/".$filename)) {
                $img_url = "uploads/" . $filename;
            } else {
                $message = 'Nie udało się przesłac pliku.';
            }
        }
        $stmt = $pdo->prepare("INSERT INTO artykuly (tytul, tresc, autor_id, dzial_id, img_url) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$tytul, $tresc, $_SESSION['id'], $dzial, $img_url]);
    }
    header('Location: ../public/index.php');
    exit();
}

?>
<?php include ("../includes/header.php"); ?>

<?php if(!empty($message)): ?> {
<?= htmlspecialchars($message) ?>
<?php endif; ?>

<form method="POST" action="dodaj_artykul.php" enctype="multipart/form-data">
    <label>Tytuł:<br><input type="text" name="tytul" required></label><br>
    <label>Treść:<br><textarea name="tresc" rows="40" cols="50"></textarea></label><br>
    <label>
        <select name="dzial" required>
            <option value="">Wybierz dział</option>
            <?php foreach ($dzialy as $d): ?>
                <option value="<?= $d['id'] ?>"><?= htmlspecialchars($d['nazwa']) ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>

    <label><input type="file" name="img" accept="image/*"></label>

    <button type="submit">Dodaj artykuł</button>
</form>

<?php include ("../includes/footer.php"); ?>
