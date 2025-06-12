<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../db/db.php";

if (!isset($_SESSION['login']) || $_SESSION['rola'] != 'admin') {
header("Location: ../public/index.php");
exit();
}
/* @var $pdo*/
$stmt = $pdo->query("SELECT id, nazwa, email, rola FROM uzytkownicy");
$uzytkownicy = $stmt->fetchAll();

$stmt = $pdo->query("SELECT a.id, a.tytul, a.data, u.nazwa AS autor FROM artykuly a JOIN uzytkownicy u ON a.autor_id = u.id ORDER BY a.data DESC");
$artykuly = $stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_user'])) {
        $stmt = $pdo->prepare("DELETE FROM uzytkownicy WHERE id = ?");
        $stmt->execute([$_POST['delete_user']]);
    }

    if (isset($_POST['delete_article'])) {
        $stmt = $pdo->prepare("DELETE FROM artykuly WHERE id = ?");
        $stmt->execute([$_POST['delete_article']]);
    }

    if(isset($_POST['edit_role_id'])) {
        $stmt = $pdo->prepare("UPDATE uzytkownicy SET rola = ? WHERE id = ?");
        $stmt->execute([$_POST['role'], $_POST['edit_role_id']]);
    }

    header("Location: panel.php");
    exit();
}

?>

<?php include("../includes/header.php"); ?>
<div>
    <h1>Panel administratora</h1>
    <div>
        <h2>Użytkownicy</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nazwa</th>
                <th>Email</th>
                <th>Rola</th>
                <th>Akcja</th>
            </tr>
            <?php foreach($uzytkownicy as $uzytkownik): ?>
                <tr>
                    <td><?= $uzytkownik['id'] ?></td>
                    <td><?= htmlspecialchars($uzytkownik['nazwa']) ?></td>
                    <td><?= htmlspecialchars($uzytkownik['email']) ?></td>
                    <td><?= htmlspecialchars($uzytkownik['rola']) ?></td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="delete_user" value="<?= $uzytkownik['id'] ?>">
                            <button class="delete" type="submit">Usuń</button>
                        </form>
                        <form method="post" action="">
                            <input type="hidden" name="edit_role_id" value="<?= $uzytkownik['id'] ?>">
                            <select name="role">
                                <option value="admin" <?= $uzytkownik['rola'] === 'admin'?>>admin</option>
                                <option value="autor" <?= $uzytkownik['rola'] === 'autor'?>>autor</option>
                                <option value="uzytkownik" <?= $uzytkownik['rola'] === 'uzytkownik'?>>uzytkownik</option>
                            </select>
                            <button type="submit">Edytuj</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div>
        <h2>Artykuły</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Tytuł</th>
                <th>Data</th>
                <th>Autor</th>
                <th>Akcja</th>
            </tr>
            <?php foreach($artykuly as $artykul): ?>
                <tr>
                    <td><?= $artykul['id'] ?></td>
                    <td><?= htmlspecialchars($artykul['tytul']) ?></td>
                    <td><?= $artykul['data'] ?></td>
                    <td><?= htmlspecialchars($artykul['autor']) ?></td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="delete_article" value="<?= $artykul['id'] ?>">
                            <button class="delete" type="submit">Usuń</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<?php include("../includes/footer.php"); ?>
