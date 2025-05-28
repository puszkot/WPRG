<?php
$tableCreated = false;
$servername = "localhost";
$username = "root";
$password = "";
$message = "";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$conn->query("CREATE DATABASE IF NOT EXISTS WPRG");

$conn->select_db("WPRG");
if (isset($_POST['create'])) {
    if ($conn->query("CREATE TABLE IF NOT EXISTS Student(
    StudentID INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    FirstName VARCHAR(255) NOT NULL,
    SecondName VARCHAR(255) NOT NULL,
    Salary INT NOT NULL,
    DateOfBirth DATE NOT NULL       
) ")){
        $message = "Table Student created successfully";
    }
} else if (isset($_POST['delete'])) {
    if($conn->query("DROP TABLE IF EXISTS Student")) {
        $message = "Table Student deleted successfully";
    };
}

$tableCheck = $conn->query("SHOW TABLES LIKE 'Student'");
$tableCreated = $tableCheck->num_rows > 0;
?>
<head>
    <link rel="stylesheet" href="zad1.css">
    <meta charset="UTF-8">
    <title>Zadanie 1</title>
</head>
<body>
<div class="result">
    <h1>Manage MySQL Table</h1>
    <form action="zad1.php" method="POST">
    <?php
    if(!$tableCreated):?>
        <button type="submit" name="create">Create Table</button>
    <?php else:?>
        <button type="submit" name="delete">Delete Table</button>
    <?php endif; ?>
    </form>
    <?php echo $message; ?>
</div>
</body>

