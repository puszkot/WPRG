<?php
require_once "../db/db.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* @var $pdo */
$stmt = $pdo->query("SELECT d.id, d.nazwa FROM dzialy d");
$dzialy = $stmt->fetchAll();

if(isset($_POST['add'])){

    $nazwa = $_POST['dzial'];
    $stmt = $pdo->prepare("INSERT INTO dzialy (nazwa) VALUES(?)");
    $stmt->execute([$nazwa]);
    header("location: dzialy.php");
    exit();

}
?>

<?php include ("../includes/header.php");?>

    <h1>Działy</h1>
    <ul>
        <?php foreach($dzialy as $d):?>
            <li>
                <a href="dzial_artykuly.php?id=<?=$d['id']?>"><?=htmlspecialchars($d['nazwa']) ?></a>
            </li>
        <?php endforeach;?>
    </ul>
<?php if($_SESSION['rola'] == 'admin'):?>
<h2>Dodaj dział</h2>
<div style="justify-self: left">
    <form method="post" action="">
        <label><input type="text" name="dzial"></label>
        <button type="submit" name="add">Dodaj nowy dział</button>
    </form>
</div>
<?php endif;?>

<?php include ("../includes/footer.php");?>