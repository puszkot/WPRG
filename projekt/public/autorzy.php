<?php
require_once "../db/db.php";

/* @var $pdo */
$stmt = $pdo->query("SELECT u.nazwa, u.id FROM uzytkownicy u WHERE u.rola = 'autor' or u.rola = 'admin'");
$autorzy = $stmt->fetchAll();
?>

<?php include ("../includes/header.php");?>

<h1>Autorzy</h1>
<ul>
    <?php foreach($autorzy as $a):?>
        <li>
            <a href="autor_artykuly.php?id=<?= $a['id']?>"><?=htmlspecialchars($a['nazwa']) ?></a>
        </li>
    <?php endforeach;?>
</ul>

<?php include ("../includes/footer.php");?>