<?php
require_once '../db/db.php';

$autor_id = $_GET["id"] ?? null;

/* @var $pdo*/
$stmt = $pdo->prepare("SELECT * FROM uzytkownicy WHERE id = ? AND rola = 'autor' or rola = 'admin'");
$stmt->execute([$autor_id]);
$autor = $stmt->fetch();

if(!$autor) {
    die('Nie ma takiego autora.');
}

$stmt = $pdo->prepare("SELECT a.id, a.tytul, LEFT(a.tresc, 200) as tresc, a.data, u.nazwa
       FROM artykuly a 
       JOIN uzytkownicy u ON a.autor_id  = u.id
       WHERE a.autor_id = ?
       ORDER BY a.data DESC
       ");
$stmt->execute([$autor_id]);
$artykuly = $stmt->fetchAll();

?>
<?php include ("../includes/header.php") ?>

<h1>Artykuły autora <?= htmlspecialchars($autor['nazwa']) ?></h1>
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
    <p>Nie ma jeszcze artykułów od tego autora.</p>
<?php endif; ?>

<?php include ("../includes/footer.php") ?>
