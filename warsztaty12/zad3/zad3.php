<?php
$servername = "localhost";
$username = "root";
$password = "";
$message = "";

$mysql = new mysqli($servername, $username, $password);
if ($mysql->connect_error) {
    echo "Nie udało sie połączyc: " . $mysql->connect_error;
}

$mysql->query("CREATE DATABASE IF NOT EXISTS WPRG");
$mysql->select_db("WPRG");

$mysql->query("CREATE TABLE IF NOT EXISTS Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL
)");



if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['first_name']) && isset($_POST['last_name'])) {
    $username = trim($_POST["username"]);
    $name = trim($_POST["first_name"]);
    $lastname = trim($_POST["last_name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $checkUser = $mysql->query("SELECT * FROM Users WHERE username = '$username'");
    if ($checkUser->num_rows > 0) {
        $message = "Użytkownik o tej nazwie juz istnieje!";
    } else {
        $stmt = $mysql->prepare("INSERT INTO Users (username, first_name, last_name, email, password) VALUES ('$username', '$name', '$lastname', '$email', '$hash')");
        $stmt->execute();
        $message = "Zajerestrowano pomyślnie";
    }
}
$result = $mysql->query("SELECT COUNT(*) FROM Users;");
$user_count = $result ? $result->fetch_assoc()["COUNT(*)"] : 0;
?>
<head>
    <link rel="stylesheet" href="zad3.css">
    <meta charset="UTF-8">
    <title>Zadanie 3</title>
</head>
<body>
<div class="result">
    <h2>Formularz rejestracyjny</h2>
    <form action="zad3.php" method="post">
        <label>Nazwa użytkownika: <input type="text" name="username" required></label><br><br>
        <label>Imię: <input type="text" name="first_name" required></label><br><br>
        <label>Nazwisko: <input type="text" name="last_name" required></label><br><br>
        <label>Email: <input type="email" name="email" required></label><br><br>
        <label>Hasło: <input type="password" name="password" required></label><br><br>
        <input type="submit" value="Zarejestruj się">
    </form>
    <p><?php echo $message; ?></p>
<p>Liczba zarejestrowanych użytkowników: <?php echo $user_count; ?></p>
</div>
</body>
