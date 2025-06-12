<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "projekt";

//$host = "localhost";
//$user = "s30295";
//$password = "Mak.Choj";
//$dbname = "s30295";

$charset = "utf8mb4";



try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);
} catch (PDOException $e) {
    exit('Błąd podczas łączenia z bazą danych'. $e->getMessage());
}