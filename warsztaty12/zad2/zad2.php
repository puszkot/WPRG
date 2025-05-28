<?php
$servername = "localhost";
$username = "root";
$password = "";
$message = "";
try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $conn->query("CREATE DATABASE IF NOT EXISTS WPRG");
    $conn->query("USE WPRG");

    $conn->query("CREATE TABLE IF NOT EXISTS Person (
        Person_id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
        Person_firstname VARCHAR(255) NOT NULL,
        Person_secondname VARCHAR(255) NOT NULL
        )");

    $conn->query("CREATE TABLE IF NOT EXISTS Cars (
        Car_id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
        Car_model VARCHAR(255) NOT NULL,
        Car_price FLOAT NOT NULL,
        Car_day_of_buy DATETIME NOT NULL,
        Person_id INTEGER NOT NULL,
        FOREIGN KEY (Person_id) REFERENCES Person(Person_id) ON DELETE CASCADE
        )");

    $persons = $conn->query("SELECT * FROM Person")->fetchAll(PDO::FETCH_ASSOC);
    $cars = $conn->query("SELECT * FROM Cars")->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


if (isset($_POST['addperson'])){
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
if (!empty($firstname) && !empty($lastname)){
    $stmt = $conn->prepare("INSERT INTO Person (Person_firstname, Person_secondname) VALUES ('$firstname', '$lastname');");
    $stmt->execute();
    header('Location: zad2.php');
    exit();
} else {
    echo "Couldn't add person.";
}
}
if (isset($_POST['addcar'])){
    $model = $_POST['model'];
    $price = $_POST['price'];
    $dayofbuy = $_POST['dayofbuy'];
    $person_id = $_POST['person_id'];
    if (!empty($model) && !empty($price) && !empty($dayofbuy) && !empty($person_id)){
        $stmt = $conn->prepare("INSERT INTO Cars (Car_model, Car_price, Car_day_of_buy, Person_id) VALUES ('$model', '$price', '$dayofbuy', '$person_id');");
        $stmt->execute();
        header('Location: zad2.php');
        exit();
    } else {
        echo "Couldn't add Car.";
    }
}
if (isset($_POST['deleteperson'])){
    $person_id = $_POST['person_id'];
    $stmt = $conn->prepare("DELETE FROM Person WHERE Person_id='$person_id'");
    $stmt->execute();
    header('Location: zad2.php');
    exit();
}

if (isset($_POST['deletecar'])){
    $car_id = $_POST['car_id'];
    $stmt = $conn->prepare("DELETE FROM Cars WHERE Car_id='$car_id'");
    $stmt->execute();
    header('Location: zad2.php');
    exit();
}

if (isset($_POST['editperson'])){
    $person_id = $_POST['person_id'];
    $stmt = $conn->prepare("SELECT * FROM Person WHERE Person_id='$person_id'");
    $stmt->execute();
    $editPerson = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['saveperson'])){
    $person_id = $_POST['person_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $stmt = $conn->prepare("UPDATE Person SET Person_firstname = '$firstname', Person_secondname ='$lastname' WHERE Person_id ='$person_id'");
    $stmt->execute();
    header('Location: zad2.php');
    exit();
}

if (isset($_POST['editcar'])){
    $car_id = $_POST['car_id'];
    $stmt = $conn->prepare("SELECT * FROM Cars WHERE Car_id='$car_id'");
    $stmt->execute();
    $editCar = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['savecar'])) {
    $car_id = $_POST['car_id'];
    $model = $_POST['model'];
    $price = $_POST['price'];
    $dayofbuy = $_POST['dayofbuy'];
    $person_id = $_POST['person_id'];
    $stmt = $conn->prepare("UPDATE Cars SET Car_model = '$model', Car_price = '$price', Car_day_of_buy = '$dayofbuy', Person_id = '$person_id' WHERE Car_id = '$car_id'");
    $stmt->execute();
    header("Location: zad2.php");
    exit();
}


