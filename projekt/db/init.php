<?php
try {
    $pdo = new PDO('mysql:host=localhost', 'root', '');


    $sql = file_get_contents('init.sql');

    $pdo->exec($sql);
    echo "Baza danych została utworzona!";
} catch (PDOException $e) {
    echo $e->getMessage();
}
