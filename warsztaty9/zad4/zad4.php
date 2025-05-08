<head>
    <meta charset="UTF-8">
    <title>Zadanie 4</title>
    <link rel="stylesheet" href="../warszaty9.css">
</head>
<body>
<form method="POST" action="zad4.php">
    <label for="adres">Podaj adres</label>
    <input name="adres" id="adres" autocomplete="off">
    <label for="opis">Podaj opis</label>
    <input name="opis" id="opis" autocomplete="off">
    <button type="submit">send</button>
</form>
<div class="box">
    <?php echo nl2br(file_get_contents("lista.txt"))?>
</div>
</body>
<?php
if (isset($_POST['adres']) && isset($_POST['opis']) && $_POST['adres'] != "" && $_POST['opis'] != "") {
    $adres = $_POST["adres"];
    $opis = $_POST["opis"];

    file_put_contents("lista.txt", "$adres" . ";" . " $opis\n", FILE_APPEND);

    header("location: zad4.php");
    exit();
}
?>