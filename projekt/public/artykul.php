<?php
require_once "../db/db.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Błędne ID.");
}

$artykul_id = $_GET["id"] ?? null;
$message = "";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_SESSION['nazwa'])){
        $nazwa = $_SESSION["nazwa"];
    } else {
        $nazwa= $_POST["nazwa"];
    }
    $tresc = $_POST['tresc'] ?? null;

    if(isset($nazwa) && isset($tresc)) {
        /* @var $pdo */
        $stmt = $pdo->prepare("INSERT INTO komentarze (artykul_id, nazwa, tresc) VALUES (?, ?, ?)");
        $stmt->execute([$artykul_id, $nazwa, $tresc]);
        header("Location: artykul.php?id=" . $artykul_id);
        exit();
    } else {
        $message = "Musisz wypełnic wszystkie pola.";
    }

    if (isset($_POST['delete_comment'])) {
        /* @var $pdo*/
        $stmt = $pdo->prepare("DELETE FROM komentarze WHERE artykul_id = ? AND id = ?");
        $stmt->execute([$artykul_id, $_POST['id']]);
        header("Location: artykul.php?id=" . $artykul_id);
        exit();
    }

    if (isset($_POST['delete_article'])) {
        /* @var  $pdo */
        $stmt = $pdo->prepare("DELETE FROM artykuly WHERE id = ?");
        $stmt->execute([$artykul_id]);
        header("Location: index.php");
        exit();
    }
}

/* @var $pdo */
$stmt = $pdo->prepare("SELECT a.*, u.nazwa 
           FROM artykuly a
           JOIN uzytkownicy u ON a.autor_id = u.id
           WHERE a.id = ?");
$stmt->execute([$_GET["id"]]);
$artykul = $stmt->fetch();

if (!$artykul) {
    $message = "Nie znaleziono artykulu.";
}

$stmt = $pdo->prepare("SELECT * FROM komentarze WHERE artykul_id = ? ORDER BY data DESC");
$stmt->execute([$artykul_id]);
$komentarze = $stmt->fetchAll();


?>


<?php include ("../includes/header.php");?>

<article>
    <?php if($_SESSION['rola'] != 'uzytkownik'): ?>
    <form action="" method="post">
        <button class="delete" type="submit" name="delete_article">Usun artykul</button>
    </form>

    <?php endif;?>
    <h2><?= htmlspecialchars($artykul['tytul']) ?></h2>
    <p><?= htmlspecialchars($artykul['nazwa'])?>, <?= $artykul['data']?></p>
    <?php if($artykul['img_url']): ?>
    <img src="../<?= htmlspecialchars($artykul['img_url'])?>" alt="Obrazek artykułu"/>
    <?php endif; ?>
    <p><?= nl2br(htmlspecialchars($artykul['tresc']))?></p>
</article>

    <hr>

<div class="comments">
    <h2>Komentarze</h2>
    <?php if($message): ?>
        <p><?=htmlspecialchars($message)?></p>
    <?php endif; ?>

    <?php if(count($komentarze) == 0): ?>
        <p>Brak komentarzy.</p>
    <?php else: ?>
        <?php foreach($komentarze as $komentarz): ?>
        <div class="comment">
            <h4><?=htmlspecialchars($komentarz['nazwa']) ?></h4>
            <p><?=$komentarz['data'] ?></p>
            <p><?=nl2br(htmlspecialchars($komentarz['tresc'])) ?></p>
            <?php if($_SESSION['rola'] == 'admin'): ?>
            <form action="" method="post">
               <input type="hidden" value="<?=$komentarz['id']?>" name="id">
                <button class="delete" name="delete_comment" type="submit">Usuń komentarz</button>
            </form>
            <?php endif;?>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<hr>

<div class="add_comment">
    <h2>Dodaj komentarz</h2>
    <form method="post" action="">
        <?php if(!isset($_SESSION['login'])):?>
        <label>Nazwa:<br>
            <input type="text" name="nazwa" required>
        </label><br>
        <?php else: ?>
            <?=$_SESSION['login']?><br>
        <?php endif; ?>
        <label>Komentarz:<br>
            <textarea name="tresc" rows="5" cols="50" required></textarea>
        </label><br>
        <button type="submit">Dodaj komentarz</button>
    </form>
</div>




<?php include ("../includes/footer.php");?>