?>
<head>
    <link rel="stylesheet" href="zad2.css">
    <meta charset="UTF-8">
    <title>Zadanie 2</title>
</head>
<body>
<div class="result">
    <h1>Manage MySQL Database</h1>
    <form action="zad2.php" method="POST">
        <h2>Add Person</h2>
        <label><input type="text" name="firstname" placeholder="First name" autocomplete="off"></label>
        <label><input type="text" name="lastname" placeholder="Last name" autocomplete="off"></label>
        <button type="submit" name="addperson">Add person</button>
    </form>
    <form action="zad2.php" method="POST">
        <h2>Add Car</h2>
        <label><input type="text" name="model" placeholder="Model" autocomplete="off"></label>
        <label><input type="number" name="price" placeholder="Price" autocomplete="off"></label>
        <label><input type="date" name="dayofbuy" placeholder="Day of buy" autocomplete="off"></label>
        <label>
            <select name="person_id">
                <?php foreach ($persons as $person): ?>
                    <option value="<?= $person['Person_id'] ?>">
                        <?= htmlspecialchars($person['Person_firstname'] . ' ' . $person['Person_secondname']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>
        <button type="submit" name="addcar">Add Car</button>
    </form>
    <?php if (!empty($editPerson)): ?>
        <h2>Edit Person</h2>
        <form method="POST" action="zad2.php">
            <input type="hidden" name="person_id" value="<?= $editPerson['Person_id'] ?>">
            <label><input type="text" name="firstname" value="<?= htmlspecialchars($editPerson['Person_firstname']) ?>"></label>
            <label><input type="text" name="lastname" value="<?= htmlspecialchars($editPerson['Person_secondname']) ?>"></label>
            <button type="submit" name="saveperson">Save</button>
        </form>
    <?php endif; ?>

    <?php if (!empty($editCar)): ?>
        <h2>Edit Car</h2>
        <form method="POST" action="zad2.php">
            <input type="hidden" name="car_id" value="<?= $editCar['Car_id'] ?>">
            <label><input type="text" name="model" value="<?= htmlspecialchars($editCar['Car_model']) ?>"></label>
            <label><input type="number" name="price" value="<?= $editCar['Car_price'] ?>"></label>
            <label><input type="date" name="dayofbuy" value="<?= date('Y-m-d', strtotime($editCar['Car_day_of_buy'])) ?>"></label>
            <label>
                <select name="person_id">
                    <?php foreach ($persons as $person): ?>
                        <option value="<?= $person['Person_id'] ?>" <?= $editCar['Person_id'] == $person['Person_id']?>>
                            <?= htmlspecialchars($person['Person_firstname'] . ' ' . $person['Person_secondname']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>
            <button type="submit" name="savecar">Save</button>
        </form>
    <?php endif; ?>
    <h2>Persons</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Action</th>
        </tr>
        <?php foreach ($persons as $person): ?>
        <tr>
            <td><?php echo $person['Person_id']?></td>
            <td><?php echo $person['Person_firstname']?></td>
            <td><?php echo $person['Person_secondname']?></td>
            <td><form method="POST" action="zad2.php">
                    <input type = hidden value="<?= $person['Person_id']?>" name="person_id">
                    <button name="editperson" type="submit">Edit</button>
                    <button name="deleteperson" type="submit" onclick="return confirm('Confirm')">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <h2>Cars</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Model</th>
            <th>Price</th>
            <th>Day of buy</th>
            <th>Action</th>
        </tr>
        <?php foreach ($cars as $car): ?>
            <tr>
                <td><?php echo $car['Car_id']?></td>
                <td><?php echo $car['Car_model']?></td>
                <td><?php echo $car['Car_price']?></td>
                <td><?php echo date('d/m/y', strtotime($car['Car_day_of_buy']))?></td>
                <td><form method="POST" action="zad2.php">
                        <input type="hidden" value="<?= $car['Car_id']?>" name="car_id">
                        <button name="editcar" type="submit">Edit</button>
                        <button name="deletecar" type="submit" onclick="return confirm('Confirm')">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
