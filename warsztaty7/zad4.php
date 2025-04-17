<head>
    <meta charset="UTF-8">
    <title>Zadanie 4</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            table, tr, th, td{
                text-align: center;
                border: 1px solid black;
                border-collapse: collapse;
            }
        }
    </style>
</head>
<body>
<table>
    <tr>
        <th>Imie</th>
        <th>Nazwisko</th>
        <th>Email</th>
        <th>Haslo</th>
        <th>Wiek</th>
    </tr>
    <tr>
        <td><?php echo $_POST["imie"]?></td>
        <td><?php echo $_POST["nazwisko"]?></td>
        <td><?php echo $_POST["email"]?></td>
        <td><?php echo $_POST["haslo"]?></td>
        <td><?php echo $_POST["wiek"]?></td>
    </tr>
</table>
</body>
