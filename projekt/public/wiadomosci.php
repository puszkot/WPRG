<?php
session_start();
require_once "../db/db.php";

if (!isset($_SESSION['login']) && $_SESSION['rola'] == 'uzytkownik') {
header("Location: ../public/index.php");
exit();
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    /* @var $pdo */
$stmt = $pdo->prepare("UPDATE wiadomosci SET przeczytana = 1 WHERE id=? AND odbiorca_ID = ?");
$stmt->execute([$_POST['przeczytane'],$_SESSION['id']]);
header("Location: wiadomosci.php");
exit();
}
/* @var $pdo */
$stmt = $pdo->prepare("SELECT * FROM wiadomosci WHERE odbiorca_ID = ? ORDER BY data DESC");
$stmt->execute([$_SESSION['id']]);
$wiadomosci = $stmt->fetchAll();

?>

<?php include("../includes/header.php"); ?>

<h1>Wiadomości</h1>

<?php if(count($wiadomosci) == 0): ?>
    <p>Nie masz zadnych wiadomosci</p>
<?php else : ?>
    <div class="messages">
        <?php foreach ($wiadomosci as $w): ?>
            <div class="article">
                <h2><?=htmlspecialchars($w['temat']) ?></h2>
                <h3><?=htmlspecialchars($w['nazwa'].", ".$w['email'])?></h3>
                <p><?=nl2br(htmlspecialchars($w['tresc']))?></p>
                <p>Autor: <?=htmlspecialchars($w['nazwa']) ?></p>
                <?php if($w['przeczytana'] == 0): ?>
                    <form method="post" action="">
                        <input type="hidden" name="przeczytane" value="<?= $w['id'] ?>">
                        <button class="read" type="submit">Oznacz jako przeczytane</button>
                    </form>
                <?php else: ?>
                    <button type="button">Przeczytane</button>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php include("../includes/footer.php"); ?>

