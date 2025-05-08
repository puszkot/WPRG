<head>
    <meta charset="UTF-8">
    <title>Zadanie 1</title>
    <link rel="stylesheet" href="../warszaty9.css">
</head>
<body>
<form method="GET" action="zad1.php">
    <label for="input">Podaj date urodzenia:</label>
    <input name="input" id="input" autocomplete="off" type="date">
    <button type="submit">send</button>
</form>
<div class="result">
    <?php
    if (isset($_GET['input']) && $_GET['input'] != '') {

        $birthday = $_GET['input'];
        $dayOfWeek = date('w', strtotime($birthday));
        $todayDate = date("Y-m-d");

        if (strtotime($birthday) > strtotime($todayDate)) {
            echo "Nieprawidłowa data urodzenia";
            return;
        }
        switch ($dayOfWeek) {
            case 0:
                echo "Niedziela";
                break;
            case 1:
                echo "Poniedzialek";
                break;
            case 2:
                echo "Wtorek";
                break;
            case 3:
                echo "Środa";
                break;
            case 4:
                echo "Czwartek";
                break;
            case 5:
                echo "Piątek";
                break;
            case 6:
                echo "Sobota";
                break;
            default:
                break;
        }

        echo "<br>".date_diff(date_create($birthday), date_create($todayDate))->format('%y');

        list($year, $month, $day) = explode('-', $birthday);
        $currentYear = date("Y");
        $nextBirthday = mktime(0, 0, 0, $month, $day, $currentYear);
        $today = time();

        if ($nextBirthday < $today) {
            $currentYear += 1;
            $nextBirthday = mktime(0, 0, 0, $month, $day, $currentYear);
        }
        $daysUntilBirthday = ceil(($nextBirthday - $today) / (60 * 60 * 24));

        echo "<br>".($daysUntilBirthday);
    }


    ?>
</div>
</body>


