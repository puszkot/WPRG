<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php
try {
    $pdo = new PDO('mysql:host=localhost', 's30295', 'Mak.Choj', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    $sql = file_get_contents('init.sql');
    $statements = array_filter(array_map('trim', explode(';', $sql)));

    foreach ($statements as $stmt) {
        if (!empty($stmt)) {
            try {
                $pdo->exec($stmt);
		
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
	$autorHaslo = password_hash('autor', PASSWORD_DEFAULT);
	$adminHaslo = password_hash('admin', PASSWORD_DEFAULT);

	$stmt = $pdo->prepare("INSERT IGNORE INTO uzytkownicy (login, haslo, email, nazwa, rola) VALUES (?, ?, ?, ?, ?)");

	$stmt->execute(['autor', $autorHaslo, 'autor@autor.com', 'Autor', 'autor']);
	$stmt->execute(['admin', $adminHaslo, 'admin@admin.com', 'Admin', 'admin']);
	
	$stmt = $pdo->query("INSERT INTO artykuly (tytul, tresc, autor_id, dzial_id, img_url) VALUES ('tytul', 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.',1, 3,'')");


} catch (Exception $e) {
   echo $e->getMessage();
}
?>
