<?php
require_once '../db/db.php';

$dzial_id = $_GET["id"] ?? null;

/* @var $pdo*/
$stmt = $pdo->prepare("SELECT nazwa FROM dzialy WHERE id = ? ");
$stmt->execute([$dzial_id]);
$dzial = $stmt->fetch();

if(!$dzial) {
    die('Nie ma takiego działu.');
}

$stmt = $pdo->prepare("SELECT a.id, tytul, LEFT(a.tresc, 200) AS tresc, a.data, u.nazwa 
       FROM artykuly a 
       JOIN uzytkownicy u ON a.autor_id  = u.id
       WHERE a.dzial_id = ?
       ORDER BY a.data DESC
       ");
$stmt->execute([$dzial_id]);
$artykuly = $stmt->fetchAll();
?>

<?php include ("../includes/header.php") ?>

    <h1>Artykuły w dziale <?= htmlspecialchars($dzial['nazwa']) ?></h1>
<?php if($artykuly): ?>
    <?php foreach ($artykuly as $a): ?>
        <div class="article">
            <h2><?=htmlspecialchars($a['tytul']) ?></h2>
            <p><?=nl2br(htmlspecialchars($a['tresc']))?>...</p>
            <p>Autor: <?=htmlspecialchars($a['nazwa']) ?></p>
            <a href="artykul.php?id=<?= $a['id'] ?>">Czytaj dalej</a>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Nie ma jeszcze artykułów w tym dziale.</p>
<?php endif; ?>

<?php include ("../includes/footer.php") ?>