<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "../db/db.php";
/* @var $pdo */
$stmt = $pdo->query("SELECT a.id, a.tytul, LEFT(a.tresc, 200) as tresc, a.data, u.nazwa, a.img_url
       FROM artykuly a 
       JOIN uzytkownicy u ON a.autor_id = u.id
       ORDER BY a.data DESC
       LIMIT 30");

$artykuly = $stmt->fetchAll();
?>


<?php include ("../includes/header.php") ?>

<h1>Najnowsze artykuły</h1>
<div class="articles">
    <?php foreach ($artykuly as $a): ?>
        <div class="article">
            <?php if($a['img_url']): ?>
                <img class="img_small" src="../<?= htmlspecialchars($a['img_url'])?>" alt="Obrazek artykułu"/>
            <?php endif; ?>
            <h2><?=htmlspecialchars($a['tytul']) ?></h2>
            <p><?=nl2br(htmlspecialchars($a['tresc']))?>...</p>
            <p>Autor: <?=htmlspecialchars($a['nazwa']) ?></p>
            <a class="read_more" href="artykul.php?id=<?= $a['id'] ?>">Czytaj dalej</a>
        </div>
    <?php endforeach; ?>
</div>

<?php include ("../includes/footer.php") ?>

