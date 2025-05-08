<head>
    <meta charset="UTF-8">
    <title>Zadanie 3</title>
    <link rel="stylesheet" href="zad3.css">
</head>
<body>
<div>
    <img src="cat.jpg" alt="cat">
    <p>Strona została odwiedzona <?php echo readLicznik("licznik.txt")?> razy!</p>

</div>
</body>

<?php
function readLicznik(string $file): int {
    if (file_exists($file)) {
        return (int)file_get_contents($file);
    } else {
        file_put_contents($file, "1");
        return 1;
    }
}

$plik = "licznik.txt";
$licznik = readLicznik($plik);
$licznik++;

file_put_contents($plik, $licznik);
?>
